@push('js')
    <script>
        function create() {
            $('.modal-title').text('Create Department')
            $('#exampleModal').modal('show')
            $('#form').trigger('reset')
        }

        function store() {
            $.ajax({
                url: "{{ route('user-management.department.store') }}",
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
            let url = "{{ route('user-management.department.edit', ':id') }}"
            url = url.replace(":id", id)
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    $('.modal-title').text('Edit Department')
                    $('#exampleModal').modal('show')

                    $('#name').val(data.data.name)
                    $('#code').val(data.data.code)
                    $('#description').val(data.data.description)
                    $('#id').val(data.data.id)
                }
            })
        }
    </script>
@endpush
