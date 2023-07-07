@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Tipe Produk
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Gudang</a></li>
            <li class="breadcrumb-item active">Tipe Produk</li>
        @endslot
        @slot('content')
            <x-admin.data-table-component id="table">
                @slot('header')
                    <button class="btn btn-success my-2 btn-md" onclick="create()"><i class="fa fa-plus"></i> Tambah</button>
                @endslot
                @slot('filter')
                    <div class="row">
                        <div class="col-sm-5 col-md-3">
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-md-4 col-form-label">Status</label>
                                <div class="col-sm-5 col-md-8">
                                    <select name="status" id="status" class="form-control">
                                        <option value="All" selected>All</option>
                                        <option value="Active">Active</option>
                                        <option value="Inctive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                @endslot
                @slot('columns')
                    <th>Produk</th>
                    <th>Tipe</th>
                    <th>Ukuran</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.layout-component>

    <x-admin.modal-form-component>
        @slot('modalBody')
            <form action="" id="form">
                <div class="form-group">
                    <label for="">Produk <span class="text-danger">*</span></label>
                    <select name="produk_id" id="produk_id" class="form-control">
                        <option selected disabled hidden>-- Pilih Produk --</option>
                        @foreach ($produks as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tipe Produk <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Tipe Produk">
                </div>
                <div class="form-group">
                    <label for="">Ukuran</label>
                    <input type="text" name="ukuran" id="ukuran" class="form-control" placeholder="Ukuran">
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" placeholder="Harga">
                </div>
                <input type="hidden" id="id" name="id">
            </form>
        @endslot
    </x-admin.modal-form-component>
@endsection
@include('gudang.tipe.script')