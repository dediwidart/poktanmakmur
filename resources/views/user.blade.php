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
    <h3 class="card-title">Daftar Pengguna</h3>
    <form action="" method="GET" class="col-sm-4 float-right">
        <div class="input-group">
            <input type="search" name="q" class="form-control" placeholder="Cari Pengguna">
            <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>                  
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 30px">Nama</th>
            <th style="width: 30px">Nomor</th>
            <th style="width: 100px">Alamat</th>
            <th style="width: 20px" class="text-center">Tindakan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user as $item)
        <tr>
            <td>{{ ($user ->currentpage()-1) * $user ->perpage() + $loop->index + 1 }}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->number}}</td>
            <td>{{$item->address}}</td>
            <td class="text-center">
                <a href="/user/delete/{{$item->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus Pengguna ini?')" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <div class="float-right">
            {!! $user->links() !!}
        </div>
    </div>
</div>

@endsection