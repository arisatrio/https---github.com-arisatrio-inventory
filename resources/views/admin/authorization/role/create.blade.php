@push('js')
    <script>
        function create() {
            $('#exampleModal').modal('show')
            $('#form').trigger('reset')
            $('.modal-title').text("Create Role")
        }

        function store() {
            $.ajax({
                url: "{{ route('user-management.role.store') }}",
                type: "POST",
                data: $('#form').serialize(),
                success: function(response) {
                    $('#exampleModal').modal('hide')
                    $('#form').trigger('reset')
                    $('#table').DataTable().ajax.reload()

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
                    let error_messages = '<ul>';
                    $.each(data.responseJSON.errors, function(key, value) {
                        error_messages += '<li>' + value + '</li>';
                    });
                    error_messages += '</ul>';

                    Swal.fire({
                        title: 'Error!',
                        html: error_messages,
                        icon: 'error',
                        showConfirmButton: true,
                    })
                }
            })
        }

        function edit(id){
            $.ajax({
                url: "{{ route('user-management.role.edit', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#exampleModal').modal('show')
                    $('.modal-title').text("Edit Roles")
                    $('#id').val(data.data.id)
                    $('#name').val(data.data.name)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function destroy(id){
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
    </script>
@endpush
