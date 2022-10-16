@extends('layouts.main')

@push('head')
    <link rel="stylesheet" href="/css/hover.css">
@endpush

@section('content')
    @include('layouts.navbar')
    <main style="margin-top: 4rem;">
        <div class="container py-3">
            @include('utilities.breadcrumb')
            <div class="row g-3">
                <div class="col-12 px-5 col-navtop">
                    <nav class="nav nav-pills flex-column flex-sm-row nav-product">
                        <button class="flex-sm-fill text-sm-center nav-link border border-primary me-1 active"
                            aria-current="page" role="button"
                            onclick="$('html, body').animate({scrollTop: $('#product-info').offset().top - 90}, 500)">Info
                            Produk</button>
                        <button class="flex-sm-fill text-sm-center nav-link border border-primary me-1" role="button"
                            onclick="$('html, body').animate({scrollTop: $('#reviews').offset().top - 90}, 500)">Ulasan</button>
                        <button class="flex-sm-fill text-sm-center nav-link border border-primary me-1"
                            onclick="$('html, body').animate({scrollTop: $('#discuss').offset().top - 90}, 500)">Diskusi</button>
                    </nav>
                </div>
                <div class="col-12 col-lg-3 col-product-image">
                    <div class="content sticky-top" style="top: 4.5em; z-index: 2;">
                        <div class="card border-0 product-image">
                            <div class="row justify-content-center">
                                <div class="col col-md-6 col-lg-12">

                                    <img role="button" data-bs-toggle="modal" data-bs-target="#showImage"
                                        onclick="$('#ImagePreview').attr('src', this.src)"
                                        src="{{ asset('storage/images/products/' . json_decode($product->image)[0]) }}"
                                        class="card-img img-main-thumbnail" alt="Product Thumbnail" id="mainImg">

                                </div>
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                @foreach (json_decode($product->image) as $img)
                                    <img src="{{ asset('storage/images/products/' . $img) }}" width="50" height="50"
                                        class="img-sub-thumbnail img-fixed rounded shadow-sm mx-1 outline-salmon"
                                        style="width: 50px;" onclick="$('#mainImg').attr('src', this.src)">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-product-content border-bottom rounded shadow-sm">
                    <div class="card border-0">
                        <div class="card-body">
                            <h4 class="card-title fw-semibold h4">
                                {{ $product->name }}
                            </h4>
                            <h6 class="card-subtitle mb-2 text-muted">Terjual
                                <span class="font-monospace fw-bold">{{ $product->sold }}</span>
                                &#8226;
                                <img src="/img/star-big.svg" alt="Ulasan" width="18">
                                4.9 (213 Ulasan)
                            </h6>
                            <h2 class="price fw-bold mt-2 mb-3">Rp{{ number_format($product->price, 0, ',', '.') }}</h2>
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Detail</a>
                                </li>
                            </ul>
                            <div class="product-description my-2 px-2" id="product-info">
                                <p class="text-muted m-0 p-0">
                                    Kondisi: <span
                                        class="text-success fw-semibold">{{ $product->condition ? 'Baru' : 'Bekas' }}</span>
                                </p>
                                <p class="text-muted m-0 p-0">
                                    Berat: <span class="text-success fw-semibold">{{ $product->weight }} Kg</span>
                                </p>
                                <p class="text-muted m-0 p-0">
                                    Kategori: <a
                                        href="/category/{{ $product->subcategory->category->slug . '/' . $product->subcategory->slug }}"
                                        class="text-success fw-semibold">{{ $product->subcategory->name ?? 'Tidak Ada' }}</a>
                                </p>
                                <p class="text-muted m-0 p-0">
                                    Katalog: <a
                                        href="/{{ $product->catalog->shop->url . '/cat' . 'alog/' . $product->catalog->slug }}"
                                        class="text-success fw-semibold">{{ $product->catalog->name }}</a>
                                </p>
                                @if ($product->getVisibility($product->visibility) !== 'Public')
                                    <p class="text-muted m-0 p-0">
                                        Visibilitas: <small title="Only User That Have The Link To This Item Can Access It"
                                            class="text-muted fst-italic fw-semibold">{{ $product->getVisibility($product->visibility) }}</small>
                                    </p>
                                @endif


                                <div class="desc border-bottom mt-3">

                                    <p class="desc-p">
                                        {!! strlen($product->desc) > 200
                                            ? Str::limit(
                                                $product->desc,
                                                200,
                                                '... <a role="button" class="link-success fw-semibold text-decoration-none" onclick="descMore()">Read More</a>',
                                            )
                                            : $product->desc !!}
                                    </p>
                                </div>
                                <div class="seller-info border-bottom my-1 py-2 px-2 d-flex">
                                    <div class="row g-0 justify-content-center">
                                        <div class="col-12 d-flex align-items-center">
                                            <a href="#" class="fw-semibold text-decoration-none link-dark ms-3">
                                                <img src="{{ asset('storage/images/profiles/' . $product->shop->owner->image) }}"
                                                    alt="Seller Profile" width="40" class="img-fluid rounded-circle">
                                            </a>
                                            <h5><a href="/{{ $product->shop->url }}"
                                                    class="fw-semibold text-decoration-none link-dark ms-3">{{ $product->shop->name }}</a>
                                            </h5>
                                            <button class="btn btn-primary btn-sm ms-3">
                                                Follow
                                            </button>
                                        </div>
                                        <div class="col px-2">
                                            <small class="d-block">{!! $product->shop->owner->status
                                                ? 'Online'
                                                : 'Last Seen <b>' . $product->shop->owner->updated_at->diffForHumans(null) . '</b>' !!}</small>
                                            <small><i class="bi bi-star-fill"></i> 5.0 Rata rata ulasan</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="shipping-info border-bottom my-1 py-2 px-2">
                                    <h6 class="fw-bold">Pengirim</h6>
                                    <small class="d-block">
                                        <i class="bi bi-geo-alt-fill"></i> Dikirim Dari
                                        <b>{{ $product->shop->location }}</b>
                                    </small>
                                    <small class="d-block">
                                        <i class="bi bi-truck"></i> Ongkir : <i class="bi bi-plus-slash-minus"></i>12K |
                                        Estimasti Tiba : 20 Juli
                                    </small>
                                </div>
                                <div class="promo border-bottom my-1 py-2 px-2">
                                    <h6 class="fw-bold">Promo</h6>
                                    <div class="row row-cols-1 row-cols-lg-2">
                                        <div class="col">
                                            <div class="card mb-3">
                                                <h6 class="card-header fw-bold">Diskon s.d 500Rb</h6>
                                                <div class="card-body">
                                                    <h6 class="card-title">Syarat & Ketentuan</h6>
                                                    <p class="card-text">- Minimal Pembelian 200Rb</p>
                                                    <button class="btn btn-primary">Pakai</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card mb-3">
                                                <h6 class="card-header fw-bold">Gratis Ongkir Se-Indonesia</h6>
                                                <div class="card-body">
                                                    <h6 class="card-title">Syarat & Ketentuan</h6>
                                                    <p class="card-text">- Minimal Pembelian 60Rb</p>
                                                    <button class="btn btn-primary">Pakai</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="report d-flex justify-content-between">
                                    <small class="text-secondary">Laporkan Produk</small>
                                    <a href="#" class="text-decoration-none link-secondary">
                                        <i class="bi bi-flag"></i> Report
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-checkout">
                    <div class="content sticky-top promotion" style="top: 4.5em; z-index: 2;">
                        <div class="card-body bg-secondary rounded px-3 py-2 mb-3">
                            <a href="#" class="text-decoration-none link-light">
                                <h5 class="card-title">Promotion Sign</h5>
                            </a>
                        </div>
                        <div class="card border-0 shadow checkout-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a class="dropdown-toggle text-decoration-none link-dark" role="button"
                                        data-bs-toggle="collapse" href="#collapseExample" role="button"
                                        aria-expanded="false" aria-controls="collapseExample">
                                        Jumlah & Catatan
                                    </a>
                                </h5>
                                <div class="collapse show" id="collapseExample">
                                    <div class="card card-body border-0 m-0 p-0 mb-3">
                                        <label for="jumlah" class="visually-hidden">Jumlah Barang</label>
                                        <div class="d-flex align-items-center mt-1 mb-3">
                                            <input type="range" name="jumlah" id="jumlah" min="1"
                                                value="1" onclick="$('.jumlah').html(this.value);"
                                                onmouseover="$('.jumlah').html(this.value);"
                                                oninput="$('.jumlah').html(this.value); $('#jumlah_text').val(this.value); $('#count').val(this.value)"
                                                max="{{ $product->stock }}" class="form-range me-2"
                                                style="cursor: pointer; display: none">
                                            <input type="number" min="1" max="{{ $product->stock }}"
                                                maxlength="3" id="jumlah_text" value="1" name="jumlah"
                                                onmouseover="$('.jumlah').html(this.value);"
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); $('.jumlah').html(this.value); $('#jumlah').val(this.value); $('#count').val(this.value)"
                                                class="form-control form-control-sm text-center mb-2 fw-bold font-monospace me-2"
                                                placeholder="Jumlah Barang">
                                            <span class="jumlah"
                                                onclick="$('#jumlah_text').toggle(); $('#jumlah').toggle()"
                                                style="cursor: pointer"></span>
                                        </div>
                                        <label for="catatan" class="visually-hidden">Catatan</label>
                                        <textarea name="catatan" id="catatan" class="form-control form-control-sm" placeholder="Catatan Untuk Penjual"
                                            oninput="$('#notes').val(this.value)"></textarea>
                                    </div>
                                </div>
                                <h6 class="card-subtitle mb-2 text-muted">Stok:
                                    <span class="font-monospace fw-bold">{{ $product->stock }}</span>
                                </h6>
                                <div class="d-grid">
                                    <form class="d-grid" action="/cart" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="count" id="count" value="1">
                                        <input type="hidden" name="notes" id="notes" value="">
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                        <button class="h5 checkout-button btn btn-primary" name="cart"
                                            {{ $product->disabled || $product->stock <= 0 ? 'disabled title="Product is Inactive"' : '' }}>
                                            <i class="fa-solid fa-cart-arrow-down fa-lg"></i> Keranjang
                                        </button>
                                    </form>
                                    <form action="/cart" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <button class="checkout-button btn btn-outline-primary w-50" name="direct"
                                                disabled>
                                                Beli Langsung
                                            </button>
                                            <select class="form-select">
                                                <option value="wa">Whatsapp</option>
                                                <option value="custom">Pilih Metode Pembayaran</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                </form>
                                <div class="btn-group d-flex justify-content-center mt-2 " role="group">
                                    <button class="border-0 bg-transparent mx-1">
                                        <svg version="1.1" width="25" id="Capa_1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            x="0px" y="0px" viewBox="0 0 47.94 47.94"
                                            style="enable-background:new 0 0 47.94 47.94;" xml:space="preserve">
                                            {{-- fill:#ED8A19 / #000000 --}}
                                            <path style="fill:#000000;"
                                                d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                C22.602,0.567,25.338,0.567,26.285,2.486z" />
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                        </svg>
                                        <small class="text-muted fw-semibold">Wishlist</small>
                                    </button>|
                                    <button class="border-0 bg-transparent mx-1">
                                        <i class="fa-solid fa-comments fa-lg"></i>
                                        <small class="text-muted fw-semibold">Chat</small>
                                    </button>|
                                    <button class="border-0 bg-transparent mx-1">
                                        <i class="fa-solid fa-share fa-lg"></i>
                                        <small class="text-muted fw-semibold">Share</small>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review">
                <div class="row mt-5">
                    <h5 class="fw-bold text-uppercase text-center text-muted" id="reviews">ulasan</h5>
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="well well-sm">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="row rating-desc">
                                        <div class="col-xs-3 col-md-3 text-right">
                                            <span class="fa fa-star"></span> 5
                                        </div>
                                        <div class="col-xs-8 col-md-9">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 80%">80%
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-md-3 text-right">
                                            <span class="fa fa-star"></span> 4
                                        </div>
                                        <div class="col-xs-8 col-md-9">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 60%">60%
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-md-3 text-right">
                                            <span class="fa fa-star"></span> 3
                                        </div>
                                        <div class="col-xs-8 col-md-9">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 40%">40%
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-md-3 text-right">
                                            <span class="fa fa-star"></span> 2
                                        </div>
                                        <div class="col-xs-8 col-md-9">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 20%">20%
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-md-3 text-right">
                                            <span class="fa fa-star"></span> 1
                                        </div>
                                        <div class="col-xs-8 col-md-9">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar"
                                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 15%">15%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>
                                <div class="col-xs-12 col-md-6 text-center">
                                    <span class="rating-num h1">4.9<small class="fs-6">/5.0</small></span>
                                    <div class="rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star-half "></span>
                                    </div>
                                    <div>
                                        <span class="fa fa-user"></span>125888 total votes
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="container sticky-top mb-5" style="top: 6em; z-index: 2;">
                            <h6 class="text-uppercase fw-semibold">Filter Ulasan</h6>
                            <div class="row">
                                <div class="col border rounded pb-3">
                                    <small class="fw-semibold">Ratings</small>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="star-5">
                                        <label class="form-check-label" for="star-5">
                                            <span class="fa fa-star"></span> 5
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="star-4">
                                        <label class="form-check-label" for="star-4">
                                            <span class="fa fa-star"></span> 4
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="star-3">
                                        <label class="form-check-label" for="star-3">
                                            <span class="fa fa-star"></span> 3
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="star-2">
                                        <label class="form-check-label" for="star-2">
                                            <span class="fa fa-star"></span> 2
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="star-1">
                                        <label class="form-check-label" for="star-1">
                                            <span class="fa fa-star"></span> 1
                                        </label>
                                    </div>
                                    <small class="fw-semibold">Urutkan</small>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Terbaru</option>
                                        <option value="1">Terlama</option>
                                    </select>
                                    <hr>
                                    <form action="">
                                        <div class="d-grid">
                                            <button class="btn btn-primary mb-2">Apply</button>
                                            <button class="btn btn-outline-primary">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <div class="container">
                            @for ($i = 0; $i < 5; $i++)
                                <div class="user-info border-bottom my-1 py-2 px-2 d-flex">
                                    <div class="row g-0 justify-content-center">
                                        <div class="col-12 d-flex align-items-center">
                                            <img src="{{ asset('storage/images/profiles/default.jpg') }}"
                                                alt="Seller Profile" width="40" class="img-fluid rounded-circle">
                                            <h5 class="fw-semibold ms-3">User Name</h5>
                                        </div>
                                        <div class="col mt-2">
                                            <small class="d-block">
                                                <div class="star">
                                                    @for ($x = 0; $x < mt_rand(1, 5); $x++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                </div>
                                                2 Hari Yang Lalu
                                            </small>
                                            <p>
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium in sit
                                                modi
                                                veritatis quam quidem laudantium harum! Necessitatibus at similique
                                                obcaecati
                                                sapiente aliquam fugit esse nam dolorum quasi, culpa rerum.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="discuss mb-3" id="discuss">
                    <h5 class="text-uppercase fw-bold text-muted">Diskusi Produk</h5>
                    <div class="row">
                        <div class="col-12 bg-light border rounded mb-3 px-3 justify-content-center align-items-center">
                            <div class="row">
                                <div class="col pt-3">
                                    <p class="text-muted">
                                        <i class="fa-solid fa-circle-question fa-lg"></i> Tanya Pertanyaan Seputar Produk
                                    </p>
                                </div>
                                <div class="col-4 py-2">
                                    <button class="btn btn-primary float-end">Pertanyaan Baru</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            @for ($i = 0; $i < 5; $i++)
                                <div class="my-1 py-2 px-2 d-flex border rounded mb-4">
                                    <div class="row g-0justify-content-center">
                                        <div class="col-12 d-flex align-items-center">
                                            <img src="{{ asset('storage/images/profiles/default.jpg') }}"
                                                alt="Seller Profile" width="35" class="img-fluid rounded-circle">
                                            <h5 class="fw-semibold ms-3">Buyers Name · <small
                                                    class="fs-6 fw-light font-monospace">26
                                                    Jul</small>
                                            </h5>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <p>
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium in sit
                                                modi
                                                veritatis quam quidem laudantium harum! Necessitatibus at similique
                                                obcaecati
                                                sapiente aliquam fugit esse nam dolorum quasi, culpa rerum.
                                            </p>
                                            <div class="bg-light border rounded px-2 py-2">
                                                <div class="col-12 d-flex align-items-center">
                                                    <img src="{{ asset('storage/images/profiles/default.jpg') }}"
                                                        alt="Seller Profile" width="30"
                                                        class="img-fluid rounded-circle">
                                                    <h6 class="fw-semibold ms-3">Seller Name · <small
                                                            class="fs-6 fw-light font-monospace">26
                                                            Jul</small>
                                                    </h6>
                                                </div>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus
                                                    delectus
                                                    quae est asperiores nulla qui voluptas deleniti expedita vel aperiam
                                                    nemo
                                                    perspiciatis, commodi ipsa dolor laudantium. Nulla harum unde
                                                    voluptatum?
                                                </p>
                                                <div class="col-12 d-flex align-items-center">
                                                    <img src="{{ asset('storage/images/profiles/default.jpg') }}"
                                                        alt="Seller Profile" width="35"
                                                        class="img-fluid rounded-circle me-2">
                                                    <textarea onfocus="$('.btn-send{{ $i }}').show()" type="text" class="form-control input-discuss"
                                                        placeholder="Komentar Untuk Bergabung Diskusi" rows="1"></textarea>
                                                    <button class="btn btn-primary ms-2 btn-send{{ $i }}"
                                                        style="display: none;">Sent</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- Modal Image --}}
    <div class="modal fade" id="showImage" tabindex="-1" aria-labelledby="showImageLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="showImageLabel">Product Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center p-4">
                    <img src="" id="ImagePreview" class="img-fluid" onclick="openNewTab(this.src)"
                        role="button">
                </div>
            </div>
        </div>
    </div>
    @include('utilities.footer')
    <script src="/js/openNewTab.js"></script>
    <script>
        function descMore() {
            $('p.desc-p').html(
                '{{ $product->desc }} <a role="button" class="link-success fw-semibold text-decoration-none" onclick="descLess()">Read Less</a>'
            );
            $('html, body').animate({
                scrollTop: $('#product-info').offset().top - 90
            }, 500)
        }

        function descLess() {
            $('p.desc-p').html(
                '{{ Str::limit($product->desc, 200, '') }}... <a role="button" class="link-success fw-semibold text-decoration-none" onclick="descMore()">Read More</a>'
            );
            $('html, body').animate({
                scrollTop: $('#product-info').offset().top - 90
            }, 50)
        }
    </script>
@endsection
