@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Purchase Order
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Purchase Order</a></li>
            <li class="breadcrumb-item active">List PO</li>
        @endslot
        @slot('content')
            <x-admin.data-table-component id="table">
                @slot('header')
                @endslot
                @slot('filter')
                @endslot
                @slot('columns')
                    <th>Tanggal</th>
                    <th>No. PO</th>
                    <th>Customer</th>
                    <th>Status</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.layout-component>
@endsection
@include('po.script')