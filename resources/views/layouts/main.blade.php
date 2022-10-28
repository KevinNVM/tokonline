<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @include('resource.swal')
    @include('resource.icons')
    <link rel="stylesheet" href="/css/bootstrap5.css">
    <link rel="stylesheet" href="/css/jquery-ui.css">
    <link rel="stylesheet" href="/css/hover.css">
    <link rel="stylesheet" href="/css/color.css">
    <link rel="stylesheet" href="/css/autocomplete.css">
    <link rel="stylesheet" href="/css/modal.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery-ui.js"></script>
    <script src="/js/bootstrap5.js"></script>
    @include('utilities.autocomplete')
    <style>
        main {
            margin-top: 4rem;
            margin-bottom: 4rem;
        }

        @media only screen and (max-width: 768px) {
            main {
                margin-top: 0;
            }
        }

        @media print {
            main {
                margin-top: 0;
            }
        }
    </style>
    @stack('head')
    <title>{{ $title ?? '' }} · E-Comm</title>
</head>

<body>
    @include('utilities.pre-loader')
    @yield('content')
    @stack('script')


    <script src="/js/mobile-check.js"></script>
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));



        // if (mobileCheck()) {
        //     $('#topbar').removeClass('fixed-top')
        // } else {
        //     $('#bottombar').remove()
        // }
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
    <script>
        if (mobileCheck()) {
            $('.modal-dialog').remove()
        }
    </script>
</body>

</html>
