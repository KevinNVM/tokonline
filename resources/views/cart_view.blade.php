<div class="row g-5 justify-content-center">
    <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Daftar Keranjang</span>
            <span class="badge bg-primary rounded-pill">{{ $carts->count() }}</span>
        </h4>

        <ul class="list-group mb-3">
            @foreach ($carts as $item)
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <div class="d-flex align-items-center">
                            <img src="/img/icons-512.png" alt="Product Thumbnail" width="25" class="img-fluid me-3">
                            <span class="my-0 h6"><a class="link text-dark"
                                    href="/{{ $item->shop->url . '/' . $item->slug }}/">{{ $item->name }}</a>
                                ·
                                <b>x{{ $item->pivot->count }}</b></span>
                        </div>
                        <small class="text-muted">Rp{{ number_format($item->pivot->subtotal, 0, ',', '.') }}</small>
                    </div>
                    <div>
                        <span class="text-info">
                            <a role="button" class="rounded-3 text-info text-decoration-none"
                                onclick="location = `/cart/{{ $item->id }}/edit`"><i class="bi bi-pencil"></i>
                            </a>
                        </span>
                        <span class="text-danger">
                            <a role="button" class="rounded-3 text-danger text-decoration-none"
                                onclick="Swal.fire({
                                    title: 'Hapus Barang?',
                                    showCancelButton: true,
                                    icon: 'warning',
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                        location = '/cart/delete/{{ base64_encode($item->slug) }}/{{ base64_encode($item->id) }}'
                                    }})">
                                <i class="bi bi-trash"></i>
                            </a>
                        </span>
                    </div>
                </li>
                @if ($item->pivot->notes)
                    <div class="bg-light list-group-item">
                        <small class="fw-semibold d-block" aria-label="Catatan untuk penjual">Catatan Untuk
                            Penjual
                            :
                        </small>
                        {{ $item->pivot->notes }}
                    </div>
                    <hr class="semi-thick">
                @endif
            @endforeach
            <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                    <h6 class="my-0">Promo code</h6>
                    <small>EXAMPLECODE</small>
                </div>
                <span class="text-success">−$5</span>
                <span class="text-muted"><a role="button"><i class="bi bi-trash"></i></a></span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (IDR)</span>
                <strong id="total-price">Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
            </li>
        </ul>

        <form class="card p-2">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Promo code">
                <button type="submit" class="btn btn-secondary">Redeem</button>
            </div>
        </form>
        <div class="d-grid mt-3">
            <form action="/orders" class="d-grid" method="POST">
                @csrf
                <input type="hidden" name="products_json" value="{{ $carts }}">
                <button class="btn btn-primary my-1">Beli ({{ $carts->count() }})</button>
            </form>
            <form action="/cart/deleteall?token={{ csrf_token() }}" method="POST">
                @method('delete')
                @csrf
                <a onclick="Swal.fire({
                    title: 'Kosongkan Keranjang Belanja?',
                    showCancelButton: true,
                    icon: 'warning',
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parents('form:first').submit()
                    }})"
                    class="btn btn-outline-salmon my-1 w-100">Kosongkan
                    Keranjang</a>
            </form>
        </div>
    </div>
</div>
