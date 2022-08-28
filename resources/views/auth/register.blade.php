@extends('layouts.main')

@section('content')
    @include('layouts.navbar-light')
    <main class="py-3" style="margin-top: 4em; min-height: 85vh;">
        <div class="container">
            @include('utilities.breadcrumb')

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card border-0 shadow">
                        <form action="/register" method="POST">
                            @csrf
                            <div class="card-body">
                                <h5 class="fw-semibold text-muted text-center">Register</h5>

                                @if (session('msg'))
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
                                    <label for="name">Fullname</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}">
                                </div>
                                <div class="mb-1">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror">
                                        <label for="show_pass" class="px-2 py-1 btn link-outline rounded-end">
                                            <i class="fa-solid fa-eye"></i>
                                        </label>
                                    </div>
                                    <input type="checkbox" id="show_pass" hidden>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="confirm_password" id="password2"
                                            class="form-control @error('password') is-invalid @enderror">
                                        <label for="show_pass" class="px-2 py-1 btn link-outline rounded-end">
                                            <i class="fa-solid fa-eye"></i>
                                        </label>
                                    </div>
                                    <input type="checkbox" id="show_pass" hidden>
                                </div>
                                <div class="d-grid mb-3">
                                    <button class="btn btn-primary my-1">Register</button>
                                    <a class="btn btn-outline-primary my-1" href="/login">Sign In With Existing
                                        Account</a>
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
                $('input#password2').attr('type', 'text');
            } else {
                $('label[for=show_pass]').html('<i class="fa-solid fa-eye"></i>');
                $('input#password').attr('type', 'password');
                $('input#password2').attr('type', 'password');
            }
        });
    </script>
@endsection
