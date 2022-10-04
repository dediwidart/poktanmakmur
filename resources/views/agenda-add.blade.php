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
    <form method="POST" action="{{url('/agenda/create')}}">
    @csrf
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Agenda</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
            <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" placeholder="Nama Kegiatan" required>
            </div>
            <div class="form-group">
                <label>Tanggal:</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" name="date" placeholder="Tanggal Kegiatan" class="form-control datetimepicker-input" data-target="#reservationdate" required/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                    <label class="col-md-4">Dari Pukul :</label>
                    <label class="col-md-4">Sampai Pukul :</label>
                    <label class="col-md-4">Zona Waktu :</label>
                </div>
                <div class="row">
                    <div class="input-group col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="09.00" name="time_start" required>
                    </div>
                    <div class="input-group col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="11.00 / selesai" name="time_end">
                    </div>
                    <div class="input-group col-md-4">
                        <select class="form-control custom-select" name="time_zone" required>
                            <option disabled>Pilih Zona Waktu</option>
                            <option value="WIB">WIB</option>
                            <option value="WIB">WITA</option>
                            <option value="WIB">WIT</option>
                        </select>
                    </div>
                </div>
                <small>Kosongkan kolom <strong>Sampai Pukul</strong> jika waktu selesai belum diketahui.</small>
              </div>
            <div class="form-group">
            <label for="name">Lokasi</label>
                <input type="text" name="location" class="form-control" placeholder="Lokasi Kegiatan" required>
            </div>
            <div class="row">
            <div class="col-12">
                <a href="/agenda" class="btn btn-secondary">Kembali</a>
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