@extends('layouts.main')

@push('head')
    <link rel="stylesheet" href="/css/product-card.css">
@endpush

@section('content')

    @include('layouts.navbar')
    <div class="toast-container" style="top: 5em; right: 0em; position: fixed;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body d-flex justify-content-between">
                <div>
                    <i class="bi bi-clipboard-check-fill"></i> Copied Link To Clipboard.
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <main style="margin-top: 4em;">
        <div class="container-xl py-3">
            @include('utilities.breadcrumb')


            <div class="row g-3">
                @isset($products)
                    <div class="col-12 col-lg-4">
                        <div class="sticky-top shadow rounded"
                            style="top: 5em; z-index: 2; overflow-y: scroll; overflow-x: hidden; height: 85vh;">
                            <div class="rounded border-0 shadow position-relative">
                                <div class="card-body p-5">
                                    <div class="d-flex align-items-center mb-4 pb-4 sticky-top bg-white pt-3">
                                        <i class="fa-solid fa-magnifying-glass fa-3x"></i>
                                        <div class="ms-3">
                                            <h4 class="text-uppercase fw-semibold mb-0">Filter</h4>
                                            @if (count($products))
                                                @if (request('search'))
                                                    <p class="text-gray fst-italic mb-0"">Menemukan {{ count($products) }}
                                                        Produk.</p>
                                                @endif
                                            @else
                                                <p class="text-gray fst-italic mb-0"">Tidak Dapat Menemukan Produk</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col rounded pb-3">
                                                <form id="filters">
                                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                                    <div class="filter-order">
                                                        <small class="fw-semibold">Urutkan</small>
                                                        <select class="form-select" name="order">
                                                            <option value="latest"
                                                                {{ request('order') == 'latest' ? 'selected' : '' }}>Terbaru
                                                            </option>
                                                            <option value="oldest"
                                                                {{ request('order') == 'oldest' ? 'selected' : '' }}>Terlama
                                                            </option>
                                                            <option value="ratings"
                                                                {{ request('order') == 'ratings' ? 'selected' : '' }}>Ratings
                                                            </option>
                                                            <option value="highest_price"
                                                                {{ request('order') == 'highest_price' ? 'selected' : '' }}>
                                                                Harga Tertinggi</option>
                                                            <option value="lowest_price"
                                                                {{ request('order') == 'lowest_price' ? 'selected' : '' }}>Harga
                                                                Terendah</option>
                                                        </select>
                                                    </div>
                                                    <hr class="semi-thick">
                                                    <div class="filter-ratings">
                                                        <small class="fw-semibold">Ratings</small>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="5"
                                                                name="ratings[]"
                                                                {{ in_array('5', request('ratings') ?? []) ? 'checked' : '' }}
                                                                id="star-5">
                                                            <label class="form-check-label" for="star-5">
                                                                <span class="fa fa-star"></span> 5
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="4"
                                                                name="ratings[]"
                                                                {{ in_array('4', request('ratings') ?? []) ? 'checked' : '' }}
                                                                id="star-4">
                                                            <label class="form-check-label" for="star-4">
                                                                <span class="fa fa-star"></span> 4
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="3"
                                                                name="ratings[]"
                                                                {{ in_array('3', request('ratings') ?? []) ? 'checked' : '' }}
                                                                id="star-3">
                                                            <label class="form-check-label" for="star-3">
                                                                <span class="fa fa-star"></span> 3
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="2"
                                                                name="ratings[]"
                                                                {{ in_array('2', request('ratings') ?? []) ? 'checked' : '' }}
                                                                id="star-2">
                                                            <label class="form-check-label" for="star-2">
                                                                <span class="fa fa-star"></span> 2
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1"
                                                                name="ratings[]"
                                                                {{ in_array('1', request('ratings') ?? []) ? 'checked' : '' }}
                                                                id="star-1">
                                                            <label class="form-check-label" for="star-1">
                                                                <span class="fa fa-star"></span> 1
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="0"
                                                                name="ratings[]"
                                                                {{ in_array('0', request('ratings') ?? []) ? 'checked' : '' }}
                                                                id="star-1">
                                                            <label class="form-check-label" for="star-1">
                                                                <span class="fa fa-star"></span> 0
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <hr class="semi-thick">
                                                    <div class="filter-location">
                                                        <small class="fw-semibold">Lokasi Toko</small>
                                                        @foreach ($store_location as $location)
                                                            <?php $location = json_decode($location, true); ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="location-{{ $location['regency'] }}"
                                                                    name="location[]" value="{{ $location['regency'] }}">
                                                                <label class="form-check-label"
                                                                    for="location-{{ $location['regency'] }}">
                                                                    {{ $location['regency'] }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <hr class="semi-thick">
                                                    <div class="filter-price">
                                                        <small class="fw-semibold">Harga</small>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text fw-semibold"
                                                                id="min-price">Rp</span>
                                                            <input type="text" class="form-control" name="min_price"
                                                                value="{{ request('min_price') }}"
                                                                placeholder="Harga Minimum" aria-label="Minimum Price"
                                                                aria-describedby="min-price">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text fw-semibold"
                                                                id="max-price">Rp</span>
                                                            <input type="text" class="form-control" name="max_price"
                                                                value="{{ request('max_price') }}"
                                                                placeholder="Harga Maksimum" aria-label="Maximal Price"
                                                                aria-describedby="max-price">
                                                        </div>
                                                    </div>
                                                    <hr class="semi-thick">
                                                    <div class="filter-condition">
                                                        <small class="fw-semibold">Kondisi Barang</small>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" id="cond-new"
                                                                value="1" name="condition"
                                                                {{ request('condition') ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="cond-new">
                                                                Baru
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" id="cond-old"
                                                                value="2" name="condition"
                                                                {{ request('condition') === '2' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="cond-old">
                                                                Bekas
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" id="cond-all"
                                                                value="all" name="condition"
                                                                {{ request('condition') == 'all' || !request('condition') ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="cond-all">
                                                                Semua
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <hr class="thick">
                                                    <div class="d-grid">
                                                        <button class="btn btn-primary mb-2">Apply</button>
                                                        <button class="btn btn-outline-primary" type="button"
                                                            onclick="resetFilters()">Reset</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row row-cols-md-4 g-3">
                            @foreach ($products as $key => $product)
                                @if ($product->visibility !== 0)
                                    <div class="col hp">
                                        <div class="card-product card h-100 shadow-hover">
                                            <a href="/{{ $product->shop->url . '/' . $product->slug }}">
                                                <img loading="lazy"src="{{ asset('storage/images/products/' . json_decode($product->image)[0]) }}"
                                                    class="card-img-top" alt="product.title" />
                                            </a>

                                            <div class="label-top shadow-sm">
                                                <a class="text-white"
                                                    href="/category/{{ $product->subcategory->category->slug . '/' . $product->subcategory->slug }}">{{ $product->subcategory->name }}</a>
                                            </div>
                                            <div class="card-body">
                                                <div class="clearfix mb-3">
                                                    <span
                                                        class="float-start badge rounded-pill bg-success">Rp{{ number_format($product->price, 0, ',', '.') }}</span>

                                                    <span class="float-end"><a
                                                            href="/{{ $product->shop->url . '/' . $product->slug }}#reviews"
                                                            class="small text-muted text-decoration-none">
                                                            {{ number_format($product->ratings / 10, 1, '.', '.') }}
                                                        </a></span>
                                                </div>
                                                <h5 class="card-title">
                                                    <a
                                                        href="/{{ $product->shop->url . '/' . $product->slug }}">{{ $product->name }}</a>
                                                </h5>
                                                <small>
                                                    {{ $product->condition == 2 ? 'Bekas' : 'Baru' }}
                                                </small>
                                                <small><a class="link link-muted" href="/{{ $product->shop->url }}">
                                                        {{ $product->shop->name }}
                                                    </a></small>
                                                <small>
                                                    {{ json_decode($product->shop->location)->regency }}
                                                </small>
                                                <div class="d-grid gap-2 my-4">

                                                    <a href="/{{ $product->shop->url }}/{{ $product->slug }}?cart=1"
                                                        class="btn btn-warning bold-btn">add to cart</a>

                                                </div>
                                                <div class="clearfix mb-1">

                                                    <span class="float-start"
                                                        onclick="copyLink('#item-{{ $key }}')">
                                                        <a href="#"><i class="fas fa-share-nodes"></i></a>
                                                    </span>
                                                    <span class="share-link visually-hidden"
                                                        id="item-{{ $key }}">{{ url('/') . '/' . $product->shop->url . '/' . $product->slug }}</span>

                                                    @if (auth()->user())
                                                        <span class="float-end">
                                                            @php
                                                                $wishlist =
                                                                    auth()
                                                                        ->user()
                                                                        ->wishlist()
                                                                        ->first() ?? false;
                                                            @endphp
                                                            <button class="border-0 bg-transparent" id="wishlist"
                                                                onclick="addWishlist(this, '{{ $product->slug }}'); this.firstElementChild.classList.toggle('fa')">
                                                                <i class="@if ($wishlist) {{ $wishlist->products()->where('id', $product->id)->count()? 'fa': 'far' }} @endif fa-heart"
                                                                    style="cursor: pointer"></i>
                                                            </button>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endisset
                @isset($shops)
                    <h5 class="fw-semibold text-uppercase">Cari Toko</h5>
                    {!! count($shops) ? '<h6>Menampilkan ' . count($shops) . ' Hasil</h6>' : '<h6>Tidak Dapat Menemukan Toko</h6>' !!}
                    <div class="col-12 col-lg-8">
                        <div class="row row-cols-md-4">
                            @foreach ($shops as $key => $shop)
                                <div class="col mb-3">
                                    <div class="card-product card border-0 shadow-hover" style="min-height: 24rem;">
                                        <img loading="lazy"src="/img/icons-512.png" class="card-img-top p-2"
                                            alt="Product Thumbnail">
                                        <div class="card-body">
                                            <h5 title="{{ $shop->name }}">
                                                <a class="stretched-link card-title fw-semibold text-decoration-none link-dark"
                                                    href="/{{ $shop->url }}">
                                                    {{ Str::limit($shop->name, 25, '...') }}
                                                </a>
                                            </h5>
                                            <small>{{ $shop->location }}</small>
                                            <p class="card-text">
                                                <i class="bi bi-star-half"></i> 5.0 <i class="bi bi-dot"></i>
                                                Ulasan
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </main>
    @include('utilities.footer')
    <script>
        function copyLink(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            $('.toast').toggleClass('show');
            setTimeout(() => {
                $('.toast').toggleClass('show')
            }, 1500);
        }
    </script>
    <script>
        function addWishlist(el, id) {
            $.ajax({
                type: "POST",
                url: "/wishlist",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                data: {
                    product: id
                },
                success: function(response) {
                    Toastify({
                        text: 'Product Added To Wishlist',
                        close: true,
                        style: {
                            background: "linear-gradient(to right, #4ade80, #bbf7d0)"
                        }
                    }).showToast();
                },
                error: function(response) {
                    Toastify({
                        text: response.responseText,
                        close: true,
                        style: {
                            background: "linear-gradient(to right, salmon, #fecdd3)"
                        }
                    }).showToast()
                }
            });
        }
    </script>
    <script>
        function resetFilters() {
            $.each($('form#filters input'), function(i, input) {
                input.value = ""
                location = '/products'
            });
        }
    </script>
@endsection
