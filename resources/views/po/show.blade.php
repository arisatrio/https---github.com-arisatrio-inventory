@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Purchase Order
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Purchase Order</a></li>
            <li class="breadcrumb-item"><a href="{{ route('po.order.index') }}">List PO</a></li>
            <li class="breadcrumb-item active">Detail PO</li>
        @endslot
        @slot('content')

            <div class="invoice p-3 mb-3">

                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-globe"></i> PT. ALIA JAYA ANUGRAH
                            <small class="float-right">Tanggal: {{ $order->tanggal }}</small>
                        </h4>
                    </div>
                </div>
            
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address> 
                            <strong class="text-uppercase">{{ $order->createdBy->name }}</strong><br>
                            {{ $order->createdBy->address }}<br>
                            Phone: {{ $order->createdBy->phone }}<br>
                            Email: {{ $order->createdBy->email }}
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                    </div>
            
                    <div class="col-sm-4 invoice-col float-right">
                        <br>
                        No. PO: <b>{{ $order->no_po }}</b><br>
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
                                    <th>Harga (Rp)</th>
                                    <th>Subtotal (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $isStokProdukKurang = false;
                                @endphp
                                @foreach ($order->orderProducts as $prod)
                                <tr
                                    @hasrole('Admin Gudang')
                                        @if ($prod->produkTipe->stok < $prod->qty)
                                            class="bg-danger"
                                            @php
                                                $isStokProdukKurang = true;
                                            @endphp
                                        @else
                                            class="bg-success"
                                        @endif
                                    @endhasrole
                                >
                                    <td>{{ $prod->produkTipe->produk->name }} {{ $prod->produkTipe->name }} {{ $prod->produkTipe->ukuran }}</td>
                                    <td>{{ $prod->produkTipe->produk->satuan }}</td>
                                    <td>{{ $prod->qty }}</td>
                                    <td>{{ $prod->harga }}</td>
                                    <td>{{ number_format($prod->sub_total, 3) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-6">
                        @hasrole('Admin Gudang')
                        <button class="btn btn-danger"></button> 
                        <span>Stok produk kurang atau tidak tersedia! 
                            <a href="{{ route('gudang.stok-produk.index') }}">
                                Tambah stok produk
                                <i class="fa fa-external-link-alt"></i>
                            </a>
                        </span>
                        @endhasrole
                    </div>
            
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>{{ number_format($order->total, 3) }}</td>
                                    </tr>
                                    <tr>
                                        <th>PPN (11%)</th>
                                        <td>{{ number_format($order->ppn, 3) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Grand Total:</th>
                                        <td>{{ number_format($order->grand_total, 3) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            
            
                <div class="row no-print">
                    <div class="col-12">
                        <a href="{{ route('po.order.print', $order->id) }}" rel="noopener" target="_blank" class="btn btn-default">
                            <i class="fas fa-print"></i> Print PO
                        </a>
                        @if ($order->status === 'DELIVERY ORDER')
                            <a href="{{ route('po.order.print-delivery', $order->id) }}" rel="noopener" target="_blank" class="btn btn-default">
                                <i class="fas fa-print"></i> Print Surat Jalan
                            </a>
                        @endif
                        @hasrole('Admin')
                        @if ($order->status === 'INPUT')
                            <a href="{{ route('po.order.send-to-logistik', $order->id) }}" class="btn btn-success float-right">
                                <i class="fa fa-paper-plane"></i> 
                                Kirim ke Logistik
                            </a>
                        @endif
                        @endhasrole
                        @hasrole('Admin Logistik')
                        <a href="{{ route('po.order.send-to-logistik', $order->id) }}" class="btn btn-success float-right">
                            <i class="fa fa-paper-plane"></i> 
                            Kirim ke Gudang
                        </a>
                        @endhasrole
                        @hasrole('Admin Gudang')
                            @if ($isStokProdukKurang)
                                
                                <a href="{{ route('po.order.cancel', $order->id) }}" class="btn btn-outline-danger float-right mr-2">
                                    Cancel
                                </a>
                            @else
                                <a href="{{ route('po.order.delivery', $order->id) }}" 
                                    class="btn btn-success float-right"
                                >
                                    <i class="fa fa-paper-plane"></i> 
                                    Delivery Order
                                </a>
                            @endif
                        @endhasrole
                    </div>
                </div>
            </div>
        @endslot
    </x-admin.layout-component>
@endsection