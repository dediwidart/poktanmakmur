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
    <h3 class="card-title">Daftar Produk</h3>
    <a href="{{url('/product/create')}}" class="btn btn-primary float-right">Tambah Produk</a>
    <form action="" method="GET" class="col-sm-4 float-right">
        <div class="input-group">
            <input type="search" name="q" class="form-control" placeholder="Cari Produk">
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
            <th>Nama</th>
            <th>Gambar</th>
            <th>Kategori</th>
            <th>Berat</th>
            <th style="width: 10px">Diskon</th>
            <th>Harga</th>
            <th class="text-center">Tindakan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($product as $item)
        @php
            $disprice = $item->price - ((int)$item->price * (int)$item->discount/100);
        @endphp
        <tr>
            <td>{{ ($product ->currentpage()-1) * $product ->perpage() + $loop->index + 1 }}</td>
            <td>{{$item->name}}</td>
            <td class="w-25"> 
                <img src="{{$item->images}}" class="img-fluid img-thumbnail" alt="Sheep">
            </td>
            <td>{{$item->category}}</td>
            <td>{{$item->weight}}</td>
            @if($item->discount != "")
            <td class="text-center"><span class="badge bg-success">{{$item->discount}}%</span></td>
            <td>@currency($disprice)</td>
            @else
            <td class="text-center">-</td>
            <td>@currency($item->price)</td>
            @endif
            <td class="text-center">
                <a href="/product/edit/{{$item->id}}" class="btn btn-warning btn-sm">Edit</a>
                <a href="/product/delete/{{$item->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus Produk ini?')" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <div class="float-right">
            {!! $product->links() !!}
        </div>
    </div>
</div>

@endsection