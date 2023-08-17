@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Product </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Data Product </a>
                        </li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="card card-info card-b-big-text">
                        <div class="card-header">
                            <h3 class="card-">Data Product </h3>
                        </div>

                        <!-- /.card-body start here -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-start">
                                    <div class="row">
                                        @if (isset($product))
                                        <img src="{{ asset('storage/images/'.$product->image_path) }}"
                                            alt="Profile Image" width="500" height="400"
                                            class="pl-2 pb-2 img-rounded img-thumbnail" style="border-radius: 30px;">
                                        @else

                                        <img src="{{ asset('storage/images/default_product.png') }}" alt="Profile Image"
                                            width="500" height="450" class="pl-2 pb-2 img-rounded img-thumbnail"
                                            style="border-radius: 30px;">
                                        @endif

                                        <div class="col-md-8 d-flex justify-content-between mt-3">

                                            <div class="col-md-10">
                                                <b>Created at:</b>
                                            </div>

                                            <div class="col-md-9">
                                                @if ($product)
                                                {{ $product->created_at }}
                                                @else
                                                category not found.
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-md-6 text-lg">
                                    <div class="row mt-3">
                                        <div class="col-md-8 text-xl">
                                            @if ($product)
                                            <!-- {{ $product->title }} {{ $product->product_titles_name }} -->
                                            <b> {{ $product->title }}</b>
                                            @else
                                            Product not found.
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-2">
                                            <b>Category:</b>
                                        </div>
                                        <div class="col-md-8">
                                            @if ($product)
                                            <p class="text-primary p-0"> {{ $product->category_name }}</p>
                                            @else
                                            category not found.
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8 text-xl">
                                            @if ($product)
                                            {{ $product->title }} {{ $product->product_titles_name }}
                                            <!-- <b> {{ $product->title }}</b> -->
                                            @else
                                            Product not found.
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <ul>
                                            <li>Stock :
                                                <span> @if ($product)
                                                    <b class="text-danger">{{ $product->stock }}</b>
                                                    @else
                                                    category not found.
                                                    @endif
                                                </span>
                                            </li>
                                            <li>Color :
                                                <span> @if ($product)
                                                    {{ $product->product_colors_name }}
                                                    @else
                                                    category not found.
                                                    @endif
                                                </span>
                                            </li>
                                            <li>Storage :
                                                <span> @if ($product)
                                                    {{ $product->product_storages_name }}
                                                    @else
                                                    category not found.
                                                    @endif
                                                </span>
                                            </li>
                                            <li>Status :
                                                <span> @if ($product)
                                                    {{ $product->status }}
                                                    @else
                                                    category not found.
                                                    @endif
                                                </span>
                                            </li>
                                            <li>Screen :
                                                <span> @if ($product)
                                                    {{ $product->product_sizes_name }}
                                                    @else
                                                    category not found.
                                                    @endif
                                                </span>
                                            </li>
                                            <li>Brand :
                                                <span> @if ($product)
                                                    {{ $product->product_brands_name }}
                                                    @else
                                                    category not found.
                                                    @endif
                                                </span>
                                            </li>
                                            <li>company :
                                                <span> @if ($product)
                                                    {{ $product->product_companies_name }}
                                                    @else
                                                    category not found.
                                                    @endif
                                                </span>
                                            </li>
                                            <li>Marker :
                                                <span> @if ($product)
                                                    {{ $product->product_makers_name }}
                                                    @else
                                                    category not found.
                                                    @endif
                                                </span>
                                            </li>
                                            <li>Prdouct Used :
                                                <span> @if ($product)
                                                    <b class="text-info">{{ $product->product_useds_name }}</b>
                                                    @else
                                                    category not found.
                                                    @endif
                                                </span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-8">
                                            @if ($product)
                                            <b class="text-xl text-danger">$ {{ $product->price }} </b>
                                            @else
                                            category not found.
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-2">
                                            <b>Note:</b>
                                        </div>
                                        <div class="col-md-9">
                                            @if ($product)
                                            {{ $product->description }}
                                            @else
                                            category not found.
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Add more rows as needed -->
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body end here-->

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group full-width">
                                        <a href="{{ route('product.index') }}"
                                            class="btn btn-dark full-width btn-block">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection