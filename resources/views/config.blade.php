@extends('layouts.main')

@section('title')

@section('content')

@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@elseif(session('alert-failed'))
<div class="alert alert-danger">
        {{ session('alert-failed') }}
    </div>
@endif
    
<div class="card">
    <div class="card-header">
    <h3 class="card-title">Pengaturan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Aplikasi</label>
                <input type="text" name="app_name" id="app_name" value="{{$config->app_name}}" class="form-control" required>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Username Admin</label>
                        <input type="text" name="admin_username" value="{{$config->admin_username}}" id="admin_username" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Password Admin</label>
                        <input type="password" name="admin_password" value="{{$config->admin_password}}" id="admin_password" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="submit" value="Simpan" class="btn btn-success float-right">
                    </div>
                </div>
        </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
    
    </div>
</div>

@endsection