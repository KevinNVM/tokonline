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
                @include('myshop.profile')
                <div class="modal fade" id="ShareButton" tabindex="-1" aria-labelledby="ShareButtonLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    <i class="bi bi-share"></i> Bagikan
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body py-5">
                                <div class="d-flex justify-content-center">
                                    <a onclick="Share.facebook('{{ url()->current() }}','Check Ini! {{ $title }}','','Ini Mungkin Aja Bisa Menarik Perhatian Mu!')"
                                        role="button" title="Facebook" class="mx-2 fs-2 link-primary">
                                        <i class="fa-brands fa-facebook fa-2xl"></i>
                                    </a>

                                    <a onclick="Share.twitter({{ url()->current() }},'Toko Kevin')" title="Twitter"
                                        class="mx-2 fs-2 link-info" role="button">
                                        <i class="fa-brands fa-twitter fa-2xl"></i>
                                    </a>

                                    <a href="whatsapp://send?text=%2ACoba+Cek+Toko+Ini+Deh%21+Dijamin+Ga+Bakal+Nyesel%2A%0D%0A{{ url()->current() }}"
                                        data-action="share/whatsapp/share" title="Whatsapp" class="mx-2 fs-2 link-success">
                                        <i class="fa-brands fa-whatsapp fa-2xl"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                                        <img src="/img/icons-512.png" class="card-img-top p-2"
                                                            alt="Product Thumbnail">
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
                                                            <img src="/img/icons-512.png" class="card-img-top p-2"
                                                                alt="Product Thumbnail">
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
                                        {{ $shop->desc ?? 'Lorem Ipsum' }}
                                        <hr>
                                        <small class="d-block fw-bold">Tautan</small>
                                        @if ($shop->link)
                                            @php $links = explode(',', $shop->link); @endphp
                                            @foreach ($links as $link)
                                                <a href="{{ $link }}"
                                                    class="d-block link-primary">{{ $link }}</a>
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
                                            {{ $shop->desc ?? 'Lorem Ipsum' }}
                                        </p>
                                        <hr>
                                        <small class="d-block fw-bold">Tautan</small>
                                        @if ($shop->link)
                                            @php $links = explode(',', $shop->link); @endphp
                                            @foreach ($links as $link)
                                                <a href="{{ $link }}">{{ $link }}</a>
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
@endsection
