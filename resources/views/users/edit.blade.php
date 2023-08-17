@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
       <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Update User</h2>
                    </div>
                    {{-- <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                    </div> --}}
                </div>
            </div>


            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
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
                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Password:</strong>
                                {!! Form::password('password', array('placeholder' => 'Passwor','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Confirm Password:</strong>
                                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Role:</strong>
                                {!! Form::select('roles', $roles, $userRole, array('class' => 'form-control Select2bs4','placeholder' => '--- Please select ---')) !!}
                            </div>
                        </div>
                        {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> --}}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                       <div class="col-6">
                          <a href="{{ route('users.index') }}" class="btn btn-block btn-dark">Back</a>
                       </div>
                       <div class="col-6">
                             <button type="submit" class="btn btn-info btn-block">Save</button> 
                       </div>
                    </div>
                 </div>
                {!! Form::close() !!}
            </div>
            <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
        </div>
    <!-- /.container-fluid -->
    </div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection