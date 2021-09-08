@extends('layouts.main')

@section('title'.' / Edit')

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
    <form method="POST" action="{{url('/product/edit')}}/{{$product->id}}" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Produk</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
            <label for="name">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$product->name}}" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select class="form-control custom-select" id="category" name="category" required>
                    <option selected disabled>Pilih Kategori</option>
                    @foreach($category as $item)
                        @if($product->category == $item->name)
                        <option selected>{{$item->name}}</option>
                        @else
                        <option>{{$item->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="price">Harga</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" id="price" name="price" class="form-control" value="{{$product->price}}" required>
                </div>
                
            </div>
            <div class="form-group">
                <label for="discount">Diskon</label><span> (Optional)</span>
                <div class="input-group mb-3">
                    <input type="number" id="discount" name="discount" class="form-control" min="1" max="100" value="{{$product->discount}}">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
            <label for="weight">Berat</label>
                <input type="text" id="weight" name="weight" class="form-control" value="{{$product->weight}}" required>
            </div>
            <div class="form-group">
            <label for="weight">Deskripsi</label><span> (Optional)</span><br>
                <input type="text" id="description" name="description" class="form-control" value="{{$product->description}}">
            </div>
            <div class="form-group">
                <label for="images">Gambar</label><span> (800x480px)</span><br>
                <img src="{{$product->images}}" id="imageoutput" class="img-fluid img-thumbnail w-25" alt="Images">
                <div class="custom-file">
                    <input type="file" name="images" accept="image/*" onchange="document.getElementById('imageoutput').src = window.URL.createObjectURL(this.files[0])" class="custom-file-input" id="images">
                    <label class="custom-file-label" for="images">{{$product->images}}</label>
                </div>
            </div>
            <div class="row">
            <div class="col-12">
                <a href="{{url('/product')}}" class="btn btn-secondary">Kembali</a>
                <input type="submit" value="Simpan" class="btn btn-success float-right">
                </div>
            </div>
        </div>
    <!-- /.card-body -->
        </div>
    </form>
    <!-- /.card -->
</div>


@endsection