@extends('layouts.main')

@section('content')
    @include('layouts.navbar-light')
    <main class="py-3" style="margin-top: 4em; min-height: 85vh;">
        <div class="container">
            @include('utilities.breadcrumb')

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card border-0 shadow">
                        <form action="/login" method="POST">
                            @csrf
                            <div class="card-body">
                                <h5 class="fw-semibold text-muted text-center">Login</h5>

                                @if (session()->has('msg'))
                                    <div class="alert alert-{{ session('msg')['status'] }} alert-dismissible fade show"
                                        role="alert">
                                        {{ session('msg')['body'] }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger pt-4 my-2">
                                        <h6 class="fw-semibold">Error!</h6>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="login">Email or Username</label>
                                    <input type="text" name="login" id="login"
                                        class="form-control @error('login') is-invalid @enderror">
                                </div>
                                <div class="mb-1">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('login') is-invalid @enderror">
                                        <label for="show_pass" class="px-2 py-1 btn link-outline rounded-end">
                                            <i class="fa-solid fa-eye"></i>
                                        </label>
                                    </div>
                                    <input type="checkbox" id="show_pass" hidden>
                                </div>
                                <div class="mb-3 d-flex justify-content-between">
                                    <div>
                                        <input type="checkbox" name="remember" id="remember" checked>
                                        <label for="remember" class="user-select-none">Remember Me</label>
                                    </div>
                                    <a href="/forgot" class="link">Forgot Password</a>
                                </div>
                                <div class="d-grid mb-3">
                                    <button class="btn btn-primary my-1">Login</button>
                                    <a class="btn btn-outline-primary my-1" href="/register">Create Account</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $('input#show_pass').click(function() {
            if ($('input#password').attr('type') === 'password') {
                $('label[for=show_pass]').html('<i class="fa-solid fa-eye-slash"></i>');
                $('input#password').attr('type', 'text');
            } else {
                $('label[for=show_pass]').html('<i class="fa-solid fa-eye"></i>');
                $('input#password').attr('type', 'password');
            }
        });
    </script>
@endsection
