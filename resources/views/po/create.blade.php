@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Buat PO
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Purchase Order</a></li>
            <li class="breadcrumb-item active">Buat PO</li>
        @endslot
        @slot('content')
            <div class="card card-warning card-outline">
                <h4 class="card-header">
                    Form Purchase Order
                </h4>
                <div class="card-body">
                    <form action="{{ route('po.order.store') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <div class="col-2">
                                <label for="">Tanggal</label>
                            </div>
                            <input type="date" class="form-control col-10" name="tanggal">
                        </div>

                        <div class="form-group row">
                            <div class="col-2">
                                <label for="">No. PO</label>
                            </div>
                            <input type="text" class="form-control col-10" name="no_po">
                        </div>

                        <div class="form-group row">
                            <div class="col-2">
                                <label for="">Customer</label>
                            </div>
                            <input type="text" class="form-control col-10" value="{{ auth()->user()->name }}" disabled>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('po.order.index') }}" class="btn btn-outline-danger">Cancel</a>
                        <button type="submit" class="btn btn-success">Simpan PO & Tambah Produk</button>
                    </div>
                </form>
            </div>
        @endslot
    </x-admin.layout-component>
@endsection