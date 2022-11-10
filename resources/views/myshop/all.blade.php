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
                <div class="col-12 mt-5">
                    <form>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput"
                                placeholder="Cari di Toko: {{ $shop->name }}" name="search"
                                value="{{ request()->search ?? '' }}">
                            <label for="floatingInput">
                                <i class="fa-solid fa-magnifying-glass"></i> Cari di Toko: {{ $shop->name }}
                            </label>
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Order" name="orderBy"
                                onchange="$(this).parents('form:first').submit()">
                                <option disabled>Order By</option>
                                <option value="asc" {{ request()->orderBy == 'asc' ? 'selected' : '' }}>Latest
                                </option>
                                <option value="oldest" {{ request()->orderBy == 'oldest' ? 'selected' : '' }}>
                                    Oldest
                                </option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col mt-5">
                    @if ($products->count())
                        <div class="row row-cols-xxl-6">
                            @foreach ($products as $key => $product)
                                <div class="col mb-3">
                                    <div class="card-product card border-0 shadow-hover" style="min-height: 24rem;">
                                        <img loading="lazy"src="{{ asset('storage/images/products/' . json_decode($product->image)[0]) }}"
                                            class="card-img-top p-2" alt="Product Thumbnail">
                                        <div class="card-body">
                                            <small class="badge text-bg-warning">{{ $product->catalog->name }}</small>
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
                                                <i class="bi bi-star-half"></i> 5.0 <i class="bi bi-dot"></i>
                                                Terjual {{ $product->sold }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

    </main>
    @include('utilities.footer')
    <script src="/js/share.js"></script>
@endsection
