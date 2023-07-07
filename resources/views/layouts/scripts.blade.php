<!-- jQuery -->
<script src="{{ asset('asset_template/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('asset_template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('asset_template/dist/js/adminlte.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('asset_template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('asset_template/plugins/toastr/toastr.min.js') }}"></script>
{{-- pace --}}
<script src="{{ asset('asset_template/plugins/pace-progress/pace.min.js') }}"></script>
{{-- datatable --}}
{{-- csrf --}}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stack('js')
