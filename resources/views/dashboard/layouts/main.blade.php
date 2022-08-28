<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="_token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} - EComm</title>
    <link href="/css/dashboard.style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="/js/jquery.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('head')
</head>

<body class="sb-nav-fixed">
    @include('dashboard.layouts.topnav')
    <div id="layoutSidenav">
        @include('dashboard.layouts.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <h4 class="p-3" style="font-weight: 600">Welcome Back, {{ $user->name ?? 'User' }}</h4>
                @yield('main')
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; {{ Str::ucfirst(env('APP_NAME')) ?? 'Website' }}
                            {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="/js/bootstrap5.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {

            // Toggle the side navigation
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                // Uncomment Below to persist sidebar toggle between refreshes
                // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                //     document.body.classList.toggle('sb-sidenav-toggled');
                // }
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains(
                        'sb-sidenav-toggled'));
                });
            }

        });
    </script>
    @if (session('alert'))
        <script>
            swal.fire({
                text: "{{ session('alert') }}"
            })
        </script>
    @endif
    @stack('foot')
</body>

</html>
