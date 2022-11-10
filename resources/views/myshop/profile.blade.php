<div class="col-12 bg-light shadow py-2 px-4 rounded">
    <div class="card border-0 bg-light mb-3">
        <div class="row g-0">
            <div class="col-md-4 rounded d-flex justify-content-center"
                style="background: rgb(221,41,198);
                background: linear-gradient(145deg, rgba(221,41,198,1) 0%, rgba(170,255,170,1) 100%);">
                <img loading="lazy"src="{{ asset('storage/images/profiles/' . $shop->owner->image) }}"
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
                    <p class="card-text"><i class="bi bi-geo-alt-fill"></i>
                        {{ join(' / ', json_decode($shop->location, true)) ?? '' }}</p>
                    <span class="card-text d-block mb-3"><i class="bi bi-star-half"></i> 4.5 Rata-rata
                        Ulasan
                        Produk</span>
                    <button class="btn btn-primary mb-1"><i class="bi bi-chat-dots"></i> Chat
                        Seller</button>
                    <button class="btn btn-outline-primary mb-1" onclick="openModals('shareThisShop', this)">
                        <i class="bi bi-share"></i>
                        Bagikan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="shareThisShop" class="modal">

    <!-- Modal content -->
    <div class="modal-content shareThisShopModal">
        <div class="modal-header">
            <span class="closeModalShare">&times;</span>
            <h4><i class="bi bi-share"></i> Bagikan</h4>
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
