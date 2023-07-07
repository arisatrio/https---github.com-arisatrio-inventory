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
                    Form Purchase Order Produk
                </h4>
                <div class="card-body">
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
                    </div>

                    <x-admin.data-table-component id="table">
                        @slot('header')
                            <button class="btn btn-success my-2 btn-md" onclick="create()"><i class="fa fa-plus"></i> Tambah</button>
                        @endslot
                        @slot('filter')
                        @endslot
                        @slot('columns')
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga (Rp)</th>
                            <th>Subtotal (Rp)</th>
                        @endslot
                    </x-admin.data-table-component>

                    <div class="row">
                        <div class="col-6"></div>
                
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

                    <a href="{{ route('po.order.index') }}" class="btn btn-success float-right">Simpan</a>
                </div>
            </div>
        @endslot
    </x-admin.layout-component>

    <x-admin.modal-form-component>
        @slot('modalBody')
            <form action="" id="form">
                <div class="form-group">
                    <label for="">Nama Produk <span class="text-danger">*</span></label>
                    <select name="produk_tipe_id" id="produk_tipe_id" class="form-control">
                        <option selected disabled hidden>-- Pilih Produk --</option>
                        @foreach ($produks as $prod)
                            <option value="{{ $prod->id }}">{{ $prod->produk->name }} {{ $prod->name }} {{ $prod->ukuran }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Qty <span class="text-danger">*</span></label>
                    <input type="number" name="qty" id="qty" class="form-control" placeholder="Qty">
                </div>
                <input type="hidden" id="order_id" name="order_id" value="{{ $order->id }}">
                <input type="hidden" id="id" name="id">
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
            ajax: {
                url: '',
                data: function (d) {
                    d.status        = $('#status').val();
                }
            },
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'produk', name: 'produk'},
                {data: 'qty', name: 'qty'},
                {data: 'harga', name: 'harga'},
                {data: 'sub_total', name: 'sub_total'},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center'},
            ]
        });
        
        $('#status').on('change', function() {
            table.draw();
        });
    </script>
    <script>
        function create() {
            $('.modal-title').text('Tambah Produk')
            $('#exampleModal').modal('show')
            $('#form').trigger('reset')
        }

        function edit(id) {
            let url = "{{ route('po.order-produk.edit', ':id') }}"
            url = url.replace(":id", id)
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    $('.modal-title').text('Edit Produk')
                    $('#exampleModal').modal('show')

                    $('#produk_tipe_id').val(data.data.produk_tipe_id)
                    $('#qty').val(data.data.qty)
                    $('#order_id').val(data.data.order_id)
                    $('#id').val(data.data.id)
                }
            })
        }

        function store() {
            $.ajax({
                url: "{{ route('po.order-produk.store') }}",
                type: "POST",
                dataType: "JSON",
                data: $('#form').serialize(),
                success: function(data) {
                    $('#exampleModal').modal('hide')
                    table.ajax.reload(null, false)
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data has been saved!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                    });
                    window.location.reload()
                },
                error: function(data) {
                    let error_messages = '<ul>'
                    $.each(data.responseJSON.errors, function(key, value) {
                        error_messages += '<li>' + value + '</li>'
                    })
                    error_messages += '</ul>'
                    Swal.fire({
                        title: 'Error!',
                        html: error_messages,
                        icon: 'error',
                        showConfirmButton: true,
                    })
                }
            })
        }


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
                        var url = "{{ route('po.order-produk.destroy', ':id') }}";
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
                                table.ajax.reload(null, false)
                                window.location.reload()
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert('Error deleting data');
                            }
                        });
                    }
                });
        }
    </script>
@endpush