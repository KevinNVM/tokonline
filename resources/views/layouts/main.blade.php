<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    @include('resource.swal')
    @include('resource.icons')
    <link rel="stylesheet" href="/css/bootstrap5.css">
    <link rel="stylesheet" href="/css/jquery-ui.css">
    <link rel="stylesheet" href="/css/hover.css">
    <link rel="stylesheet" href="/css/color.css">
    <link rel="stylesheet" href="/css/autocomplete.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery-ui.js"></script>
    <script src="/js/bootstrap5.js"></script>
    @include('utilities.autocomplete')
    @stack('head')
    <title>{{ $title ?? '' }} · E-Comm</title>
</head>

<body>
    @yield('content')
    @stack('script')


    <script src="/js/mobile-check.js"></script>
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

        function hotkeys() {
            $('header').on('keydown', function(e) {
                if (e.code === 'KeyK' || e.which === 191) {
                    e.preventDefault();
                    $('#search').focus()
                } else if (e.which === 27) {
                    $('#search').blur()
                }
            });
        }
        hotkeys();

        if (mobileCheck()) {
            $('#topbar').removeClass('fixed-top')
        } else {
            $('#bottombar').remove()
        }
    </script>
    @if (session('alert'))
        <script>
            swal.fire({
                text: '{{ session('alert') }}'
            })
        </script>
    @endif
    @if (session('msg'))
        <script>
            swal.fire({
                text: '{{ session('msg')['body'] ?? '' }}',
                icon: '{{ session('msg')['status'] ?? '' }}',
                title: '{{ session('msg')['title'] ?? '' }}'
            })
        </script>
    @endif
</body>

</html>
