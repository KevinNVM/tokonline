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
                    <div class="sticky-top" style="top: 5em; z-index: 1;">
                        <div class="card rounded border-0 shadow position-relative">
                            <div class="card-body py-5 px-3">
                                <div class="d-flex align-items-center mb-4 pb-4 px-4 border-bottom"><i
                                        class="fa-solid fa-list fa-3x"></i>
                                    <div class="ms-3">
                                        <h4 class="text-uppercase fw-semibold mb-0">Kategori</h4>
                                        <p class="text-gray fst-italic mb-0">Produk Di Kategori
                                            {{ $sub_category->category->name }} <i class="fa-solid fa-angle-right"></i>
                                            {{ $sub_category->name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="accordion accordion-flush" id="category_list_accordion">
                                    @foreach ($categories->reverse() as $key => $category)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#category_list_{{ $key }}"
                                                    aria-expanded="false" aria-controls="category_list_{{ $key }}">
                                                    {{ $category->name }}
                                                </button>
                                            </h2>
                                            <div id="category_list_{{ $key }}"
                                                class="accordion-collapse collapse show"
                                                data-bs-parent="#category_list_accordion">
                                                <div class="accordion-body">
                                                    <ul class="list-group list-group-flush">
                                                        @if ($category->subcategory->count() > 0)
                                                            @foreach ($category->subcategory as $subcategory)
                                                                <li
                                                                    class="list-group-item d-flex justify-content-between bg-hover-sm">
                                                                    <a class="text-decoration-none link-dark stretched-link {{ explode('/', request()->path())[2] === $subcategory->slug ? 'fw-semibold' : '' }}"
                                                                        href="/category/{{ $category->slug . '/' . $subcategory->slug }}">
                                                                        {{ $subcategory->name }}
                                                                    </a>
                                                                    <span class="badge bg-info rounded-pill">
                                                                        {{ $subcategory->products->count() }}
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li class="list-group-item">
                                                                Sub Category Kosong.
                                                                <a class="link" href="#">Ajukan Untuk Mengisi</a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="row row-cols-md-4">
                        @foreach ($sub_category->products as $key => $product)
                            <div class="col mb-3">
                                <div class="card-product card border-0 shadow-hover" style="min-height: 24rem;">
                                    <img src="/img/icons-512.png" class="card-img-top p-2" alt="Product Thumbnail">
                                    <div class="card-body">
                                        <h5 title="{{ $product->name }}">
                                            <a class="stretched-link card-title fw-semibold text-decoration-none link-dark"
                                                href="/{{ $product->shop->url . '/' . $product->slug }}">
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
