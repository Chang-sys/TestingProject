<?php

namespace App\Http\Controllers;
    
use App\Models\Product;
use App\Models\Maker;
use App\Models\Brand;
use App\Models\Company;

use App\Models\Category;
use App\Models\ProductTitle;
use App\Models\ProductSize;
use App\Models\ProductStorage;
use App\Models\ProductColor;
use App\Models\ProductUsed;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use DB;
    
class ProductController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = DB::table('products')
                    ->join('product_titles', 'products.title_id', '=', 'product_titles.id')
                    ->join('product_storages', 'products.storage_id', '=', 'product_storages.id')
                    ->join('product_sizes', 'products.size_id', '=', 'product_sizes.id')
                    ->select(
                        'products.*',
                        'product_titles.name as product_titles_name',
                        'product_storages.name as product_storages_name', 
                        'product_sizes.name as product_sizes_name')
                    ->where('product_storages.id', '=', 'products.storage_id')
                    ->orWhere('products.title', 'LIKE', "%{$request->kwd}%")
                    ->orderBy('products.id', 'DESC')
                    ->paginate(5);


        return view('product.index',compact('product'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // public function getProductById($id){
    //     $product = Product::select('*')->where("id",$id)->with(['category','image'])->get();
    //     return view('product.createupdate', compact('product'));
    // }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $category = Category::all()->sortBy('name')->pluck('name', 'id');
        $productTitle = ProductTitle::all()->sortBy('name')->pluck('name', 'id');
        $productSize = ProductSize::all()->sortBy('name')->pluck('name', 'id');
        $productColor = ProductColor::all()->sortBy('name')->pluck('name', 'id');
        $productStorage = ProductStorage::all()->sortBy('name')->pluck('name', 'id');
        $productUsed = ProductUsed::all()->sortBy('name')->pluck('name', 'id');
        $maker = Maker::all()->sortBy('name')->pluck('name', 'id');
        $brand = Brand::all()->sortBy('name')->pluck('name', 'id');
        $company = Company::all()->sortBy('name')->pluck('name', 'id');

        return view('product.createupdate', compact('category', 'productTitle', 'productSize', 'productColor', 'productStorage', 'productUsed', 'maker', 'brand', 'company'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // dd($request->all());

        $request->validate([
            'title'=> 'required|string|max:50',
            'description'=> 'required',
            'stock' => 'required|numeric|integer',
            'price'=> 'required|numeric',
            'status' => 'required|numeric',
            'category_id'=> 'required',
            'title_id' => 'required',
            'color_id'=> 'required',
            'size_id' => 'required',
            'storage_id' => 'required',
            'maker_id' => 'required',
            'brand_id' => 'required',
            'product_used_id' => 'required',
            'company_id' => 'required',
            'image_path'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . str_random(10) . '.' . $extension;

            $input['image_path'] = $fileName;
            Storage::disk('public')->put('images/' . $fileName, \File::get($file));
            
        } else {
            return redirect()->route('product.index')->with('errors', 'Failed to add Product');
        }
        
        // Product::save($input);
        $product = new Product();
        $product->fill($input);
        $product->save();
        return redirect()->route('product.index')->with('success', 'Product added successfully');
}

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function show(Product $product)
    // {
    //     return view('product.show',compact('product'));
    // }

    public function show($id)
    {
        $product = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->join('product_storages', 'products.storage_id', '=', 'product_storages.id')
                    ->join('product_sizes', 'products.size_id', '=', 'product_sizes.id')
                    ->join('product_colors', 'products.color_id', '=', 'product_colors.id')
                    ->join('product_titles', 'products.title_id', '=', 'product_titles.id')
                    ->join('product_useds', 'products.product_used_id', '=', 'product_useds.id')
                    ->join('makers', 'products.maker_id', '=', 'makers.id')
                    ->join('brands', 'products.brand_id', '=', 'brands.id')
                    ->join('companies', 'products.company_id', '=', 'companies.id')
                    ->select(
                        'products.*',
                        'categories.name as category_name', 
                        'product_storages.name as product_storages_name',
                        'product_sizes.name as product_sizes_name',
                        'product_colors.name as product_colors_name',
                        'product_titles.name as product_titles_name',
                        'product_useds.name as product_useds_name',
                        'makers.name as product_makers_name',
                        'brands.name as product_brands_name',
                        'companies.name as product_companies_name'
                    )
                    ->where('products.id', '=', $id)
                    ->first();

        return view('product.show',compact('product'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        // $oldImagePath = Product::find($id)->value('image_path');
        // dd($oldImagePath);
        $category = Category::all()->sortBy('name')->pluck('name', 'id');
        $productTitle = ProductTitle::all()->sortBy('name')->pluck('name', 'id');
        $productSize = ProductSize::all()->sortBy('name')->pluck('name', 'id');
        $productColor = ProductColor::all()->sortBy('name')->pluck('name', 'id');
        $productStorage = ProductStorage::all()->sortBy('name')->pluck('name', 'id');
        $productUsed = ProductUsed::all()->sortBy('name')->pluck('name', 'id');
        $maker = Maker::all()->sortBy('name')->pluck('name', 'id');
        $brand = Brand::all()->sortBy('name')->pluck('name', 'id');
        $company = Company::all()->sortBy('name')->pluck('name', 'id');
        return view('product.createupdate', compact('category', 'product', 'productTitle', 'productSize', 'productColor', 'productStorage', 'productUsed', 'maker', 'brand', 'company'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $previousImagePath = $request->oldImage; // this $request->oldImage; get from submit form of product blade

        $this->validate($request,[
            'title'=> 'required|string|max:50',
            'description'=> 'required',
            'stock' => 'required|numeric|integer',
            'price'=> 'required|numeric',
            'status' => 'required|numeric',
            'category_id'=> 'required',
            'title_id' => 'required',
            'color_id'=> 'required',
            'size_id' => 'required',
            'storage_id' => 'required',
            'maker_id' => 'required',
            'brand_id' => 'required',
            'product_used_id' => 'required',
            'company_id' => 'required',
            'image_path' => 'nullable|image|max:2048',
        ]);

        $input = $request->all();
        // dd($request->hasFile('image_path'));

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . str_random(10) . '.' . $extension;

            $input['image_path'] = $fileName;
            Storage::disk('public')->put('images/' . $fileName, \File::get($file));
            
            if (Storage::disk('images_path')->exists($previousImagePath)) {
                Storage::disk('images_path')->delete($previousImagePath);
            }
        }else{
            // $product->image_path = $previousImagePath; // Keep the existing image path
            unset($input['image_path']);
        }

        $product->update($input);

        return redirect()->route('product.index')
                        ->with('success','Product updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = DB::table('products')->where('id', $id)->whereNotNull('image_path');
        $previousImagePath = $product->value('image_path');

        if($product){
            // Delete the previous image in storage
            if (Storage::disk('images_path')->exists($previousImagePath)) {
                Storage::disk('images_path')->delete($previousImagePath);
            }
            $product->delete();
            return redirect()->route('product.index')->with('success','Product deleted successfully');	
        }else{
            return redirect()->route('product.index')->with('errors','Product deleted unsuccessfully');

        }
    }
}