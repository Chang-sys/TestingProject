<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductColor;

use DB;

class productColorController extends Controller
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

        $productColor = ProductColor::orWhere('name', 'LIKE', "%{$request->kwd}%")
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return view('products.color.index', compact('productColor'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.color.createupdate');
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
            'name' => 'required|unique:product_colors',
            // 'view_order' => 'required',
        ]);
        productColor::create($request->all());
        return redirect()->route('productColor.index')
            ->with('success', 'product color created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productColor = ProductColor::find($id);
        return view('products.color.show', compact('productColor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productColor = ProductColor::find($id);
        return view('products.color.createupdate', compact('productColor'));
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
            // 'view_order' => 'required',
        ]);
        $productColor = ProductColor::find($id);
        $productColor->update($request->all());
        return redirect()->route('productColor.index')
            ->with('success', 'product color updated successfully');
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
        $total_products = DB::table('products')->where('color_id', $id)->count();
        $sum += $total_products;

        if($sum == 0) {
            DB::table("product_colors")->where('id', $id)->delete();
            return redirect()->route('productColor.index')->with('success', 'Product color deleted successfully :) ');
        } else {
            return redirect()->route('productColor.index')->with('errors', 'Product color cannot deleted, Because data has been used in product page !!!');
        }
    }
}