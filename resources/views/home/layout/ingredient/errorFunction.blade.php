@if($message = session("error"))
<script>
    $(document).ready(function() {
        Swal.fire(
            'Lỗi',
            '{{$message}}',
            'error'
        )
    });
</script>
@endif

@if($message = session("success"))
<script>
    $(document).ready(function() {
        Swal.fire(
            'Thành công',
            '{{$message}}',
            'success'
        )
    });
</script>
@endif

@if ($errors->any())

<script>
    $(document).ready(function() {
        Swal.fire(
            'Lỗi',
            'Vui lòng kiểm tra lại',
            'error'
        )
    });
</script>
@endif