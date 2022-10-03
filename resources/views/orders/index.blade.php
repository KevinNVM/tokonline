@extends('layouts.main')

@push('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
@endpush

@push('script')
    <script>
        $('table').DataTable();
    </script>
@endpush

@section('content')
    @include('layouts.navbar')

    <main>
        <div class="container py-3">
            @include('utilities.breadcrumb', ['title' => 'Orders'])

            <h4 class="text-muted">{{ $title ?? '' }}</h4>

            <div class="row row-cols-1 g-3 px-0 px-md-4">
                @foreach ($orders as $order)
                    <div class="col">
                        <div class="card shadow border-0 rounded-4">
                            <div class="card-body shadow-hover">
                                <div class="d-flex justify-content-between" id="order_status">
                                    <div>
                                        <span class="fw-semibold"><i class="bi bi-bag"></i>
                                            {{ $order->type ?? 'Belanja' }}</span>
                                        <time class="d-block">{{ $order->created_at->diffForHumans() }}</time>
                                        <small class="text-muted">ODR-{{ $order->number }}</small>
                                    </div>
                                    <div>
                                        <span
                                            class="badge bg-opacity-25 @switch($order->payment_status)
                                            @case(1)
                                            bg-success text-success
                                            @break

                                            @case(2)
                                                bg-warning text-warning
                                            @break

                                            @case(3)
                                                bg-warning text-danger
                                            @break

                                            @default
                                                bg-danger text-danger
                                        @endswitch fs-6">{{ $order->getPaymentStatus($order->payment_status) }}</span>
                                    </div>
                                </div>
                                <?php $order->products = json_decode($order->products_json, false); ?>
                                <div class="d-flex justify-content-between py-3" id="products_detail">
                                    <div
                                        class="border-start d-flex flex-column justify-content-center align-items-center px-4">
                                        <small class="text-muted">Total Harga</small>
                                        <strong>Rp{{ number_format($order->total_price, '0', ',', '.') }}</strong>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start align-items-center gap-3 py-2" id="button_group">
                                    <button class="btn btn-outline-secondary">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    @if ($order->payment_status == 2)
                                        <button class="btn btn-outline-primary fw-semibold px-5" id="pay-button"
                                            onclick="location.href += '/{{ $order->number }}?hi=pay-button'">Bayar</button>
                                    @endif
                                    <a href="{{ route('orders.show', $order->number) }}" class="link text-success fw-bold">
                                        Lihat Detail Transaksi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </main>
@endsection
