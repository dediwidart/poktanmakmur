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
    <h3 class="card-title">Daftar Agenda</h3>
    <a href="{{url('/agenda/create')}}" class="btn btn-primary float-right">Tambah Agenda</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>                  
        <tr>
            <th style="width: 10px">No</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Lokasi</th>
            <th class="text-center">Tindakan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($agenda as $item)
        <tr>
            <td>{{ ($agenda ->currentpage()-1) * $agenda ->perpage() + $loop->index + 1 }}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->date}}</td>
            <td>{{$item->time}}</td>
            <td>{{$item->location}}</td>
            <td class="text-center">
                <a href="/agenda/edit/{{$item->id}}" class="btn btn-warning btn-sm">Edit</a>
                <a href="/agenda/delete/{{$item->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus Agenda ini?')" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <div class="float-right">
            {!! $agenda->links() !!}
        </div>
    </div>
</div>

@endsection