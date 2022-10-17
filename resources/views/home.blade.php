<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    @include('resource.swal')
    @include('resource.icons')
    <link rel="stylesheet" href="/css/bootstrap5.css">
    <link rel="stylesheet" href="/css/jquery-ui.css">
    <link rel="stylesheet" href="/css/hover.css">
    <link rel="stylesheet" href="/css/color.css">
    <link rel="stylesheet" href="/css/product-card.css">
    <link rel="stylesheet" href="/css/autocomplete.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery-ui.js"></script>
    <script src="/js/bootstrap5.js"></script>
    @include('utilities.autocomplete')
    <title>E-Comm</title>

    <style>
        /* GLOBAL STYLES
        -------------------------------------------------- */
        /* Padding below the footer and lighter body text */

        body {
            padding-top: 3rem;
            padding-bottom: 3rem;
            color: #5a5a5a;
        }


        /* CUSTOMIZE THE CAROUSEL
        -------------------------------------------------- */

        /* Carousel base class */
        .carousel {
            margin-bottom: 4rem;
        }

        /* Since positioning the image, we need to help out the caption */
        .carousel-caption {
            bottom: 3rem;
            z-index: 10;
        }

        /* Declare heights because of positioning of img element */
        .carousel-item {
            height: 32rem;
        }


        /* MARKETING CONTENT
        -------------------------------------------------- */

        /* Center align the text within the three columns below the carousel */
        .marketing .col-lg-4 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* rtl:begin:ignore */
        .marketing .col-lg-4 p {
            margin-right: .75rem;
            margin-left: .75rem;
        }

        /* rtl:end:ignore */


        /* Featurettes
        ------------------------- */

        .featurette-divider {
            margin: 5rem 0;
            /* Space out the Bootstrap <hr> more */
        }

        /* Thin out the marketing headings */
        /* rtl:begin:remove */
        .featurette-heading {
            letter-spacing: -.05rem;
        }

        /* rtl:end:remove */

        /* RESPONSIVE CSS
       ------------------------------------------------- */

        @media (min-width: 40em) {

            /* Bump up size of carousel content */
            .carousel-caption p {
                margin-bottom: 1.25rem;
                font-size: 1.25rem;
                line-height: 1.4;
            }

            .featurette-heading {
                font-size: 38px;
            }
        }

        @media (min-width: 62em) {
            .featurette-heading {
                margin-top: 7rem;
            }
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>

</head>

<body>

    @include('layouts.navbar')

    <main>

        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="#777" />
                    </svg>

                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>Example headline.</h1>
                            <p>Some representative placeholder content for the first slide of the
                                carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="#777" />
                    </svg>

                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p>Some representative placeholder content for the second slide of the carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="#777" />
                    </svg>

                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1>One more for good measure.</h1>
                            <p>Some representative placeholder content for the third slide of this carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container marketing">
            <h5 class="featurette-heading fw-normal h5 mb-5">Toko Teratas</h5>

            <!-- Three columns of text below the carousel -->
            <div class="row">
                @foreach ($top_shops as $key => $item)
                    <div class="col-lg-4">
                        <img src="{{ asset('storage/images/profiles/' . $item->owner->image) }}" width="140"
                            height="140" class="img-fixed rounded-circle border ">

                        <h2 class="fw-normal">{{ $item->name }}</h2>
                        <p>{{ $item->desc ?? 'Some representative placeholder content foreach the three columns of text below the carousel. This is the first column.' }}
                        </p>
                        <p><a class="btn btn-outline-primary" href="/{{ $item->url ?? '/' }}">Kunjungi Toko
                                &raquo;</a>
                        </p>
                    </div><!-- /.col-lg-4 -->
                @endforeach
            </div><!-- /.row -->


            <hr class="featurette-divider">

            <h2 class="featurette-heading fw-normal">Produk Terbaru</h2>
            <div class="card-container">
                <div class="row row-cols-xxl-6">
                    @foreach ($newest_products as $key => $item)
                        @break($key == 6)
                        <div class="col mb-3">
                            <div class="card-product card border-0 shadow-hover" style="min-height: 24rem;">
                                <img src="{{ asset('/storage/images/products/' . json_decode($item->image, true)[0]) }}"
                                    class="card-img-top p-2" alt="Product Thumbnail">
                                <div class="card-body">
                                    <h5 title="{{ 'Lorem ipsum dolor sit amet' }}">
                                        <a class="stretched-link card-title fw-semibold text-decoration-none link-dark"
                                            href="/{{ $item->shop->url ?? '' }}/{{ $item->slug }}">
                                            {{ Str::limit($item->name, 25, '...') }}
                                        </a>
                                    </h5>
                                    <span
                                        class="h5 fw-bold d-block">Rp{{ number_format($item->price, 0, ',', '.') ?? '' }}</span>
                                    <small>{{ $item->shop->location ?? '' }}</small>
                                    <p class="card-text">
                                        <i class="bi bi-star-half"></i> {{ $item->rating ?? '0.0' }}
                                        <i class="bi bi-dot"></i>
                                        Terjual
                                        {{ $item->sold ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <small><a href="/products" class="text-decoration-none">Tampilkan Lebih Banyak</a></small>
                </div>
            </div>

            <hr class="featurette-divider">

            <h2 class="featurette-heading fw-normal">Teratas Pada Kategori <span
                    class="fw-semibold">{{ $top_on_category->name }}</span>
            </h2>
            <div class="card-container">
                <div class="row row-cols-xxl-6">
                    @foreach ($top_on_category->products()->visibility('public')->get() as $key => $item)
                        @break($key == 6)
                        <div class="col mb-3">
                            <div class="card-product card border-0 shadow-hover" style="min-height: 24rem;">
                                <img src="{{ asset('/storage/images/products/' . json_decode($item->image, true)[0]) }}"
                                    class="card-img-top p-2" alt="Product Thumbnail">
                                <div class="card-body">
                                    <h5 title="{{ $item->name }}">
                                        <a class="stretched-link card-title fw-semibold text-decoration-none link-dark"
                                            href="/{{ $item->shop->url }}/{{ $item->slug }}">
                                            {{ Str::limit($item->name, 25, '...') }}
                                        </a>
                                    </h5>
                                    <span
                                        class="h5 fw-bold d-block">Rp{{ number_format($item->price, 0, ',', '.') ?? '' }}</span>
                                    <small>{{ $item->shop->location ?? '' }}</small>
                                    <p class="card-text">
                                        <i class="bi bi-star-half"></i> {{ $item->rating ?? '5.0' }}
                                        <i class="bi bi-dot"></i> Terjual
                                        {{ $item->sold ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <small><a href="/products" class="text-decoration-none">Tampilkan Lebih Banyak</a></small>
                </div>
            </div>

            <hr class="featurette-divider">

            <h2 class="featurette-heading fw-normal">
                Terlaris
            </h2>
            <div class="card-container">
                <div class="row row-cols-xxl-6">
                    @foreach ($best_seller as $key => $item)
                        @break($key == 6)
                        <div class="col mb-3">
                            <div class="card-product card border-0 shadow-hover" style="min-height: 24rem;">
                                <img src="{{ asset('/storage/images/products/' . json_decode($item->image, true)[0]) }}"
                                    class="card-img-top p-2" alt="Product Thumbnail">
                                <div class="card-body">
                                    <h5 title="{{ $item->name }}">
                                        <a class="stretched-link card-title fw-semibold text-decoration-none link-dark"
                                            href="/{{ $item->shop->url }}/{{ $item->slug }}">
                                            {{ Str::limit($item->name, 25, '...') }}
                                        </a>
                                    </h5>
                                    <span
                                        class="h5 fw-bold d-block">Rp{{ number_format($item->price, 0, ',', '.') ?? '' }}</span>
                                    <small>{{ $item->shop->location }}</small>
                                    <p class="card-text">
                                        <i class="bi bi-star-half"></i> 5.0 <i class="bi bi-dot"></i> Terjual
                                        {{ $item->sold }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <small><a href="/products" class="text-decoration-none">Tampilkan Lebih Banyak</a></small>
                </div>
            </div>

            <hr class="featurette-divider">

            <h2 class="featurette-heading fw-normal">
                Produk Lainnya
            </h2>
            <div class="card-container d-flex flex-column justify-content-center">
                <div class="row row-cols-xxl-6 g-4 inf-col">
                </div>
                <button class="border-0 bg-transparent link " onclick="inf()" id="loadMore">Load More...</button>
            </div>

        </div><!-- /.container -->


        @if (auth()->check())
            <input type="button" class="btn btn-primary toggle-modal" data-bs-toggle="modal"
                value="Launch demo modal" id="toggle-modal-email-warn" hidden data-bs-target="#email-warn">

            <div class="modal fade" id="email-warn" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hello, {{ auth()->user()->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex justify-content-center my-2 mx-2">


                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <span>
                                            Verify Your Email Address
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            Before you continue, Please verify your email by clicking the link we've
                                            sent to <span
                                                class="text-primary">{{ auth()->user()->email ?? 'Your Email' }}</span>.
                                            You can close this
                                            window if you already verified your email.
                                        </p>
                                        <small class="d-block">This Proccess Shouldn't Take More Than 5
                                            Minutes.</small>
                                        <small>
                                            Didn't Receive The Email?
                                            <form action="{{ route('verification.send') }}" class="d-inline"
                                                method="POST">
                                                @csrf @method('POST')
                                                <button class="bg-transparent border-0 link-primary link">
                                                    Re-Send Email Verification
                                                </button>
                                            </form>
                                        </small>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-123"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </main>

    @include('utilities.footer')
    <script src="/js/mobile-check.js"></script>
    <script>
        setTimeout(() => {
            $('#loadMore').click();
        }, 1500);
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

        function hotkeys() {
            $('body').on('keydown', function(e) {
                if (e.code === 'KeyK' || e.which === 191) {
                    e.preventDefault();
                    $('#search').focus()
                } else if (e.which === 27) {
                    $('#search').blur()
                }
            });
        }
        hotkeys();

        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        let page = 1;
        let inf = () => {

            jQuery.ajax({
                type: "POST",
                url: `/utilities/inf-item?page=${page}`,
                success: function(response) {
                    if (page === response.items.last_page) return $('#loadMore').attr('onclick', '').html(
                        'End Of Page').attr('disabled', '');
                    var formatter = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                    });
                    page += 1;
                    $.each(response.items.data, function(indexInArray, valueOfElement) {
                        $('.inf-col').append(`
                        <div class="col mb-3">
                            <div class="card-product card border-0 shadow-hover" style="min-height: 24rem;">
                                <img src="${JSON.parse(valueOfElement.image)[0]}" class="card-img-top p-2" alt="Product Thumbnail">
                                <div class="card-body">
                                    <h5 title="${valueOfElement.name}">
                                        <a class="stretched-link card-title fw-semibold text-decoration-none link-dark"
                                            href="/${valueOfElement.shop.url}/${valueOfElement.slug}">
                                            ${valueOfElement.name.slice(0, 25)}
                                        </a>
                                    </h5>
                                    <span
                                        class="h5 fw-bold d-block">${formatter.format(valueOfElement.price)}</span>
                                    <small>${valueOfElement.shop.location}</small>
                                    <p class="card-text">
                                        <i class="bi bi-star-half"></i> 5.0 <i class="bi bi-dot"></i> Terjual
                                        ${valueOfElement.sold}
                                    </p>
                                </div>
                            </div>
                        </div> `);
                    });
                }
            });
        }


        if (!mobileCheck()) {
            $('#bottombar').remove();
        }
    </script>
    @if (session('alert'))
        <script>
            swal.fire({
                text: '{{ session('alert') }}'
            })
        </script>
    @endif
    @if (session('msg'))
        <script>
            swal.fire({
                text: '{{ session('msg')['body'] ?? '' }}',
                title: '{{ session('msg')['title'] ?? '' }}',
                icon: '{{ session('msg')['status'] ?? '' }}',

            })
        </script>
    @endif
    @if (auth()->check())
        @if (!auth()->user()->hasVerifiedEmail())
            <script>
                setTimeout(() => {
                    $('#toggle-modal-email-warn').click();
                }, 250)
            </script>
        @endif
    @endif
</body>

</html>
