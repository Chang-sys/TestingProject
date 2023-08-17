@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">User Manangement</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">User Manangement</li>
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
               <a class="btn btn-success" href="{{ route('users.create') }}"> <i class="far fa-plus-square"></i> Create </a>
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
      @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
          {{ $message }}
        </div>
      @endif
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data List</h3>

                <div class="card-tools">
                  {!! Form::open(['method' => 'GET','route' => ['users.index']]) !!}
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
                      <th>Email</th>
                      <th>Rloes</th>
                      <th>Create At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $key => $user)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        @if(!empty($user->getRoleNames()))
                          @foreach($user->getRoleNames() as $v)
                          {{-- <label class="badge badge-pill badge-info">{{ $v }}</label> --}}
                          <label>{{ $v }}</label>
                          @endforeach
                        @endif
                      </td>
                      <td>{{ $user->created_at }}</td>
                      <td>
                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                        <a class="btn btn-primary"
                          href="{{ route('users.edit',$user->id) }}">Edit</a>
                          {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#userModal'.$user->id]) !!}
                        {{-- {!! Form::open(['method' => 'DELETE','route' => ['users.destroy',
                          $user->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!} --}}
                      </td>
                    </tr>
                    <!-- Modal Delete -->
                    <div class="modal fade" id="userModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="userModalLabel">Delete User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure to delete <b>{{ $user->name }}</b> ?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button> 
                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy',
                          $user->id],'style'=>'display:inline']) !!}
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
              </div>
              {!! $data->render() !!}
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