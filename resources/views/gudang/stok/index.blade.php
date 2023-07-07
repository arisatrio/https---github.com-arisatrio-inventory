@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Stok Produk
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Gudang</a></li>
            <li class="breadcrumb-item active">Stok Produk</li>
        @endslot
        @slot('content')
            <x-admin.data-table-component id="table">
                @slot('header')
                    <button class="btn btn-success my-2 btn-md" onclick="create()"><i class="fa fa-plus"></i> Tambah Stok Masuk</button>
                @endslot
                @slot('filter')
                @endslot
                @slot('columns')
                    <th>Tanggal</th>
                    <th>Nama Produk</th>
                    <th>Stok Masuk</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.layout-component>

    <x-admin.modal-form-component>
        @slot('modalBody')
            <form action="" id="form">
                <div class="form-group">
                    <label for="">Produk <span class="text-danger">*</span></label>
                    <select name="produk_tipe_id" id="produk_tipe_id" class="form-control">
                        <option selected disabled hidden>-- Pilih Produk --</option>
                        @foreach ($produks as $item)
                            <option value="{{ $item->id }}">{{ $item->produk->name }} {{ $item->name }} {{ $item->ukuran }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal">
                </div>
                <div class="form-group">
                    <label for="">Stok Masuk <span class="text-danger">*</span></label>
                    <input type="number" name="stok_masuk" id="stok_masuk" class="form-control" placeholder="Stok Masuk">
                </div>
                <input type="hidden" id="id" name="id">
            </form>
        @endslot
    </x-admin.modal-form-component>
@endsection
@include('gudang.stok.script')