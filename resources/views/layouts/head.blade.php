<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sistem Inventory</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('/asset_template/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('asset_template/dist/css/adminlte.min.css') }}">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('asset_template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('asset_template/plugins/toastr/toastr.min.css') }}">
{{-- csrf --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- pace --}}
<link rel="stylesheet" href="{{ asset('asset_template/plugins/pace-progress/themes/yellow/pace-theme-flash.css') }}">

@stack('css')
