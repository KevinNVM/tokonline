@extends('dashboard.layouts.main')

@section('main')
    <div class="main p-3">

        @include('utilities.breadcrumb', ['title' => 'Dashboard'])

        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderList as $order)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td><a class="link link-dark"
                                    href="/{{ $order->product->shop->url }}/{{ $order->product->slug }}">{{ $order->product->name ?? '' }}</a>
                            </td>
                            <td>{{ $order->status }}</td>
                            <td class="d-flex">
                                <a class="link link-info mx-2" onclick="deleteOrder(this, {{ $order->id }})"
                                    role="button"><i class="fa fa-trash"></i></a>
                                <a class="link link-secondary mx-2" role="button"><i class="fa fa-flag"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="/js/time.js"></script>
    <script>
        function deleteOrder(btn, id) {
            $.ajax({
                type: "DELETE",
                url: "/shop/order-list/" + id,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                success: function(res) {
                    $(btn.parentNode.parentNode).hide(200);
                    swal.fire('deleted')
                },
            });
        }
    </script>
@endsection
