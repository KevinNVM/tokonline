@extends('layouts.main')

@push('head')
    <link rel="stylesheet" href="/css/hover.css">
@endpush

@section('content')
    @include('layouts.navbar')
    <main style="margin-top: 4rem;">
        <div class="container-xl py-3">
            @include('utilities.breadcrumb')

            <div class="row">
                @include('myshop.profile')
                <div class="col mt-5">
                    <div id="tabs">
                        <ul>
                            <li><a class="user-select-none" href="#tabs-1" draggable="false">Produk</a></li>
                            <li><a class="user-select-none" href="#tabs-2" draggable="false">Katalog</a></li>
                            <li><a class="user-select-none" href="#tabs-3" draggable="false">Tentang</a></li>
                        </ul>

                        @if ($shop->catalog->count() !== 0)
                            @if ($shop->catalog->first()->products)
                                <div id="tabs-1">
                                    <div class="promotion-banners my-5">
                                        <svg class="bd-placeholder-img py-2" width="100%" height="100%"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <rect width="100%" height="100%" fill="#777" />
                                        </svg>
                                        <svg class="bd-placeholder-img py-2" width="100%" height="100%"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <rect width="100%" height="100%" fill="#777" />
                                        </svg>
                                    </div>

                                    <h2 class="featurette-heading fw-normal">Produk Terbaru</h2>
                                    <div class="card-container">
                                        <div class="row row-cols-xxl-6">
                                            @foreach ($products as $key => $product)
                                                @break($key === 6)
                                                <div class="col mb-3">
                                                    <div class="card-product card border-0 shadow-hover"
                                                        style="min-height: 24rem;">
                                                        <img src="{{ asset('storage/images/products/' . json_decode($product->image)[0]) }}"
                                                            class="card-img-top p-2" alt="Product Thumbnail">
                                                        <div class="card-body">
                                                            <h5 title="{{ $product->name }}">
                                                                <a class="stretched-link card-title fw-semibold text-decoration-none link-dark"
                                                                    href="/{{ $shop->url . '/' . $product->slug }}">
                                                                    {{ Str::limit($product->name, 25, '...') }}
                                                                </a>
                                                            </h5>
                                                            <span
                                                                class="h5 fw-bold d-block">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                                            <small>
                                                                @if ($product->shop->location)
                                                                    {{ json_decode($product->shop->location, 1)['regency'] }}
                                                                @endif
                                                            </small>
                                                            <p class="card-text">
                                                                <i class="bi bi-star-half"></i> 5.0 <i
                                                                    class="bi bi-dot"></i>
                                                                Terjual {{ $product->sold }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <small><a href="{{ request()->getPathInfo() }}/products?orderBy=latest"
                                                    class="text-decoration-none">Tampilkan Lebih
                                                    Banyak</a></small>
                                        </div>

                                        <hr>

                                        <h2 class="featurette-heading fw-normal">Terlaris</h2>
                                        <div class="card-container">
                                            <div class="row row-cols-xxl-6">
                                                @foreach ($best_seller as $key => $product)
                                                    @break($key === 6)
                                                    <div class="col mb-3">
                                                        <div class="card-product card border-0 shadow-hover"
                                                            style="min-height: 24rem;">
                                                            <img src="{{ asset('storage/images/products/' . json_decode($product->image)[0]) }}"
                                                                class="card-img-top p-2" alt="Product Thumbnail">
                                                            <div class="card-body">
                                                                <h5 title="{{ $product->name }}">
                                                                    <a class="stretched-link card-title fw-semibold text-decoration-none link-dark"
                                                                        href="/{{ $shop->url . '/' . $product->slug }}">
                                                                        {{ Str::limit($product->name, 25, '...') }}
                                                                    </a>
                                                                </h5>
                                                                <span
                                                                    class="h5 fw-bold d-block">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                                                <small>
                                                                    @if ($product->shop->location)
                                                                        {{ json_decode($product->shop->location, 1)['regency'] }}
                                                                    @endif
                                                                </small>
                                                                <p class="card-text">
                                                                    <i class="bi bi-star-half"></i> 5.0 <i
                                                                        class="bi bi-dot"></i>
                                                                    Terjual {{ $product->sold }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <small><a
                                                        href="{{ request()->getPathInfo() }}/products?orderBy=best_selling"
                                                        class="text-decoration-none">Tampilkan Lebih
                                                        Banyak</a></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div id="tabs-2">
                                <div class="row my-5">
                                    <div class="col-lg-5 mx-auto">

                                        <!-- CHECKBOX LIST -->
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
                                                                class="text-decoration-none link-dark stretched-link">{{ $catalog->name }}</a>
                                                            <span
                                                                class="badge bg-primary rounded-pill">{{ count($catalog->products) }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tabs-3">
                                <div class="row my-5">
                                    <div class="col-lg-5 mx-auto py-3 px-3 rounded shadow">

                                        <h3 class="fw-semibold">{{ $shop->name ?? '' }}</h3>
                                        <small class="d-block fw-bold">Bergabung Sejak</small>
                                        <span class="d-block">{{ date('d/M/Y', strtotime($shop->created_at)) }}</span>
                                        <hr>
                                        <small class="d-block fw-bold">Deskripsi Toko</small>
                                        {!! preg_replace('/\r\n/', '<br>', $shop->desc) ?? 'Lorem Ipsum' !!}
                                        <hr>
                                        <small class="d-block fw-bold">Tautan</small>
                                        @if ($shop->link)
                                            @php
                                                $links = json_decode($shop->link, true);
                                            @endphp
                                            @foreach ($links as $link)
                                                @if (filter_var($link, FILTER_VALIDATE_URL))
                                                    <a href="{{ $link }}"
                                                        class="d-block link-primary">{{ $link }}</a>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div id="tabs-1">
                                <h4 class="text-center text-muted fw-semibold">
                                    Toko Ini Tidak Memiliki Item Untuk Dijual.
                                </h4>
                            </div>
                            <div id="tabs-2">
                                <h4 class="text-center text-muted fw-semibold">
                                    Toko Ini Tidak Memiliki Katalog Untuk Ditampilkan.
                                </h4>
                            </div>
                            <div id="tabs-3">
                                <div class="row my-5">
                                    <div class="col-lg-5 mx-auto py-3 px-3 rounded shadow">

                                        <h3 class="fw-semibold">{{ $shop->name ?? '' }}</h3>
                                        <small class="d-block fw-bold">Bergabung Sejak</small>
                                        <span class="d-block">{{ date('d m Y', strtotime($shop->created_at)) }}</span>
                                        <hr>
                                        <small class="d-block fw-bold">Deskripsi Toko</small>
                                        <p>
                                            <?= nl2br(e($shop->desc)) ?>
                                        </p>
                                        <hr>
                                        <small class="d-block fw-bold">Tautan</small>
                                        @if ($shop->link)
                                            @php $links = json_decode($shop->link) @endphp
                                            @foreach ($links as $link)
                                                <a href="{{ $link }}" class="link d-block"
                                                    target="_blank">{{ $link }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

    </main>

    @include('utilities.footer')
    <script src="/js/share.js"></script>
    <script>
        $(function() {
            $("#tabs").tabs();
        });
    </script>
    <script>
        function openModals(id, btn) {
            // Get the modal
            var modal = document.querySelector(`#${id}`);

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName(`closeModalShare`)[0];

            // When the user clicks the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    </script>
@endsection
