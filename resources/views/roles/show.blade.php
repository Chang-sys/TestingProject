@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Show Role</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a> </li>
                  <li class="breadcrumb-item active">show</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <!-- Main content -->
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12 margin-tb">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">Role Infomation</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                     <div class="card-body">
                    	 <div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong>Name:</strong>
									{{ $role->name }}
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong>Permissions:</strong>
									@if(!empty($rolePermissions))
										@foreach($rolePermissions as $v)
											<label class="label label-success">{{ $v->name }},</label>
										@endforeach
									@endif
								</div>
							</div>
						</div>
                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
						          <a href="{{ route('roles.index') }}" class="btn btn-danger">Back</a>
                     </div>
               </div>
            </div>
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection