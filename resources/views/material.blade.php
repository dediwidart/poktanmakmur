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
    <h3 class="card-title">Daftar Materi</h3>
    <a href="{{url('/material/create')}}" class="btn btn-primary float-right">Tambah Materi</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>                  
        <tr>
            <th style="width: 10px">No</th>
            <th style="width: 10px">Judul</th>
            <th style="width: 30px;">Deskirpsi (HTML)</th>
            <th style="width: 150px" class="text-center">Tindakan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($material as $item)
        <tr>
            <td>{{ ($material ->currentpage()-1) * $material ->perpage() + $loop->index + 1 }}</td>
            <td>{{$item->title}}</td>
            <td>{{\Illuminate\Support\Str::limit($item->description, 150, $end='...')}}</td>
            <td class="text-center">
                <a href="/material/edit/{{$item->id}}" class="btn btn-warning btn-sm">Edit</a>
                <a href="/material/delete/{{$item->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus Materi ini?')" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <div class="float-right">
            {!! $material->links() !!}
        </div>
    </div>
</div>

@endsection