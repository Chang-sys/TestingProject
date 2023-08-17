<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //     $this->middleware('permission:product.title-list|product.title-create|product.title-edit|product.title-delete', ['only' => ['index','store']]);
    //     $this->middleware('permission:product.title-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:product.title-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:product.title-delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $profile = DB::table('profiles')
                ->where('user_id', $user->id)
                ->whereNotNull('image_path')
                ->latest()
                ->first();
        }

        return view('profile.createupdate', compact('profile', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = Profile::latest()->first(); // Get the latest profile
        return view('profile.createupdate', compact('profile'));
    }

    /**
     * Store a newly uploaded resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size if needed
        ]);

        $profile = new Profile;
        $user = Auth::user();

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().str_random(10).'.'.$extension;

            $profile->image_path = $fileName;
            $profile->user_id = $user->id;

            Storage::disk('images_path')->put($fileName, \File::get($file));
            $profile->save();

            return redirect()->route('profile.index')->with('success', 'Profile image uploaded successfully');
        }

        return redirect()->route('profile.index')->with('error', 'Failed to upload profile image');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);
        return view('profile.createupdate', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::find($id);
        return view('profile.createupdate', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size if needed
        ]);

        $user = Auth::user();

        if($user){
            // Check user that had been created profile or not 
            $profile = DB::table('profiles')->where('user_id', $user->id)->whereNotNull('image_path');
            // Create another variaable to store value of image_path in table profile
            $previousImagePath = $profile->value('image_path');

            if ($request->hasFile('image_path')) {

                $file = $request->file('image_path');
                $extension = $file->getClientOriginalExtension();
                $newFileName = time() . str_random(10) . '.' . $extension;

                $profile->update([
                    'image_path' => $newFileName,
                ]);

                Storage::disk('images_path')->put($newFileName, \File::get($file));

                // Delete the previous image from storage
                if (Storage::disk('images_path')->exists($previousImagePath)) {
                    Storage::disk('images_path')->delete($previousImagePath);
                } 
                return redirect()->route('profile.index')->with('success', 'Profile image updated successfully');
            } 
            return redirect()->route('profile.index')->with('error', 'Failed to upload profile image');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::find($id);
        $profile->delete();
        return redirect()->route('profile')
            ->with('success', 'Profile deleted successfully');
    }
}