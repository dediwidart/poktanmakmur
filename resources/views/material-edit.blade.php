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
    <form method="POST" action="" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Materi</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
            <label for="name">Judul</label>
                <input type="text" name="name" value="{{$material->title}}" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="images">Gambar</label><br>
                <img id="imageoutput" class="img-fluid img-thumbnail w-25" src="{{$material->images}}" alt="Images">
                <div class="custom-file">
                    <input type="file" name="images" accept="image/*" onchange="document.getElementById('imageoutput').src = window.URL.createObjectURL(this.files[0])" class="custom-file-input" id="images">
                    <label class="custom-file-label" for="images">Pilih Gambar</label>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Materi</label>
                <textarea id="editor" name="description">{{$material->description}}</textarea>
             </div>
            <div class="row">
            <div class="col-12">
                <a href="{{url('/material')}}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success float-right">Simpan</button>
                </div>
            </div>
        </div>
    <!-- /.card-body -->
        </div>
    </form>
    <!-- /.card -->
</div>
 

@endsection
