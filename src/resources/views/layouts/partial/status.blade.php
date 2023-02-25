@if (Session::has('success'))
<script>
    Swal.fire(
        '{{ __("message.success") }}',
        '{{ __(Session::get("success")) }}',
        'success'
    )
</script>
@endif