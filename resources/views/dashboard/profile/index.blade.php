@extends('dashboard.layouts.main')

@push('head')
    <link rel="stylesheet" href="/css/hover.css">
    <link rel="stylesheet" href="/css/color.css">
    <style>
        #imageWrapper {
            transition: all 300ms;
        }

        #imageWrapper:hover {
            transform: scale(1.1);
        }
    </style>
@endpush

@push('foot')
    <script>
        const imgInp = document.querySelector('#image'),
            img = document.querySelector('#imagePreview')
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                img.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush

@section('main')
    <main>
        <div class="container-fluid mt-4">

            @include('utilities.breadcrumb', ['title' => "User's Profile"])

            <div class="card shadow-hover">
                <div class="card-header">
                    <h5 class="fw-bold">
                        User's Profile
                    </h5>
                </div>
                <div class="card-body">
                    @if ($errors->count())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Update Failed!</strong>
                            <ul>
                                @foreach ($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('profile.update', $user->username) }}" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <section class="py-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="fs-6 fw-semibold">
                                    Profile Picture
                                </div>
                                <div class="fs-6 fw-semibold">
                                    <label for="image">
                                        <div class="p-1 border rounded d-flex justify-content-center" role="button"
                                            id="imageWrapper">
                                            <img src="{{ asset('storage/images/profiles/' . $user->image) }}"
                                                id="imagePreview" alt="Profile Picture" width="100">
                                        </div>
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </label>
                                    <input id="image" type="file" name="image" class="visually-hidden"
                                        accept="image/*" onfocus="$('#btn-save').show(500);">
                                </div>
                            </div>
                        </section>
                        <section class="py-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="fs-6 fw-semibold">
                                    Full Name
                                </div>
                                <div class="fs-6 fw-semibold">
                                    <input type="text" value="{{ $user->name }}" class="form-control text-end border-0"
                                        onfocus="$(this).removeAttr('readonly').removeClass('text-end')"
                                        onblur="$(this).attr('readonly', 'true').addClass('text-end')" name="name"
                                        oninput="$('#btn-save').show(500);" readonly>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </section>
                        <section class="py-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="fs-6 fw-semibold">
                                    Username
                                </div>
                                <div class="fs-6 fw-semibold">
                                    <input type="text" value="{{ $user->username }}"
                                        class="form-control text-end border-0"
                                        onfocus="$(this).removeAttr('readonly').removeClass('text-end')"
                                        onblur="$(this).attr('readonly', 'true').addClass('text-end')" name="username"
                                        oninput="$('#btn-save').show(500);" readonly>
                                    @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </section>
                        <section class="py-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="fs-6 fw-semibold">
                                    Email
                                </div>
                                <div class="fs-6 fw-semibold">
                                    <input type="email" value="{{ $user->email }}" class="form-control text-end border-0"
                                        readonly disabled>
                                    @if ($user->hasVerifiedEmail())
                                        <div id="email-status" class="text-end text-success">
                                            <i class="bi bi-check-circle"></i> <small>Verified</small>
                                        </div>
                                    @else
                                        <div id="email-status" class="text-end text-danger">
                                            <i class="bi bi-exclamation-circle"></i> <small>Not Verified</small>
                                        </div>
                                    @endif
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </section>

                        <section class="py-3 text-end" id="btn-save">
                            <button type="button" class="btn btn-dark" onclick="$('#btn-save').hide(500);">Cancel</button>
                            <button class="btn btn-outline-dark">Save</button>
                        </section>
                    </form>
                    <div class="d-flex justify-content-between align-items-center py-3">
                        <div class="fs-6 fw-semibold">
                            Password
                        </div>
                        <div class="fs-6 fw-semibold">
                            <button type="button" class="border-0 btn btn-dark" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Change Password <i class="fa-solid fa-key fa-sm"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/dashboard/profile/{{ $user->username }}/updatePassword" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <div class="modal-body">
                                        <p>
                                            Please Enter Your Old Password and a New Password,
                                            New Password Must Contains :
                                        </p>
                                        <ul>

                                            <li>Uppercase characters (A - Z)</li>
                                            <li>Lowercase characters (a - z)</li>
                                            <li>Base 10 digits (0 - 9)</li>
                                            <li>Non-alphanumeric (For example: !, $, #, or %)</li>

                                        </ul>
                                        <section class="py-3 border-bottom">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="fs-6 fw-semibold">
                                                    Old Password
                                                </div>
                                                <div class="fs-6 fw-semibold">
                                                    <input type="password"
                                                        class="form-control text-end border-0 input-password"
                                                        name="oldPassword"
                                                        onfocus="$(this).removeAttr('readonly').removeClass('text-end')"
                                                        onblur="$(this).attr('readonly', 'true').addClass('text-end')"
                                                        readonly>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="py-3 border-bottom">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="fs-6 fw-semibold">
                                                    New Password
                                                </div>
                                                <div class="fs-6 fw-semibold">
                                                    <input type="password"
                                                        class="form-control text-end border-0 input-password"
                                                        name="password"
                                                        onfocus="$(this).removeAttr('readonly').removeClass('text-end')"
                                                        onblur="$(this).attr('readonly', 'true').addClass('text-end')"
                                                        readonly>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="py-3 border-bottom">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="fs-6 fw-semibold">
                                                    Confirm Password
                                                </div>
                                                <div class="fs-6 fw-semibold">
                                                    <input type="password"
                                                        class="form-control text-end border-0 input-password"
                                                        name="password_confirmation"
                                                        onfocus="$(this).removeAttr('readonly').removeClass('text-end')"
                                                        onblur="$(this).attr('readonly', 'true').addClass('text-end')"
                                                        readonly>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="d-flex justify-content-between pt-3">
                                            <a href="/forgot" class="link">Forgot Password</a>
                                            <div class="d-flex align-items-center user-select-none">
                                                <input type="checkbox" class="form-check-input mx-1" id="showpass">
                                                <label for="showpass" class="form-label-input mx-1">Show Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-bs-dismiss="modal"
                                            class="btn btn-secondary">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </section>
                    <hr class="semi-thick">
                    <section class="py-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="fs-6 fw-semibold">
                                Last Updated
                            </div>
                            <div class="fs-6 d-flex flex-column align-items-center">
                                <pre>{{ date('d-m-Y h:m:s', strtotime($user->updated_at)) }}</pre>
                                <small>{{ $user->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </section>
                    <section class="py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="fs-6 fw-semibold">
                                Account Created
                            </div>
                            <div class="fs-6 d-flex flex-column align-items-center">
                                <pre>{{ date('d-m-Y h:m:s', strtotime($user->created_at)) }}</pre>
                                <small>{{ $user->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
    <script>
        $('#btn-save').hide();

        $('#showpass').on('change', (par) => {
            $('#showpass').is(':checked') ?
                $('.input-password').each(function(index, el) {
                    $(el).attr('type', 'text')
                }) :
                $('.input-password').each(function(index, el) {
                    $(el).attr('type', 'password')
                });
        });
    </script>
@endsection
