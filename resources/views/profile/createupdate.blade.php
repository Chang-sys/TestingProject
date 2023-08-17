<!-- ressource/views/profile.blade.php -->
@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="containser-fluid">
            <h1 class="mb-0">Profile</h1>
            <hr>
            <!-- /.card-header -->
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
            @endif
            @if ($message = Session::get('danger'))
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @endif

            @if ( isset($profile) )
            {!! Form::model($profile, ['method' => 'PATCH', 'route' => ['profile.update', $profile->id], 'enctype' =>
            'multipart/form-data'])
            !!}
            @else
            {!! Form::open(array('route' => 'profile.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
            @endif
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">User Profile</h3>
                </div>
                @if (isset($product))
                {!! Form::model($product, ['method' => 'PATCH', 'route' => ['product.update', $product->id], 'enctype' => 'multipart/form-data']) !!}
                @else
                {!! Form::open(array('route' => 'product.store','method'=>'POST', 'enctype' =>
                'multipart/form-data')) !!}
                @endif
                <div class="card-body">
                    <div class="row">

                        <!-- Start Right form -->
                        <div class="col-md-6">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="d-flex justify-content-center mb-5" id="res">
                                    @if ( isset($profile) )
                                    <div class="mt-4">
                                        <img src="{{ asset('storage/images/'.$profile->image_path) }}" alt="Profile Image"
                                            width="200" height="200" class="rounded-circle">
                                    </div>
                                    @else
                                    <div class="mt-4">
                                        <img src="{{ asset('storage/images/default_Profile.png') }}" alt="Profile Image"
                                            width="200" class="rounded-circle">
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- end Right form -->

                        <!-- Start left form -->
                        <div class="col-md-6">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <b>Name:</b> <br>
                                    {{ auth()->user()->name }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <b>Email:</b> <br>
                                    {{ auth()->user()->email }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Image Uploade: <span class="text-danger">*</span> </strong>
                                    <div class="input-group">
                                        {!! Form::file('image_path', ['class' => 'custom-file-input', 'id' =>
                                        'exampleInputFile', 'accept' => '.jpg', '.png', '.jpeg', 'gif']) !!}
                                        {!! Form::label('image_path', 'Choose Image', ['class' =>
                                        'custom-file-label'])
                                        !!}
                                        @if (isset($product))
                                            {!! Form::hidden('oldImage', $product->image_path) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End left form -->
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('product.index') }}" class="btn btn-block btn-dark">Back</a>
                        </div>
                        <div class="col-6">
                            @if ( isset($profile) )
                                <button id="btn" class="btn btn-block btn-primary" type="submit">Update
                                    Profile</button>
                            @else
                                <button id="btn" class="btn btn-block btn-primary" type="submit">Add
                                    Profile</button>
                            @endif

                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
@endsection