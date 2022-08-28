@extends('layouts.main')

@push('head')
    <link rel="stylesheet" href="/css/product-card.css">
@endpush

@section('content')
    @include('layouts.navbar')
    <main style="margin-top: 4em;">
        <div class="container py-3">
            @include('utilities.breadcrumb')

            <div class="row g-3">
                <div class="col-12 col-lg-4">
                    <div class="sticky-top" style="top: 5em; z-index: 2;">
                        <div class="card rounded border-0 shadow position-relative">
                            <div class="card-body p-5">
                                <div class="d-flex align-items-center mb-4 pb-4 border-bottom"><i
                                        class="fa-solid fa-list fa-3x"></i>
                                    <div class="ms-3">
                                        <h4 class="text-uppercase fw-semibold mb-0">Katalog</h4>
                                        <p class="text-gray fst-italic mb-0">{{ $shop->name }}
                                        </p>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach ($catalogs as $catalog)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-hover">
                                            <a href="/{{ $shop->url . '/cat' . 'alog/' . $catalog->slug }}"
                                                class="text-decoration-none link-dark stretched-link {{ request()->is($shop->url . '/cat' . 'alog/' . $catalog->slug) ? 'fw-semibold' : '' }}">{{ $catalog->name }}</a>
                                            <span
                                                class="badge bg-info rounded-pill">{{ $catalog->products->count() }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="row row-cols-md-4">
                        @foreach ($selected->products as $product)
                            <div class="col mb-3">
                                <div class="card-product card border-0 shadow-hover" style="min-height: 24rem;">
                                    <img src="/img/icons-512.png" class="card-img-top p-2" alt="Product Thumbnail">
                                    <div class="card-body">
                                        <h5 title="{{ $product->name }}">
                                            <a class="stretched-link card-title fw-semibold text-decoration-none link-dark"
                                                href="/{{ $shop->url . '/' . $product->slug }}">
                                                {{ Str::limit($product->name, 25, '...') }}
                                            </a>
                                        </h5>
                                        <span
                                            class="h5 fw-bold d-block">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                        <small>{{ $product->shop->location }}</small>
                                        <p class="card-text">
                                            <i class="bi bi-star-half"></i> 5.0 <i class="bi bi-dot"></i>
                                            Terjual {{ $product->sold }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
