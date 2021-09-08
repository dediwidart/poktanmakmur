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

<div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> {{\App\Models\Config::getApplicationName()}}.
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{$account->name}}</strong><br>
                    Alamat: {{$order->address}}<br>
                    Nomor: {{$account->number}}<br>
                  </address>
                </div>
                <!-- /.col -->  
                <div class="col-sm-4 invoice-col">
                  <b>Faktur #{{$order->id}}-{{$order->bid}}-{{$order->total}}</b><br>
                  <b>Order ID:</b> {{$order->id}}<br>
                  <b>Waktu Pembayaran:</b> {{$order->odate}}<br>
                  <b>Akun ID:</b> {{$order->bid}}<br>
                  @if ($order->payment == 'Transfer')
                  <a href="{{$order->images}}" target="_blank">Tampilkan Bukti Pembayaran</a>
                  @endif
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Produk</th>
                      <th class="text-center">Jumlah</th>
                      <th class="text-center">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                      @php
                          $productArray = explode(',',$order->pname);
                          $amountArray = explode(',',$order->amount);
                          $priceArray = explode(',',$order->pprice);
                          $total = 0;
                          $j = 0;
                      @endphp
                      @for ($i = 0;$i < sizeof($amountArray); $i++)
                      <tr>
                        @php
                            $j = $i;
                            $total += $priceArray[$i] * $amountArray[$i];
                        @endphp
                        <td>{{$i+1}}</td>
                        <td>{{$productArray[$i]}}</td>
                        <td class="text-center">{{$amountArray[$i]}}</td>
                        <td class="text-center">@currency($priceArray[$i] * $amountArray[$i])</td>
                      </tr>
                      @endfor
                      <tr>
                        <td>{{$j+2}}</td>
                        <td>Biaya Pengiriman</td>
                        <td class="text-center">1</td>
                        <td class="text-center"><a href="#">@currency($order->total-$total)</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <p class="lead">Status: <a href="#">{{$order->status}}</a></p>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  Biaya pengiriman dapat berubah sewaktu-waktu. Jumlah pembayaran yang dibayar disesuaikan dengan biaya pada saat Waktu Pembayaran.
                  </p>
                </div>
                <div class="col-6">
                  <p class="lead">Jatuh Tempo {{$order->odate}}</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Total:</th>
                        <td>@currency($order->total)</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  @if($order->status == "pending")
                  <a href="{{url('/order/send')}}/{{$order->id}}" onclick="return confirm('Apakah Anda yakin ingin mengirim Pesanan?')" style="color:#FFFFFF;" class="btn btn-success float-right"> Kirim Pesanan </a>
                  <a href="{{url('/order/cancel')}}/{{$order->id}}" onclick="return confirm('Apakah Anda yakin ingin membatalkan Pesanan?')" style="color:#FFFFFF; margin-right: 5px;" class="btn btn-danger float-right"> Batalkan Pesanan</a>
                  @elseif($order->status == "sended")
                  <a href="{{url('/order/end')}}/{{$order->id}}" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan Pesanan?')" style="color:#FFFFFF;" class="btn btn-success float-right"> Selesai </a>
                  <a href="{{url('/order/cancel')}}/{{$order->id}}" onclick="return confirm('Apakah Anda yakin ingin membatalkan Pesanan?')" style="color:#FFFFFF; margin-right: 5px;" class="btn btn-danger float-right"> Batalkan Pesanan</a>
                  @else
                  @endif
                </div>
              </div>
            </div>

@endsection
