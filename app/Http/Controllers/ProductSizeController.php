<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductSize;

use DB;
class productSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //     $this->middleware('permission:product.size-list|product.size-create|product.size-edit|product.size-delete', ['only' => ['index','store']]);
    //     $this->middleware('permission:product.size-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:product.size-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:product.size-delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $productSize = ProductSize::orWhere('name', 'LIKE', "%{$request->kwd}%")
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return view('products.size.index', compact('productSize'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.size.createupdate');
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
            'name' => 'required|unique:product_sizes',
            // 'view_order' => 'required',
        ]);
        productSize::create($request->all());
        return redirect()->route('productSize.index')
            ->with('success', 'product size created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productSize = ProductSize::find($id);
        return view('products.size.show', compact('productSize'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productSize = ProductSize::find($id);
        return view('products.size.createupdate', compact('productSize'));
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
        $productSize = ProductSize::find($id);
        $productSize->update($request->all());
        return redirect()->route('productSize.index')
            ->with('success', 'product size updated successfully');
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
        $total_products = DB::table('products')->where('size_id', $id)->count();
        $sum += $total_products;

        if($sum == 0) {
            DB::table("product_sizes")->where('id', $id)->delete();
            return redirect()->route('productSize.index')->with('success', 'Product size deleted successfully :) ');
        } else {
            return redirect()->route('productSize.index')->with('errors', 'Product size cannot deleted, Because data has been used in product page !!!');
        }
    }
}