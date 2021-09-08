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
    <h3 class="card-title">Daftar Kategori</h3>
    <a href="{{url('/category/create')}}" class="btn btn-primary float-right">Tambah Kategori</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>                  
        <tr>
            <th style="width: 10px">#</th>
            <th>Nama</th>
            <th class="text-center">Gambar</th>
            <th class="text-center">Tindakan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($category as $item)
        <tr>
            <td>{{ ($category ->currentpage()-1) * $category ->perpage() + $loop->index + 1 }}</td>
            <td>{{$item->name}}</td>
            <td class="w-25 text-center"> 
                <img width="100" height="50" src="{{$item->images}}" class="img-fluid img-thumbnail" alt="Sheep">
            </td>
            <td class="text-center">
                <a href="/category/edit/{{$item->id}}" class="btn btn-warning btn-sm">Edit</a>
                <a href="/category/delete/{{$item->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus Kategori ini?')" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item"><a class="page-link" href="{{$category->previousPageUrl()}}">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">{{$category->currentPage()}}</a></li>
        <li class="page-item"><a class="page-link" href="{{$category->nextPageUrl()}}">&raquo;</a></li>
    </ul>
    </div>
</div>

@endsection