@extends('layouts.main')

@section('content')
    @include('layouts.navbar')

    <main>
        <div class="container py-3">
            @include('utilities.breadcrumb', ['title' => 'Order List'])

            {{-- List --}}

            <div class="row">
                <div class="col">
                    @foreach ($orders as $order)
                        <div class="card border-0 rounded-4 shadow mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="text-muted fw-semibold">
                                        #{{ $order->number }}
                                    </div>
                                    <div>
                                        <span
                                            class="badge bg-opacity-25 @switch($order->payment_status)
                                            @case(1)
                                                bg-warning text-warning
                                                @break
                                            @case(2)
                                                bg-success text-success
                                            @break

                                            @case(3)
                                                bg-warning text-danger
                                            @break

                                            @case(4)
                                            @default
                                                bg-danger text-danger
                                        @endswitch">
                                            {{ $order->getPaymentStatus($order->payment_status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 d-flex justify-content-between">
                                            <span>
                                                Rp{{ number_format($order->total_price, 2, ',', '.') }}
                                            </span>
                                            <span>
                                                {{ $order->created_at->diffForHumans() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item border-0">
                                            {{ count(json_decode($order->products_json)) }} Produk
                                        </li>
                                        <li class="list-group-item border-0 d-flex gap-2 align-items-center">
                                            @if ($order->payment_status == 1)
                                                <button class="btn btn-primary"
                                                    onclick="location += '/{{ $order->number }}?hi=pay-button'">
                                                    Bayar
                                                </button>
                                            @endif
                                            <a class="link-success link fw-semibold" href="/orders/{{ $order->number }}">
                                                Lihat Detail Pesanan
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </main>
@endsection
