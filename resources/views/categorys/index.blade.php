@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Category Manangement</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Category Manangement</li>
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
            <div class="pull-right">
               <!-- @can('role-create') -->
               <a class="btn btn-success" href="{{ route('category.create') }}"> <i class="far fa-plus-square"></i> Create </a>
               <!-- @endcan -->
            </div>
         </div>
      </div>
      <br>
      <!-- /.card-header -->
      @if ($message = Session::get('success'))
          <div class="alert alert-success">
            {{ $message }}
          </div>
      @endif

      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data List</h3>

                <div class="card-tools">
                    {!! Form::open(['method' => 'GET','route' => ['category.index']]) !!}
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="kwd" value="{{ app('request')->input('kwd') }}" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
              </div>
             
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>View Order</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($category as $key => $item)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->view_order}}</td>
                      <td>
                        <a class="btn btn-info btn-xs" href="{{ route('category.show',$item->id) }}">Show</a>
                        @can('category-edit')
                            <a class="btn btn-primary btn-xs" href="{{ route('category.edit',$item->id) }}">Edit</a>
                        @endcan
                        @can('category-delete')
                          {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs', 'data-toggle' => 'modal', 'data-target' => '#categoryModal'.$item->id]) !!}
                        @endcan
                    </td>
                    </tr>
                    <!-- Modal Delete -->
                    <div class="modal fade" id="categoryModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="categoryModalLabel">Delete Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure to delete <b>{{ $item->name }}</b> ?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            {!! Form::open(['method' => 'DELETE','route' => ['category.destroy', $item->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal Delete -->
                    @endforeach
                  </tbody>
                </table>
                {!! $category->render() !!}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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