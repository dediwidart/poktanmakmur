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
        <h3 class="card-title">Daftar Pesanan</h3>
    </div>
    <div class="card-body">
    <table class="table table-bordered">
        <thead>                  
        <tr>
            <th style="width: 10px">No</th>
            <th>Nama</th>
            <th>Nomor Faktur</th>
            <th style="width: 210px">Pesanan</th>
            <th style="width: 50px">Pembayaran</th>
            <th>Waktu Pemesanan</th>
            <th class="text-center">Tindakan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order as $item)
        <tr>
            <td>{{ ($order ->currentpage()-1) * $order ->perpage() + $loop->index + 1 }}</td>
            <td>{{$item->bname}}</td>
            <td><a href="{{url('/order/detail')}}/{{$item->id}}">{{$item->order_id}}</a></td>
            <td>{{$item->pname}}</td>
            @if($item->payment == 'Transfer')
            <td><a href="" onclick="window.open('{{$item->images}}','targetWindow', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1090px, height=550px, top=25px left=120px'); return false;">{{$item->payment}}</a></td>
            @else
            <td>{{$item->payment}}</td>
            @endif
            <td>{{$item->created_at}}</td>
            <td class="text-center">
                @if(strpos($request, 'Dikirim') == false && strpos($request, 'Selesai') == false && strpos($request, 'Dibatalkan') == false)
                <a href="{{url('/order/send')}}/{{$item->id}}" onclick="return confirm('Apakah Anda yakin ingin mengirim Pesanan?')" class="btn btn-success btn-sm">Kirim</a>
                @elseif(strpos($request, 'Dikirim') !== false)
                <a href="{{url('/order/end')}}/{{$item->id}}" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan Pesanan?')" class="btn btn-success btn-sm">Selesai</a>
                @endif
                @if($item->bid != "-")
                <a href="{{url('/order/detail')}}/{{$item->id}}" class="btn btn-primary btn-sm">Detail</a>
                @else
                <button class="btn btn-primary btn-sm" type="button" disabled>Detail</button>
                @endif
                @if(strpos($request, 'Selesai') == false && strpos($request, 'Dibatalkan') == false)
                <a href="{{url('/order/cancel')}}/{{$item->id}}" onclick="return confirm('Apakah Anda yakin ingin membatalkan Pesanan?')" class="btn btn-danger btn-sm">Batalkan</a>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <div class="float-right">
            {!! $order->links() !!}
        </div>
    </div>
</div>

<script>
    setTimeout(reload, 5000);

    function reload() {
        location.reload();
    }
</script>
   
@endsection