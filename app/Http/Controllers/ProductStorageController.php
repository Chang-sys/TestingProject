<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductStorage;

use DB;
class productStorageController extends Controller
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

        $productStorage = ProductStorage::orWhere('name', 'LIKE', "%{$request->kwd}%")
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return view('products.storage.index', compact('productStorage'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.storage.createupdate');
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
            // 'view_order' => 'required',
        ]);
        productStorage::create($request->all());
        return redirect()->route('productStorage.index')
            ->with('success', 'product storage created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productStorage = ProductStorage::find($id);
        return view('products.storage.show', compact('productStorage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productStorage = ProductStorage::find($id);
        return view('products.storage.createupdate', compact('productStorage'));
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
            'name' => 'required|unique:product_storages',
            // 'view_order' => 'required',
        ]);
        $productStorage = ProductStorage::find($id);
        $productStorage->update($request->all());
        return redirect()->route('productStorage.index')
            ->with('success', 'product storage updated successfully');
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
        $total_products = DB::table('products')->where('storage_id', $id)->count();
        $sum += $total_products;

        if($sum == 0) {
            DB::table("product_storages")->where('id', $id)->delete();
            return redirect()->route('productStorage.index')->with('success', 'Product storage deleted successfully');
        } else {
            return redirect()->route('productStorage.index')->with('errors', 'Product storage cannot deleted, Because data has been used , Because data has been used in product page !!!');
        }
    }
}