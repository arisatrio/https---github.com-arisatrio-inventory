@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Laporan PO
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
            <li class="breadcrumb-item active">Laporan PO</li>
        @endslot
        @slot('content')
            <x-admin.data-table-component id="table">
                @slot('header')
                @endslot
                @slot('filter')
                @endslot
                @slot('columns')
                    <th>No. PO</th>
                    <th>No. Surat Jalan</th>
                    <th>Tanggal</th>
                    <th>Tanggal Kirim</th>
                    <th>Grand Total (Rp)</th>
                    <th>Customer</th>
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
                {data: 'no_po', name: 'no_po'},
                {data: 'no_surat_jalan', name: 'no_surat_jalan'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'tanggal_kirim', name: 'tanggal_kirim'},
                {data: 'grand_total', name: 'grand_total'},
                {data: 'created_by', name: 'created_by'},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center'},
            ]
        });
        
        $('#status').on('change', function() {
            table.draw();
        });
    </script>

@endpush