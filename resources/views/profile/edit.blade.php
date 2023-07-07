@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Profile
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        @endslot
        @slot('content')
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if (auth()->user()->photo == 'avatar.png')
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('asset_template/dist/img/avatar.png') }}" alt="User profile picture">
                                @else
                                    <img src="{{ asset('storage/user/' . auth()->user()->photo) }}"
                                        class="img-circle elevation-2" alt="User profile picture" width="200px">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>

                            <p class="text-muted text-center">{{ auth()->user()->roles->pluck('name')->implode(', ') }}</p>
                            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#updatePhotoModal">Update
                                Photo</button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#about-me" data-toggle="tab">About Me</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#update-password" data-toggle="tab">Update
                                        Password</a></li>
                                <li class="nav-item"><a class="nav-link" href="#update-profile" data-toggle="tab">Update
                                        Profile</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="about-me">
                                    <div class="card-body">
                                        <strong>Name</strong>

                                        <p class="text-muted">
                                            {{ auth()->user()->name }}
                                        </p>

                                        <hr>

                                        <strong> Username</strong>

                                        <p class="text-muted">{{ auth()->user()->username }}</p>

                                        <hr>

                                        <strong> Email</strong>

                                        <p class="text-muted">{{ auth()->user()->email }}</p>

                                        <hr>

                                        <strong>Roles</strong>

                                        <p class="text-muted">
                                            <span
                                                class="tag tag-success">{{ auth()->user()->roles->pluck('name')->implode(', ') }}</span>
                                        </p>

                                        <hr>

                                        <strong> Department</strong>

                                        <p class="text-muted">{{ auth()->user()->department->name }}</p>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="update-password">
                                    <form class="form-horizontal" id="form-update-password">
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="new-pasword" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="new_password"
                                                    name="new_password" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password-confirmation" class="col-sm-2 col-form-label">Password
                                                Confirmation</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" placeholder="Password Confirmation">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success"
                                                    onclick="update_password()">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="update-profile">
                                    <form class="form-horizontal" id="form-update-profile">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ auth()->user()->name }}" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ auth()->user()->email }}" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="username" name="username"
                                                    value="{{ auth()->user()->username }}" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">Roles</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="roles[]" id="roles" multiple>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Department</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="department_id" id="department_id">
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}"
                                                            @if (auth()->user()->department_id == $department->id) selected @endif>
                                                            {{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" onclick="update_profile()"
                                                    class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        @endslot

    </x-admin.layout-component>

    {{-- modal update photo --}}
    <div class="modal fade" id="updatePhotoModal" aria-labelledby="updatePhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePhotoModalLabel">Update Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control"
                                placeholder="Photo">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="update_photo()">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('asset_template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('asset_template/plugins/select2/js/select2.min.js') }}"></script>

    <script>
        //Initialize Select2 Elements
        $('#roles').select2({
            theme: 'bootstrap4',
        })

        $('#department_id').select2({
            theme: 'bootstrap4'
        })
        let roles = @json(auth()->user()->roles->pluck('id'));
        $('#roles').val(roles).trigger('change');


        function update_profile() {
            event.preventDefault();
            $.ajax({
                url: "{{ route('profile.update') }}",
                type: "PUT",
                data: $('#form-update-profile').serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                    })
                },
                error: function(data, xhr, textStatus, errorThrown) {
                    let error_message = '<ul>';
                    $.each(data.responseJSON.errors, function(key, value) {
                        error_message += '<li>' + value + '</li>';
                    });
                    error_message += '</ul>';
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        html: error_message,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    })
                }
            });
        }

        function update_password() {
            event.preventDefault();
            $.ajax({
                url: "{{ route('profile.update-password') }}",
                type: "PUT",
                data: $('#form-update-password').serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                    })
                },
                error: function(data, xhr, textStatus, errorThrown) {
                    let error_message = '<ul>';
                    $.each(data.responseJSON.errors, function(key, value) {
                        error_message += '<li>' + value + '</li>';
                    });
                    error_message += '</ul>';
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        html: error_message,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    })
                }
            });
        }

        function update_photo() {
            event.preventDefault();
            var formData = new FormData();
            formData.append('photo', $('#photo').prop('files')[0]);
            $.ajax({
                url: "{{ route('profile.update-photo') }}",
                type: "POST",
                dataType: 'JSON',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                    }).then((result) => {
                        location.reload();
                        $('#form-update-photo').trigger('reset');
                    })
                },
                error: function(data, xhr, textStatus, errorThrown) {
                    let error_message = '<ul>';
                    $.each(data.responseJSON.errors, function(key, value) {
                        error_message += '<li>' + value + '</li>';
                    });
                    error_message += '</ul>';
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        html: error_message,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    })
                }
            });
        }
    </script>
@endpush
