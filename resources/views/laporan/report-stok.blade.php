@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Laporan Stok
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
            <li class="breadcrumb-item active">Laporan Stok</li>
        @endslot
        @slot('content')
            <x-admin.data-table-component id="table">
                @slot('header')
                @endslot
                @slot('filter')
                @endslot
                @slot('columns')
                    <th>Produk</th>
                    <th>Stok Masuk</th>
                    <th>Stok Keluar</th>
                    <th>Stok Gudang</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.layout-component>
@endsection

@push('js')
    <script>
        let table = $('#table').DataTable({
            responsive: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '',
                data: function (d) {
                    d.status        = $('#status').val();
                }
            },
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'produk', name: 'produk'},
                {data: 'stok_masuk', name: 'stok_masuk'},
                {data: 'stok_keluar', name: 'stok_keluar'},
                {data: 'stok', name: 'stok'},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center', visible: false},
            ]
        });
        
        $('#status').on('change', function() {
            table.draw();
        });
    </script>

@endpush