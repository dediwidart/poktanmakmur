@extends('layouts.main')

@section('title')

@section('content')

<section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-stopwatch"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pesanan Pending</span>
                <span class="info-box-number">
                  {{count($order_pending)}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-truck"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pesanan Dikirim</span>
                <span class="info-box-number">{{count($order_sended)}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pesanan Selesai</span>
                <span class="info-box-number">{{count($order_done)}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pesanan Dibatalkan</span>
                <span class="info-box-number">{{count($order_cancel)}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Pesanan Terbaru</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nomor Faktur</th>
                      <th>Nama</th>
                      <th>Status</th>
                      <th>Waktu</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order_lastest as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td><a href="{{url('/order/detail')}}/{{$item->id}}">{{$item->order_id}}</a></td>
                      <td>{{$item->bname}}</td>
                      @if($item->status == "pending")
                      <td><span class="badge badge-warning">Pending</span></td>
                      @elseif($item->status == "sended") 
                      <td><span class="badge badge-primary">Dikirim</span></td>
                      @elseif($item->status == "done") 
                      <td><span class="badge badge-success">Selesai</span></td>
                      @elseif($item->status == "cancel") 
                      <td><span class="badge badge-danger">Dibatalkan</span></td>
                      @endif
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">{{$item->created_at}}</div>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="/order/pending" class="btn btn-sm btn-secondary float-right">View All Orders</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Produk yang Baru Ditambahkan</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  
                @foreach($product as $item)
                @php
                    $disprice = $item->price - ((int)$item->price * (int)$item->discount/100);
                @endphp
                <li class="item">
                    <div class="product-img">
                      <img src="{{$item->images}}" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">{{$item->name}}
                        @if($item->discount != "")
                        <span class="badge badge-success float-right">@currency($disprice)</span></a>
                        @else
                        <span class="badge badge-primary float-right">@currency($item->price)</span></a>
                        @endif
                      <span class="product-description">
                        {{$item->weight}}
                      </span>
                    </div>
                  </li>
                @endforeach
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="/product" class="uppercase">View All Products</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>

@endsection