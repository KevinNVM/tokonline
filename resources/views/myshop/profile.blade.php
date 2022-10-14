<div class="col-12 bg-light shadow py-2 px-4 rounded">
    <div class="card border-0 bg-light mb-3">
        <div class="row g-0">
            <div class="col-md-4 rounded d-flex justify-content-center"
                style="background: rgb(221,41,198);
                background: linear-gradient(145deg, rgba(221,41,198,1) 0%, rgba(170,255,170,1) 100%);">
                <img src="{{ asset('storage/images/profiles/' . $shop->owner->image) }}"
                    class="img-fluid rounded-circle py-4" width="175">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title fw-semibold me-3">{{ $shop->name }}</h5>
                        <button class="btn btn-primary btn-sm">Follow</button>
                    </div>
                    <span class="badge primary-bg p-2 fw-semibold text-dark">
                        {{ $shop->follower }} Followers
                    </span>
                    <small class="badge text-bg-{{ $shop->owner->status ? 'success' : 'danger' }}">
                        {{ $shop->owner->status ? 'Online' : 'Offline' }}
                    </small>
                    <p class="card-text"><i class="bi bi-geo-alt-fill"></i> {{ $shop->location ?? '' }}</p>
                    <span class="card-text d-block mb-3"><i class="bi bi-star-half"></i> 4.5 Rata-rata
                        Ulasan
                        Produk</span>
                    <button class="btn btn-primary mb-1"><i class="bi bi-chat-dots"></i> Chat
                        Seller</button>
                    <button class="btn btn-outline-primary mb-1" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"><i class="bi bi-info-circle"></i>
                        Tentang
                        Toko</button>
                    <button class="btn btn-outline-primary mb-1" data-bs-toggle="modal" data-bs-target="#ShareButton">
                        <i class="bi bi-share"></i> Bagikan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tentang Toko</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">

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
                                <a href="{{ $link }}" class="d-block link-primary">{{ $link }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
