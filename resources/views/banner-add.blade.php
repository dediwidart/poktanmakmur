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
    <form method="POST" action="{{url('/banner/create')}}" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Banner</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="images">Gambar</label><span> (1000x500px)</span><br>
                <img src="" id="imageoutput" class="img-fluid img-thumbnail w-25" alt="Images">
                <div class="custom-file">
                    <input type="file" name="images" accept="image/*" onchange="document.getElementById('imageoutput').src = window.URL.createObjectURL(this.files[0])" class="custom-file-input" id="images">
                    <label class="custom-file-label" for="images">Pilih Gambar</label>
                </div>
            </div>
            <div class="row">
            <div class="col-12">
                <a href="/banner" class="btn btn-secondary">Kembali</a>
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