<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

use DB;

class CompanyController extends Controller
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

        $company = Company::orWhere('name', 'LIKE', "%{$request->kwd}%")
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return view('company.index', compact('company'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.createupdate');
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
            'name' => 'required|unique:companies',
            // 'view_order' => 'required',
        ]);
        company::create($request->all());
        return redirect()->route('company.index')
            ->with('success', 'Company created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('company.createupdate', compact('company'));
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
        $company = Company::find($id);
        $company->update($request->all());
        return redirect()->route('company.index')
            ->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $company = Company::find($id);
        // $company->delete();
        // return redirect()->route('company.index')
        //     ->with('success', 'Company deleted successfully');
        $sum = 0;    
        $total_products = DB::table('products')->where('company_id', $id)->count();
        $sum += $total_products;

        if($sum == 0) {
            DB::table("companies")->where('id', $id)->delete();
            return redirect()->route('company.index')
                        ->with('success', 'Category deleted successfully :) ');
        } else {
            return redirect()->route('company.index')
                        ->with('errors', 'Category cannot deleted data , Because data has been used in product page !!!');
        }
    }
}