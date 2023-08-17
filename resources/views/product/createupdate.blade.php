@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@if (isset($product)) Edit @else Add New @endif Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product Manangement</a>
                        </li>
                        <li class="breadcrumb-item active">@if (isset($product)) Edit @else Add New @endif Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Sorry!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Form Entry</h3>
                        </div>
                        @if (isset($product))
                        {!! Form::model($product, ['method' => 'PATCH', 'route' => ['product.update', $product->id],
                        'files' => true]) !!}
                        @else
                        {!! Form::open(array('route' => 'product.store','method'=>'POST', 'enctype' =>
                        'multipart/form-data')) !!}
                        @endif
                        <div class="card-body">
                            <div class="row">

                                <!-- Start Right form -->
                                <div class="col-md-6">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Title: <span class="text-danger">*</span> </strong>
                                            {!! Form::text('title', null, array( 'placeholder' => 'Name','class' =>
                                            'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Price: <span class="text-danger">*</span> </strong>
                                            {!! Form::number('price', null, array( 'placeholder' => 'Price','class' =>
                                            'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Category: <span class="text-danger">* </span></strong>
                                            {!! Form::select('category_id', $category, null, array('class' =>
                                            'form-control
                                            select2bs4', 'placeholder' => '--- Please select ---')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Product Title: <span class="text-danger">* </span></strong>
                                            {!! Form::select('title_id', $productTitle, null, array('class' =>
                                            'form-control
                                            select2bs4', 'placeholder' => '--- Please select ---')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Product Size: <span class="text-danger">* </span></strong>
                                            {!! Form::select('size_id', $productSize, null, array('class' =>
                                            'form-control
                                            select2bs4', 'placeholder' => '--- Please select ---')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Product Used: <span class="text-danger">* </span></strong>
                                            {!! Form::select('product_used_id', $productUsed, null, array('class' =>
                                            'form-control
                                            select2bs4', 'placeholder' => '--- Please select ---')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Brand: <span class="text-danger">* </span></strong>
                                            {!! Form::select('brand_id', $brand, null, array('class' => 'form-control
                                            select2bs4', 'placeholder' => '--- Please select ---')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Image Uploade: <span class="text-danger">*</span> </strong>
                                            <div class="input-group">
                                                {!! Form::file('image_path', array('class' =>
                                                'form-control-file','accept' => '.jpg', '.png', '.jpeg', 'gif')) !!}
                                                @if( isset($product) )
                                                    {!! Form::hidden('oldImage', $product->image_path) !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- end Right form -->

                                <!-- Start left form -->
                                <div class="col-md-6">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Stock: <span class="text-danger">*</span> </strong>
                                            {!! Form::text('stock', null, array( 'placeholder' => 'Stock','class' =>
                                            'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Status: <span class="text-danger">*</span> </strong>
                                            {!! Form::number('status', null, array( 'min' => 1, 'max' => 10,
                                            'placeholder' => 'Status','class' =>
                                            'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Product Color: <span class="text-danger">* </span></strong>
                                            {!! Form::select('color_id', $productColor, null, array('class' =>
                                            'form-control
                                            select2bs4', 'placeholder' => '--- Please select ---')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Product Storage: <span class="text-danger">* </span></strong>
                                            {!! Form::select('storage_id', $productStorage, null, array('class'
                                            => 'form-control
                                            select2bs4', 'placeholder' => '--- Please select ---')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Company: <span class="text-danger">* </span></strong>
                                            {!! Form::select('company_id', $company, null, array('class' =>
                                            'form-control
                                            select2bs4', 'placeholder' => '--- Please select ---')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Maker: <span class="text-danger">* </span></strong>
                                            {!! Form::select('maker_id', $maker, null, array('class' => 'form-control
                                            select2bs4', 'placeholder' => '--- Please select ---')) !!}
                                        </div>
                                    </div>

                                    <div class="m-auto dlex justify-content-center">
                                        @if (isset($product))
                                        <div class="mt-4">
                                            <img src="{{ asset('storage/images/'.$product->image_path) }}"
                                                alt="Profile Image" width="180" height="150" class="p-2 pt-0">
                                        </div>
                                        @else
                                        <div class="mt-4">
                                            <img src="{{ asset('storage/images/default_product.png') }}"
                                                alt="Profile Image" width="180" height="150" class="p-2 pt-0">
                                        </div>
                                        @endif
                                    </div>

                                </div>
                                <!-- End left form -->

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Description: <span class="text-danger">* </span> </strong>
                                        {!! Form::textarea('description', null, array( 'placeholder' =>
                                        'Description','class'
                                        =>
                                        'form-control')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('product.index') }}" class="btn btn-block btn-dark">Back</a>
                                </div>
                                <div class="col-6">
                                    @if (isset($product))
                                    <button type="submit" class="btn btn-info btn-block">Update</button>
                                    @else
                                    <button type="submit" class="btn btn-info btn-block">Save</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection