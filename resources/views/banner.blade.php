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
    <h3 class="card-title">Daftar Banner</h3>
    <a href="{{url('/banner/create')}}" class="btn btn-primary float-right">Tambah Banner</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>                  
        <tr>
            <th style="width: 10px">#</th>
            <th>Tanggal</th>
            <th class="text-center">Gambar</th>
            <th class="text-center">Tindakan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($banner as $item)
        <tr>
            <td>{{ ($banner ->currentpage()-1) * $banner ->perpage() + $loop->index + 1 }}</td>
            <td>{{$item->created_at}}</td>
            <td class="w-25 text-center"> 
                <img width="100" height="50" src="{{$item->images}}" class="img-fluid img-thumbnail" alt="Sheep">
            </td>
            <td class="text-center">
                <a href="/banner/delete/{{$item->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus Banner ini?')" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <div class="float-right">
            {!! $banner->links() !!}
        </div>
    </div>
</div>

@endsection