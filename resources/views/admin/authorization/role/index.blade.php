@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Roles
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Roles</li>
        @endslot
        @slot('content')
            <x-admin.data-table-component id="table">
                @slot('header')
                    <button class="btn btn-success my-2 btn-md" onclick="create()"><i class="fa fa-plus"></i> Create</button>
                @endslot
                @slot('filter')
                    <div class="row">
                        <div class="col-sm-5 col-md-3">
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-md-4 col-form-label">Status</label>
                                <div class="col-sm-5 col-md-8">
                                    <select name="status" id="status" class="form-control">
                                        <option value="All">All</option>
                                        <option value="Active">Active</option>
                                        <option value="Inctive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                @endslot
                @slot('columns')
                    <th>Name</th>
                    <th>Status</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.layout-component>
    <x-admin.modal-form-component>
        @slot('modalBody')
            <form action="" id="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
                <input type="hidden" name="id" id="id">
            </form>
        @endslot
    </x-admin.modal-form-component>
@endsection

@push('js')
    <script>
        let table = $('#table').DataTable({
            responsive: true,
            autoWidth: false,
            serverSide: true,
            ajax: '',
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'status',
                    name: 'status',
                    class: 'text-center',
                    orderable: false,
                    searchable: false,
                    width: '10%'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                    width: '20%'
                }
            ]
        })

        function destroy(id) {
            Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        var url = "{{ route('user-management.role.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        $.ajax({
                            url: url,
                            type: "DELETE",
                            data: {
                                "id": id
                            },
                            dataType: "JSON",
                            success: function(data) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: "Data Succesfully Deleted",
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,
                                });
                                table.ajax.reload()
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert('Error deleting data');
                            }
                        });
                    }
                });
        }

        function restore(id) {
            Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        var url = "{{ route('user-management.role.restore', ':id') }}";
                        url = url.replace(':id', id);

                        $.ajax({
                            url: url,
                            type: "GET",
                            success: function(data) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: "Data Succesfully Restored",
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,
                                });
                                table.ajax.reload()
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert('Error restoring data');
                            }
                        });
                    }
                });
        }
    </script>
    <script>
        $('#status').change(function() {
            table.ajax.url("{{ route('user-management.role.index') }}" + "?status=" + $(this).val()).load()
        });
    </script>

    @if (session('success'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif
@endpush
@include('admin.authorization.role.create')
