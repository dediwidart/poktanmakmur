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
    <form method="POST" action="{{url('/faq/edit')}}/{{$faq->id}}" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Faq</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
            <label for="name">Pertanyaan</label>
                <input type="text" name="questions" id="questions" class="form-control" value="{{$faq->questions}}" required>
            </div>
            <div class="form-group">
                <label>Jawaban</label>
                <textarea class="form-control" id="answer" name="answer" rows="5" placeholder="Masukan Jawaban...">{{$faq->answer}}</textarea>
            </div>
            <div class="row">
            <div class="col-12">
                <a href="/faq" class="btn btn-secondary">Kembali</a>
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