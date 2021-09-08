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
    <h3 class="card-title">Daftar FAQ</h3>
    <a href="{{url('/faq/create')}}" class="btn btn-primary float-right">Tambah FAQ</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>                  
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 10px">Pertanyaan</th>
            <th style="width: 30px;">Jawaban</th>
            <th style="width: 150px" class="text-center">Tindakan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($faq as $item)
        <tr>
            <td>{{ ($faq ->currentpage()-1) * $faq ->perpage() + $loop->index + 1 }}</td>
            <td>{{$item->questions}}</td>
            <td>{{$item->answer}}</td>
            <td class="text-center">
                <a href="/faq/edit/{{$item->id}}" class="btn btn-warning btn-sm">Edit</a>
                <a href="/faq/delete/{{$item->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus Kategori ini?')" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <div class="float-right">
            {!! $faq->links() !!}
        </div>
    </div>
</div>

@endsection