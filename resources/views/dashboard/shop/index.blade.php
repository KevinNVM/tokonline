@extends('dashboard.layouts.main')

@push('head')
    <style>
        a.paginate_button {
            user-select: none;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="/css/hover.css">
@endpush

@section('main')
    <div class="container-fluid px-4">

        @include('utilities.breadcrumb', ['title' => 'Shop'])

        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Newest Products Tab</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Best Seller Tab</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Products
            </div>
            <div class="card-body table-responsive">
                <div class="more-options mb-3">
                    <a class="text-decoration-none" data-bs-toggle="collapse" href="#collapseExample" role="button"
                        aria-expanded="false" aria-controls="collapseExample">
                        More Options...
                    </a>
                    <div class="collapse mt-3" id="collapseExample">
                        <div class="card card-body border-0">
                            <form action="{{ route('products.snap') }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" type="button"
                                    onclick="swal.fire({
                                    'text': 'Hapus Semua Item ?',
                                    'icon': 'warning',
                                    'confirmButtonText': 'Yes',
                                    'showCancelButton': true,
                                    'reverseButtons': true
                                }).then(result => {
                                    if (result.isConfirmed) $(this).parents('form:first').submit();
                                })">Delete
                                    All Products</button>
                            </form>
                        </div>
                    </div>
                </div>
                <table id="table_products" class="display">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Visibilitas Produk</th>
                            <th>Berat Produk</th>
                            <th>Kondisi Produk</th>
                            <th>Stok Produk</th>
                            <th>Harga Produk</th>
                            <th>Produk Terjual</th>
                            <th>Produk Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shop->products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a class="link text-dark" href="/{{ $shop->url }}/{{ $product->slug }}">
                                        {{ $product->name }}
                                    </a>
                                </td>

                                <td>
                                    {{ $product->getVisibility($product->visibility) }}
                                </td>

                                <td title="Double Click To Change Format"
                                    data-format-weight="{{ $product->weight * 1000 }} g" role="button"
                                    ondblclick="this.innerHTML = this.innerHTML !== this.getAttribute('data-format-weight') ? this.getAttribute('data-format-weight') : '{{ $product->weight }} Kg'">
                                    {{ $product->weight }} Kg</td>

                                <td
                                    class="{{ $product->condition ? 'bg-success bg-opacity-100' : 'bg-secondary bg-opacity-100' }} text-light">
                                    {{ $product->condition ? 'Baru' : 'Bekas' }}</td>

                                <td
                                    class="{{ (($product->stock > 25 ? 'text-light bg-info bg-opacity-25' : $product->stock > 50) ? 'text-light bg-info bg-opacity-50' : $product->stock > 75) ? 'text-light bg-info bg-opacity-75' : 'text-light bg-danger bg-opacity-100' }}">
                                    {{ $product->stock }}</td>

                                <td
                                    class="{{ $product->price > ($shop->products->max('price') * 1) / 2 ? 'bg-warning text-dark' : 'bg-warning bg-opacity-25 text-dark' }}">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}</td>

                                <td
                                    class="{{ ($product->sold < 25 ? 'bg-warning bg-opacity-25 text-dark' : $product->sold < 50) ? 'bg-warning bg-opacity-50 text-dark' : 'bg-warning bg-opacity-75 text-dark' }}">
                                    {{ $product->sold }}</td>

                                <td title="Double Click To Change Format" data-format-date="{{ $product->created_at }}"
                                    role="button"
                                    ondblclick="this.innerHTML = this.innerHTML !== this.getAttribute('data-format-date') ? this.getAttribute('data-format-date') : '{{ $product->created_at->diffForHumans() }}'">
                                    {{ $product->created_at->diffForHumans() }}</td>

                                <td class="d-flex gap-2">
                                    <a href="{{ route('products.edit', $product->slug) }}" class="text-success link">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->slug) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="border-0 text-danger link rounded" type="button"
                                            onclick="swal.fire({
                                            'text': 'Hapus Item ?',
                                            'icon': 'question',
                                            'confirmButtonText': 'Yes',
                                            'showCancelButton': true,
                                            'reverseButtons': true
                                        }).then(result => {
                                            if (result.isConfirmed) $(this).parents('form:first').submit();
                                        })">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('foot')
    <script>
        $(document).ready(function() {
            $('#table_products').DataTable();

        });
    </script>
@endpush
