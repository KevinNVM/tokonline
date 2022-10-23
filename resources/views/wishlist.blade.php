@extends('layouts.main')

@push('head')
    <style>
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
    <link rel="stylesheet" href="/css/product-card.css">
@endpush

@section('content')
    @include('layouts.navbar')
    <div class="container" style="margin-top: 3em; max-width: 90%">
        <main class="mb-5">
            <div class="py-5">
                @include('utilities.breadcrumb')

                <h2 class="text-center">Wishlist</h2>
            </div>

            <div class="filters">

            </div>

            <div class="cart-container">
                <div class="cart-box">
                    <div class="d-flex justify-content-center spinner">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('utilities.footer')
    </div>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: `/wishlist_view`,
                success: function(response) {
                    $('.spinner').remove();
                    $('.cart-box').append(response)
                }
            });
        });
    </script>
    <script>
        function deleteItem(id, node) {
            $.ajax({
                type: 'DELETE',
                url: `/wishlist/General/`,
                data: {
                    product: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: (res) => {
                    swal.fire({
                        icon: 'success',
                        text: `Deleted From Your Wishlist`
                    });
                    $(node.parentNode).hide(200);
                },
            })
        }
    </script>
@endsection
