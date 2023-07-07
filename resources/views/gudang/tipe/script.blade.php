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
                {data: 'produk', name: 'produk.name'},
                {data: 'name', name: 'name'},
                {data: 'ukuran', name: 'ukuran'},
                {data: 'harga', name: 'harga'},
                {data: 'sum_stok', name: 'sum_stok'},
                {data: 'status', name: 'status', class: 'text-center', width: '10%', orderable: false,},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center'},
            ]
        });

        $('#status').on('change', function() {
            table.draw();
        });
    </script>
    <script>
        function create() {
            $('.modal-title').text('Tambah Tipe Produk')
            $('#exampleModal').modal('show')
            $('#form').trigger('reset')
        }

        function store() {
            $.ajax({
                url: "{{ route('gudang.tipe-produk.store') }}",
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
                    })
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

        function edit(id) {
            let url = "{{ route('gudang.tipe-produk.edit', ':id') }}"
            url = url.replace(":id", id)
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    $('.modal-title').text('Edit Produk')
                    $('#exampleModal').modal('show')

                    $('#produk_id').val(data.data.produk_id)
                    $('#name').val(data.data.name)
                    $('#ukuran').val(data.data.ukuran)
                    $('#harga').val(data.data.harga)
                    $('#id').val(data.data.id)
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
                        var url = "{{ route('gudang.tipe-produk.destroy', ':id') }}";
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