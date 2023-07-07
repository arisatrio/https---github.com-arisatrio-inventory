<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Invoice Print</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('asset_template/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="{{ asset('asset_template/dist/css/adminlte.min.css') }}">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <div class="invoice p-3 mb-3">

    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-globe"></i> PT. ALIA JAYA ANUGRAH
                <small class="float-right">Tanggal: {{ $order->tanggal_kirim }}</small>
            </h4>
        </div>
    </div>

    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            To
            <address> 
                <strong class="text-uppercase">{{ $order->createdBy->name }}</strong><br>
                {{ $order->createdBy->address }}<br>
                Phone: {{ $order->createdBy->phone }}<br>
                Email: {{ $order->createdBy->email }}
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
        </div>

        <div class="col-sm-4 invoice-col">
            <br>
            Surat Jalan No: <b>0{{ $order->id }}</b><br>
        </div>
    </div>


    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Satuan</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderProducts as $prod)
                    <tr>
                        <td>{{ $prod->produkTipe->produk->name }} {{ $prod->produkTipe->name }}</td>
                        <td>{{ $prod->produkTipe->produk->satuan }}</td>
                        <td>{{ $prod->qty }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-3 text-center">
            <p>Tanda Terima</p>
            <br>
            <br>
            <u><b>{{ $order->createdBy->name }}</b></u>
        </div>
        <div class="col-3 text-center">
            <p>Logistik</p>
            <br>
            <br>
            <u><b>{{ $order->logistikBy->name }}</b></u>
        </div>
        <div class="col-3 text-center">
            <p>Gudang</p>
            <br>
            <br>
            <u><b>{{ $order->gudangBy->name }}</b></u>
        </div>
        <div class="col-3 text-center">
            <p>Hormat Kami</p>
            <br>
            <br>
            <u><b>PT. Alia Jaya Anugrah</b></u>
        </div>
    </div>
</div>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
