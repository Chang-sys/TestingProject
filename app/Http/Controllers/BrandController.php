<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Maker;
use Illuminate\Http\Request;
use DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:brand-list|brand-create|brand-edit|brand-delete', ['only' => ['index','store']]);
        $this->middleware('permission:brand-create', ['only' => ['create','store']]);
        $this->middleware('permission:brand-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        // $brand = Brand::orWhere('name', 'LIKE', "%{$request->kwd}%")
        // ->orderBy('id','DESC')
        // ->paginate(5);
        $brand = DB::table('makers')
                    ->join('brands', 'brands.maker_id', '=', 'makers.id')
                    // ->rightJoin('brands', 'brands.maker_id', '=', 'makers.id')
                    ->select('brands.*','makers.name as maker_name')
                    ->where('makers.id', '=' , 'brands.maker_id')
                    ->orWhere('brands.name', 'LIKE', "%{$request->kwd}%")
                    ->orderBy('brands.id','DESC')
                    ->paginate(5);
                    // dd($brand);
        return view('brand.index',compact('brand'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maker = Maker::all()->sortBy('name')->pluck('name', 'id');
        return view('brand.createupdate',compact('maker'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'maker_id' => 'required',
            'name' => 'required|unique:brands',
        ]);
        Brand::create($request->all());
        return redirect()->route('brand.index')
                        ->with('success','Brand created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $brand = DB::table('makers')
                    ->join('brands', 'brands.maker_id', '=', 'makers.id')
                    // ->rightJoin('brands', 'brands.maker_id', '=', 'makers.id')
                    ->select('brands.*','makers.name as maker_name')
                    // ->where('makers.id', '=' , 'brands.maker_id')
                    ->where('brands.id', '=' , $id)
                    // ->orWhere('brands.name', 'LIKE', "%{$request->kwd}%")
                    // ->orderBy('brands.id','DESC')
                    ->first();
                    // dd($brand);
        return view('brand.show',compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        $maker = Maker::all()->sortBy('name')->pluck('name', 'id');
        return view('brand.createupdate', compact('brand','maker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'maker_id' => 'required',
            'name' => 'required',
        ]);
        $brand = Brand::find($id);
        $brand->update($request->all());
        return redirect()->route('brand.index')
                        ->with('success','Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $brand=Brand::find($id);
        // $brand->delete();
        // return redirect()->route('brand.index')
        //                 ->with('success', 'Brand deleted successfully');

        $sum = 0;
        $total_products = DB::table('products')->where('brand_id', $id)->count();
        $sum += $total_products;

        if($sum == 0) {
            DB::table("brands")->where('id', $id)->delete();
            return redirect()->route('brand.index')->with('success', 'Brand deleted successfully :) ');
        } else {
            return redirect()->route('brand.index')->with('errors', 'Brand cannot deleted, Because data has been used in product page !!!');
        }
    }
}
