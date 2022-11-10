@extends('layouts.main')

@push('head')
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
@endpush

@section('content')
    @include('layouts.navbar')
    <div class="container" style="margin-top: 3em; max-width: 90%">
        <main class="mb-5">
            <div class="py-5 text-center">
                @include('utilities.breadcrumb')
                <img loading="lazy"class="d-block mx-auto mb-4" src="/img/icons-512.png" alt="" width="72"
                    height="57">
                <h2><a href="/cart" class="link link-dark">Keranjang</a></h2>

            </div>

            <div class="cart-box">
                <div class="row g-5 justify-content-center">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Daftar Keranjang</span>
                            <span class="badge bg-primary rounded-pill">1</span>
                        </h4>
                        @foreach ($carts as $product)
                            <form action="/cart/{{ $product->id }}" method="POST">
                                @csrf
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <img loading="lazy"src="/img/icons-512.png" alt="Product Thumbnail"
                                                    width="25" class="img-fluid me-3">
                                                <span class="my-0 h6"><a class="link text-dark"
                                                        href="/{{ $product->shop->url . '/' . $product->slug }}/">{{ $product->name }}</a>
                                                    ·
                                                    <b><input type="text" name="count" min="1"
                                                            max="{{ $product->stock }}"
                                                            value={{ $product->pivot->count }}></b></span>
                                            </div>
                                            <p class="text-danger">
                                                @error('count')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                            <small
                                                class="text-muted">Rp{{ number_format($product->pivot->subtotal, 0, ',', '.') }}</small>
                                        </div>
                                        <div>
                                            <span class="text-danger">
                                                <a role="button" class="rounded-3 text-danger text-decoration-none"
                                                    onclick="Swal.fire({
                                                        title: 'Hapus Barang?',
                                                        showCancelButton: true,
                                                        icon: 'warning',
                                                      }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            location = '/cart/delete/{{ base64_encode($product->slug) }}/{{ base64_encode($product->id) }}'
                                                        }})">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </li>
                                    <div class="bg-light list-group-item">
                                        <small class="fw-semibold d-block" aria-label="Catatan untuk penjual">Catatan
                                            Untuk
                                            Penjual
                                            :
                                        </small>
                                        <input type="text" class="form-control" name="notes"
                                            value="{{ old('notes', $product->pivot->notes) }}">
                                    </div>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <button class="btn btn-primary">Save</button>
                                    </li>
                                </ul>
                            </form>
                        @endforeach
                    </div>
                </div>

            </div>

        </main>
        @include('utilities.footer')
    </div>
@endsection
