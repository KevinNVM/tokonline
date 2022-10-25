@extends('layouts.main')

@push('head')
    <link rel="stylesheet" href="/css/hover.css">
@endpush

@section('content')
    @include('layouts.navbar-light')
    <main style="margin-top: 4rem; min-height: 85vh;">
        <div class="container-xl py-3">
            @include('utilities.breadcrumb')

            <h5 class="fw-semibold text-muted">Checkout</h5>
            <div class="row">
                <div class="col ">

                    <h6 class="fw-bold">Alamat Pengiriman</h6>
                    <hr>
                    <span class="d-block fw-bold">Teddy Dabukke <span class="fw-semibold">(Kantor)</span></span>
                    <pre class="d-inline">(+62) 323 9665 0650</pre>
                    <small class="d-block text-muted"><span class="text-dark">Kpg.</span> Jakarta No. 953 | Makassar |
                        15779</small>
                    <hr>
                    <button class="btn link-outline">Pilih Alamat Lain </button>
                    <hr class="thick my-4">

                    <div class="product">
                        <div class="my-1">
                            <div class="divider mb-4">
                                <div class="profile d-flex align-items-center">
                                    <img src="/img/icons-512.png" alt="Seller Profile Picture" width="30"
                                        class="img-fluid rounded-circle">
                                    <h6 class="fw-bold ms-2">Nama Seller</h6>
                                </div>
                                <small class="d-block text-muted fw-light">Jakarta Timur</small>
                                <div class="product-info mt-2 border-bottom">
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex align-items-center">
                                                <img src="/img/icons-512.png" alt="Seller Profile Picture" width="50"
                                                    class="img-fluid">
                                                <h6 class="fw-bold ms-2">Nama Barang</h6>
                                            </div>
                                            <small class="d-block">1 Barang (500Gr)</small>
                                            <p class="fw-bold">Rp250.000</p>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <h5 class="fw-semibold">Pilih Durasi</h5>
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="1">Ekonomi - 10.000</option>
                                                <option value="2" selected>Instan - 50.000</option>
                                                <option value="3">Same Day - 24.000</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="py-3 mb-2 subtotal">
                                <h6 class="fw-bold">Subtotal</h6>
                                <div class="d-flex justify-content-between mb-0 pb-0">
                                    <span class="d-block">
                                        Total Harga (1 Produk)
                                    </span>
                                    <span class="d-block">
                                        Rp250.000
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between mb-0 pb-0">
                                    <span class="d-block">
                                        Total Ongkos Kirim
                                    </span>
                                    <span class="d-block">
                                        Rp50.000
                                    </span>
                                </div>
                            </div>
                            <hr class="thick">
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-5 col-xxl-3 col-xl-4">
                    <div class="content sticky-top promotion" style="top: 4.5em;">
                        <div class="card border-0 shadow checkout-card">
                            <div class="card-body">
                                <h5 class="fw-semibold mb-2">Ringkasan Pembelian</h5>
                                <div class="d-flex justify-content-between mb-0 pb-0">
                                    <span class="d-block">
                                        Total Harga (1 Produk)
                                    </span>
                                    <span class="d-block">
                                        Rp250.000
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between mb-0 pb-0">
                                    <span class="d-block">
                                        Total Ongkos Kirim
                                    </span>
                                    <span class="d-block">
                                        Rp50.000
                                    </span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-2">
                                    <h5 class="fw-semibold">Total Harga :</h5>
                                    <h6>Rp300.000</h6>
                                </div>
                                <div class="d-grid">
                                    <button class="h5 checkout-button btn btn-primary">
                                        <i class="fa-solid fa-wallet fa-lg"></i></i> Pilih Metode Pembayaran
                                    </button>
                                    <small class="text-danger" style="font-size: smaller">Produk harus berada dalam toko
                                        yang sama.</small>
                                    <button class="h5 checkout-button btn btn-outline-primary">
                                        <i class="fa-brands fa-whatsapp fa-xl"></i></i> Lanjutkan Di Whatsapp
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    @include('utilities.footer')
@endsection
