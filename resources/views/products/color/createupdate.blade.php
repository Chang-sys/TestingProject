@extends('layouts.app')
@section('content')
   <div class="content-wrapper">
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1 class="m-0">@if (isset($productColor)) Edit @else Add New @endif Product Color</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('productColor.index') }}">Product Color Manangement</a> </li>
                     <li class="breadcrumb-item active">@if (isset($productColor)) Edit @else Add New @endif Product Color</li>
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
                     @if (isset($productColor))
                        {!! Form::model($productColor, ['method' => 'PATCH', 'route' => ['productColor.update', $productColor->id]]) !!}
                     @else
                        {!! Form::open(array('route' => 'productColor.store','method'=>'POST')) !!}
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
                                 <a href="{{ route('productColor.index') }}" class="btn btn-block btn-dark">Back</a>
                              </div>
                              <div class="col-6">
                                 @if (isset($productColor))
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