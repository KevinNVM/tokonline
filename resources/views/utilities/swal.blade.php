<script>
    swal.fire({
        icon: '{{ $icon ?? '' }}',
        title: '{{ $title ?? '' }}',
        text: '{{ $text ?? '' }}',
    });
</script>
