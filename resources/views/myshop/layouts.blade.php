@extends('layouts.main')

@push('head')
    <link rel="stylesheet" href="/css/hover.css">
@endpush

@section('content')
    @include('layouts.navbar')
    <main style="margin-top: 4rem;">
        <div class="container py-3">
            @include('utilities.breadcrumb')

            <div class="row">
                <div class="col-12 bg-light shadow py-2 px-4 rounded">
                    <div class="card border-0 bg-light mb-3">
                        <div class="row g-0">
                            <div class="col-md-4 rounded d-flex justify-content-center"
                                style="background: rgb(221,41,198);
                                background: linear-gradient(145deg, rgba(221,41,198,1) 0%, rgba(170,255,170,1) 100%);">
                                <img src="/img/icons-512.png" class="img-fluid rounded-circle py-4" width="175">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title fw-semibold me-3"></h5>
                                        <button class="btn btn-primary btn-sm">Follow</button>
                                    </div>
                                    <small class="badge text-bg-success">Online</small>
                                    <p class="card-text"><i class="bi bi-geo-alt-fill"></i> Jakarta Timur</p>
                                    <span class="card-text d-block mb-3"><i class="bi bi-star-half"></i> 4.5 Rata-rata
                                        Ulasan
                                        Produk</span>
                                    <button class="btn btn-primary mb-1"><i class="bi bi-chat-dots"></i> Chat
                                        Seller</button>
                                    <button class="btn btn-outline-primary mb-1"><i class="bi bi-info-circle"></i> Tentang
                                        Toko</button>
                                    <button class="btn btn-outline-primary mb-1"><i class="bi bi-share"></i>
                                        Bagikan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mt-5">
                    @include('myshop.nav')

                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>

            <hr>
        </div>
    </main>
    @include('utilities.footer')

    <script>
        function about() {}
    </script>
@endsection
