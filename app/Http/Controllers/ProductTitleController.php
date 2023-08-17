<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductTitle;

use DB;
class productTitleController extends Controller
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
        $productTitle = ProductTitle::orWhere('name', 'LIKE', "%{$request->kwd}%")
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return view('products.title.index', compact('productTitle'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.title.createupdate');
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
            'name' => 'required|unique:product_titles',
            // 'view_order' => 'required',
        ]);
        productTitle::create($request->all());
        return redirect()->route('productTitle.index')
            ->with('success', 'product title created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productTitle = ProductTitle::find($id);
        return view('products.title.show', compact('productTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productTitle = ProductTitle::find($id);
        return view('productTitle.createupdate', compact('productTitle'));
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
        $productTitle = ProductTitle::find($id);
        $productTitle->update($request->all());
        return redirect()->route('productTitle.index')
            ->with('success', 'product title updated successfully');
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
        $total_products = DB::table('products')->where('title_id', $id)->count();
        $sum += $total_products;

        if($sum == 0) {
            DB::table("product_titles")->where('id', $id)->delete();
            return redirect()->route('productTitle.index')->with('success', 'Product title deleted successfully');
        } else {
            return redirect()->route('productTitle.index')->with('errors', 'Product title cannot deleted, Because data has been used in product page !!!');
        }
    }
}