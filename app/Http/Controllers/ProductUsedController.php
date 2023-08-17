<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductUsed;

use DB;

class productUsedController extends Controller
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

        $productUsed = ProductUsed::orWhere('name', 'LIKE', "%{$request->kwd}%")
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return view('products.used.index', compact('productUsed'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.used.createupdate');
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
            'name' => 'required|unique:product_useds',
            // 'view_order' => 'required',
        ]);
        productUsed::create($request->all());
        return redirect()->route('productUsed.index')
            ->with('success', 'product used created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productUsed = ProductUsed::find($id);
        return view('products.used.show', compact('productUsed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productUsed = ProductUsed::find($id);
        return view('products.used.createupdate', compact('productUsed'));
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
        $productUsed = ProductUsed::find($id);
        $productUsed->update($request->all());
        return redirect()->route('productUsed.index')
            ->with('success', 'product used updated successfully');
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
        $total_products = DB::table('products')->where('product_used_id', $id)->count();
        $sum += $total_products;

        if($sum == 0) {
            DB::table("product_useds")->where('id', $id)->delete();
            return redirect()->route('productUsed.index')->with('success', 'Product used deleted successfully :) ');
        } else {
            return redirect()->route('productUsed.index')->with('errors', 'Product used cannot deleted, Because data has been used in product page !!!');
        }
    }
}