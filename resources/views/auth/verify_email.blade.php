@extends('layouts.main')

@section('content')
    @include('layouts.navbar-light', ['pos' => 'none'])

    <div class="container mt-3">
        @include('utilities.breadcrumb', ['title' => 'Verify Your Email'])
        <section class="main d-flex justify-content-center align-items-center" style="height: 25vh">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span>
                            Verify Your Email Address
                        </span>
                    </div>
                    <div class="card-body">
                        <p>
                            Before you continue, Please verify your email by clicking the link we've sent to <span
                                class="text-primary">{{ auth()->user()->email ?? 'Your Email' }}</span>. You can close this
                            window if you already verified your email.
                        </p>
                        <small class="d-block">This Proccess Shouldn't Take More Than 5 Minutes.</small>
                        <small>
                            Didn't Receive The Email?
                            <form action="{{ route('verification.send') }}" class="d-inline" method="POST">
                                @csrf @method('POST')
                                <button class="bg-transparent border-0 link-primary link">
                                    Re-Send Email Verification
                                </button>
                            </form>
                        </small>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
