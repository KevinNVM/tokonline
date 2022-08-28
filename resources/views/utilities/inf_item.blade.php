@foreach ($products as $key => $item)
    <div class="col mb-3">
        <div class="card-product card border-0 shadow-hover" style="min-height: 24rem;">
            <img src="/img/icons-512.png" class="card-img-top p-2" alt="Product Thumbnail">
            <div class="card-body">
                <h5 title="{{ $item->name }}">
                    <a class="stretched-link card-title fw-semibold text-decoration-none link-dark"
                        href="/{{ $item->shop->url }}/{{ $item->slug }}">
                        {{ Str::limit($item->name, 25, '...') }}
                    </a>
                </h5>
                <span class="h5 fw-bold d-block">Rp{{ number_format($item->price, 0, ',', '.') ?? '' }}</span>
                <small>{{ $item->shop->location }}</small>
                <p class="card-text">
                    <i class="bi bi-star-half"></i> 5.0 <i class="bi bi-dot"></i> Terjual
                    {{ $item->sold }}
                </p>
            </div>
        </div>
    </div>
@endforeach
