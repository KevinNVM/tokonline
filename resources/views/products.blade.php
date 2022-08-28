@extends('layouts.main')

@section('content')
    @dd($products)
    @include('layouts.navbar')
    <main class="py-2" style="margin-top: 4em;">
        <div class="container">
            @include('utilities.breadcrumb')

            <div class="row">
                <div class="col-12 col-md-8">
                    <h5 class="fw-semibold text-muted">All Products</h5>
                    <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                        @foreach ($products as $product)
                            <div class="col hp">
                                <div class="card h-100 shadow-sm">
                                    <a href="#">
                                        <img src="https://m.media-amazon.com/images/I/81gK08T6tYL._AC_SL1500_.jpg"
                                            class="card-img-top" alt="product.title" />
                                    </a>

                                    <div class="label-top shadow-sm">
                                        <a class="text-white" href="#">asus</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="clearfix mb-3">
                                            <span class="float-start badge rounded-pill bg-success">1.245$</span>

                                            <span class="float-end"><a href="#"
                                                    class="small text-muted text-uppercase aff-link">reviews</a></span>
                                        </div>
                                        <h5 class="card-title">
                                            <a target="_blank" href="#">ASUS TUF FX505DT Gaming Laptop- 15.6", 120Hz
                                                Full HD, AMD Ryzen 5 R5-3550H Processor, GeForce GTX 1650 Graphics, 8GB
                                                DDR4, 256GB PCIe SSD, RGB Keyboard, Windows 10 64-bit - FX505DT-AH51</a>
                                        </h5>

                                        <div class="d-grid gap-2 my-4">

                                            <a href="#" class="btn btn-warning bold-btn">add to cart</a>

                                        </div>
                                        <div class="clearfix mb-1">

                                            <span class="float-start"><a href="#"><i
                                                        class="fas fa-question-circle"></i></a></span>

                                            <span class="float-end">
                                                <i class="far fa-heart" style="cursor: pointer"></i>

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col">
                    <div class="container sticky-top" style="top: 5em;">
                        <h5 class="text-muted fw-semibold">Links</h5>
                        <ul class="list-group list-group-flush" style="list-style: none;">
                            @for ($i = 0; $i < 10; $i++)
                                <li>&raquo; <a href="#" class="link">Somewhere..</a></li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('utilities.footer')
@endsection
