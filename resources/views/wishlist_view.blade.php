<div class="card-container">
    <div class="row row-cols-xxl-6">
        @foreach ($wishlist as $key => $product)
            <div class="col mb-3">
                <div class="card-product card border-0 shadow-hover" style="min-height: 24rem;">
                    <img src="{{ asset('/storage/images/products/' . json_decode($product->image, true)[0]) }}"
                        class="card-img-top p-2" alt="Product Thumbnail">
                    <div class="card-body">
                        <h5 title="{{ $product->name }}">
                            <a class="stretched-link card-title fw-semibold text-decoration-none link-dark"
                                href="/{{ $product->shop->url }}/{{ $product->slug }}">
                                {{ Str::limit($product->name, 25, '...') }}
                            </a>
                        </h5>
                        <span
                            class="h5 fw-bold d-block">Rp{{ number_format($product->price, 0, ',', '.') ?? '' }}</span>
                        <small>
                            @if ($product->shop->location)
                                {{ json_decode($product->shop->location, 1)['regency'] }}
                            @endif
                        </small>
                        <p class="card-text">
                            <i class="bi bi-star-half"></i> 5.0 <i class="bi bi-dot"></i> Terjual
                            {{ $product->sold }}
                        </p>
                    </div>
                    <div class="buttons position-absolute rounded-4"
                        style="width: 100%; height: 100px; background: linear-gradient(to bottom left ,rgba(0, 0, 0, .2),rgba(0, 0, 0, .02), rgba(0, 0, 0, 0)); z-index:2;">
                        <div class="button-groups d-flex justify-content-end">
                            <button class="btn btn-sm text-danger rounded-4"
                                onclick="deleteItem('{{ $product->slug }}', this.parentNode.parentNode.parentNode)">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
