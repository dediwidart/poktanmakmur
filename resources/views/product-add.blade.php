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

<div class="col-md-12">
    <form method="POST" id="form" action="{{url('/product/create')}}" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Produk</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
            <label for="name">Nama</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select class="form-control custom-select" id="category" name="category" required>
                    <option selected disabled>Pilih Kategori</option>
                    @foreach($category as $item)
                        <option>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="price">Harga</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" id="price" name="price" class="form-control" required>
                </div>
                
            </div>
            <div class="form-group">
                <label for="discount">Diskon</label><span> (Optional)</span>
                <div class="input-group mb-3">
                    <input type="number" id="discount" name="discount" class="form-control" min="1" max="100">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="discount">Berat</label><span></span>
                <div class="input-group mb-3">
                    <input type="text" id="weight" name="weight" class="form-control" min="1" required>
                    <div class="input-group-append">
                        <span class="input-group-text">gram</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
            <label for="weight">Deskripsi </label><span> (Optional)</span> 
                <input type="text" id="description" name="description" class="form-control">
            </div>
            <div class="form-group">
                <label for="images">Gambar</label><span> (800x480px)</span><br>
                <img src="" id="imageoutput" class="img-fluid img-thumbnail w-25" alt="Images">
                <div class="custom-file">
                    <input type="file" name="images" accept="image/*" onchange="document.getElementById('imageoutput').src = window.URL.createObjectURL(this.files[0])" class="custom-file-input" id="images" required>
                    <label class="custom-file-label" for="images">Pilih Gambar</label>
                </div>
            </div>
            <div class="row">
            <div class="col-12">
                <a href="/product" class="btn btn-secondary">Kembali</a>
                <input type="submit" value="Upload" class="btn btn-success float-right">
                </div>
            </div>
        </div>
    <!-- /.card-body -->
        </div>
    </form>
    <!-- /.card -->
</div>

@endsection