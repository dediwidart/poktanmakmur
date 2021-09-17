<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width-device-width, initial-scale=1">
        <title>Nota Pengiriman {{$order->bname}}</title>
        {{-- <link rel="stylesheet" href={{asset('dist/css/pdf.min.css')}} integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style>
            @page{
                margin: 50px 25px;
            }

            header{
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                background-color: lightgreen;
                height: 40px;
            }

            footer{
                position: fixed;
                bottom: -40px;
                height: 50px;
            }

            p{
                page-break-after: always;
            }

            p:last-child{
                page-break-after: never;
            }
        </style>
    </head>
    <body>
        <footer>
            <div style="text-align: center; color:lightgrey; font-size:11px; line-height:normal;">
                @php
                    $timezone = new DateTimeZone('Asia/Jakarta');
                    $date = new DateTime();
                    $date->setTimeZone($timezone);

                    echo "Dicetak ".$date->format("d-m-Y")." pukul ".$date->format("h:i:s a")
                @endphp
                <br>
                &copy; Copyright Poktan Makmur All Right Reserved.
            </div>
        </footer>
        <main>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h3 style="font-size:14px; margin-top: -40px; text-align: center;">POKTAN MAKMUR</h3><br>
                    <h6 style="font-size:9px; margin-top: -48px; text-align: center;">Ds. Sidigede RT.10 RW.02 Kecamatan Welahan Kab. Jepara</h6><br>
                    <h6 style="font-size:9px; margin-top: -60px;  text-align: center;">Telp/Whatsapp: 0898-4599-000, Fax 031-9987605</h6><br>
                    <hr class="botm-line" style="height:0.05px; width=1030px; background:#000000; margin-top:-70px"><br>

                </div>
            </div>
            <h5 style="font-size:12px; text-align: center; margin-top:-90px">NOTA PENGIRIMAN</h5>
            <div style="margin-top: 70px">
                <div class="row">
                    <div class="col-sm-3" style="position: relative">
                            <p style="font-size:8px;"><strong>Penerima : </strong><br>
                                <strong>{{$order->bname}}</strong><br>
                                {{$order->address}} <br>
                                {{$account->number}}
                            </p>
                        
                    </div>
                    
                    <div class="col-sm-3" style="position: relative">
                            <p style="font-size:10px; margin-top:-120px; float: right; width:180px" "><strong>Faktur #{{$order->id}}-{{$order->bid}}-{{$order->total}}</strong><br>
                                Order ID: {{$order->id}}<br>
                                Waktu Pembayaran: {{$order->odate}}<br>
                                Metode Pembayaran: {{$order->payment}}
                            </p>
                    </div>
<br>
                    <table class="table table-bordered table-hover" style="color: #eb5527; width:330px; margin-left:1px; margin-top:35px; float:center;" align="center">
                        <thead>
                            <tr style="font-size: 12px">
                                <th>No</th>
                                <th width="150px">Produk</th>
                                <th class="text-center" >Jumlah</th>
                                <th width="60px" class="text-center">Subtotal</th>
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
                            <tr style="font-size: 10px">
                                @php
                                    $j = $i;
                                    $total += $priceArray[$i] * $amountArray[$i];
                                @endphp
                                <td style="text-align: center">{{$i+1}}</td>
                                <td>{{$productArray[$i]}}</td>
                                <td style="text-align: center">{{$amountArray[$i]}}</td>
                                <td style="text-align: center">@currency($priceArray[$i] * $amountArray[$i])</td>
                            </tr>
                            @endfor
                            <tr style="font-size: 10px">
                                <td style="text-align: center">{{$j+2}}</td>
                                <td colspan="2">Biaya Pengiriman</td>
                                <td style="text-align: center">@currency($order->total-$total)</td>
                            </tr>
                        </tbody>
                    </table><br><br><br>

                    <table border="1" style="color: #219E39; width:330px; margin-left:1px; margin-top:40px; float:center;" align="center">
                        <thead>
                            <tr style="font-size: 10px">
                                <th><strong>Total Pembayaran</strong></th>
                                <th width="150px"></th>
                                <th class="text-center" ></th>
                                <th width="60px" class="text-center"><strong>@currency($order->total)</strong></th>
                            </tr>
                        </thead>
                    </table>

                    <p style="margin-top: 60px; font-size: 10px;">
                        Biaya pengiriman dapat berubah sewaktu-waktu. Jumlah pembayaran yang dibayar disesuaikan dengan biaya pada saat Waktu Pembayaran.
                    </p><br>
                    <table border="1" style="color: #f01d1d; margin-top:-155px; float:center;" align="center">
                        <thead>
                            <tr>
                                <th>Segera Periksa Pesanan sebelum kurir meninggalkan anda</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </main>
    </body>

</html>