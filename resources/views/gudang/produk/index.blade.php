@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Produk
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Gudang</a></li>
            <li class="breadcrumb-item active">Produk</li>
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
                    <th>Merk</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Satuan</th>
                    <th>Status</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.layout-component>

    <x-admin.modal-form-component>
        @slot('modalBody')
            <form action="" id="form">
                <div class="form-group">
                    <label for="">Merk <span class="text-danger">*</span></label>
                    <input type="text" name="merk" id="merk" class="form-control" placeholder="Merk">
                </div>
                <div class="form-group">
                    <label for="">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama Produk">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Satuan <span class="text-danger">*</span></label>
                    <select name="satuan" id="satuan" class="form-control">
                        <option value="batang">Batang</option>
                        <option value="pcs">Pcs</option>
                    </select>
                </div>
                <input type="hidden" id="id" name="id">
            </form>
        @endslot
    </x-admin.modal-form-component>
@endsection
@include('gudang.produk.script')