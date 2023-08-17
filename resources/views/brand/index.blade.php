@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Brand Manangement</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Brand Manangement</li>
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
                {{-- need role to see --}}
               <a class="btn btn-success" href="{{ route('brand.create') }}"> <i class="far fa-plus-square"></i> Create </a>
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
                    {{-- {!! Form::open(['method' => 'GET','route' => ['category.index']]) !!}
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="kwd" value="{{ app('request')->input('kwd') }}" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            </div>
                        </div>
                    {!! Form::close() !!} --}}
                </div>
              </div>
             
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Maker ID</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($brand as $key => $item)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->maker_name}}</td>
                      <td>
                        <a class="btn btn-info" href="{{ route('brand.show',$item->id) }}">Show</a>
                            {{-- need role to see --}}
                            <a class="btn btn-primary" href="{{ route('brand.edit',$item->id) }}">Edit</a>
                            {{-- need role to see --}}
                          {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#brandModal'.$item->id]) !!}
                    </td>
                    </tr>
                    <!-- Modal Delete -->
                    <div class="modal fade" id="brandModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="brandModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="brandModalLabel">Delete Brand</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure to delete <b>{{ $item->name }}</b> ?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            {!! Form::open(['method' => 'DELETE','route' => ['brand.destroy', $item->id],'style'=>'display:inline']) !!}
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
                {!! $brand->render() !!}
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