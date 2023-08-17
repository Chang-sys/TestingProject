@extends('layouts.app')
@section('content')
   <div class="content-wrapper">
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1 class="m-0">@if (isset($productUsed)) Edit @else Add New @endif Product Used</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('productUsed.index') }}">Product Title Manangement</a> </li>
                     <li class="breadcrumb-item active">@if (isset($productUsed)) Edit @else Add New @endif Product Used</li>
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
                     @if (isset($productUsed))
                        {!! Form::model($productUsed, ['method' => 'PATCH', 'route' => ['productUsed.update', $productUsed->id]]) !!}
                     @else
                        {!! Form::open(array('route' => 'productUsed.store','method'=>'POST')) !!}
                     @endif
                        <div class="card-body">
                           <div class="row">
                              <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                                 <div class="form-group">
                                    <strong>View Order: <span class="text-danger">*</span> </strong>
                                    {!! Form::text('view_order', null, array( 'placeholder' => 'View Order','class' => 'form-control')) !!}
                                 </div>
                              </div> -->
                              <div class="col-xs-12 col-sm-12 col-md-12">
                                 <div class="form-group">
                                    <strong>Name: <span class="text-danger">*</span> </strong>
                                    {!! Form::text('name', null, array( 'placeholder' => 'Name','class' => 'form-control')) !!}
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card-footer">
                           <div class="row">
                              <div class="col-6">
                                 <a href="{{ route('productUsed.index') }}" class="btn btn-block btn-dark">Back</a>
                              </div>
                              <div class="col-6">
                                 @if (isset($productUsed))
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