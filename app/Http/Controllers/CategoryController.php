<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Catalog;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //     $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','store']]);
    //     $this->middleware('permission:category-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $category = Category::orWhere('name', 'LIKE', "%{$request->kwd}%")
        // $category = Category::orWhere('id' ,$request->kwd)
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return view('category.index', compact('category'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.createupdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'view_order' => 'required',
        ]);
        Category::create($request->all());
        return redirect()->route('category.index')
            ->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.createupdate', compact('category'));
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
            'name' => 'required',
            'view_order' => 'required',
        ]);
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('category.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sum = 0;    
        $total_products = DB::table('products')->where('category_id', $id)->count();
        $sum += $total_products;

        if($sum == 0) {
            DB::table("categories")->where('id', $id)->delete();
            return redirect()->route('category.index')
                        ->with('success', 'Category deleted successfully :) ');
        } else {
            return redirect()->route('category.index')
                        ->with('errors', 'Category cannot deleted data , Because data has been used in product page !!!');
        }
    }
}