<div class="card card-warning card-outline">
    <div class="card-header">
       {{ $header }}
    </div>
    <div class="card-body">
        {{ $filter }}
        <table id="{{ $id }}" class="table table-bordered table-hover">
            <thead class="bg-secondary">
                <tr>
                    <th style="width: 5%">No</th>
                    {{ $columns }}
                    <th style="width: 10%" class="text-center">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@push('css')
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('asset_template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('asset_template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
@endpush
