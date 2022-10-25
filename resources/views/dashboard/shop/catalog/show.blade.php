@extends('layouts.main')

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

@push('script')
    <script>
        $('#table_products').DataTable();
    </script>
@endpush

@section('content')
    @include('layouts.navbar')
    <main>
        <div class="container-xl py-3">

            @include('utilities.breadcrumb', ['title' => "{$catalog->name}"])

            <div class="row">
                <div class="col">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-warning mb-3"><i
                            class="bi bi-arrow-left"></i>
                        Back</a>
                    <h5 class="text-muted">Produk dalam katalog '<span class="fw-semibold">{{ $catalog->name }}</span>'
                    </h5>

                    <div class="table-responsive">
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
                                @foreach ($catalog->products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a class="link text-dark"
                                                href="/{{ $product->shop->url }}/{{ $product->slug }}">
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
                                            class="{{ $product->price > ($product->shop->products->max('price') * 1) / 2 ? 'bg-warning text-dark' : 'bg-warning bg-opacity-25 text-dark' }}">
                                            Rp{{ number_format($product->price, 0, ',', '.') }}</td>

                                        <td
                                            class="{{ ($product->sold < 25 ? 'bg-warning bg-opacity-25 text-dark' : $product->sold < 50) ? 'bg-warning bg-opacity-50 text-dark' : 'bg-warning bg-opacity-75 text-dark' }}">
                                            {{ $product->sold }}</td>

                                        <td title="Double Click To Change Format"
                                            data-format-date="{{ $product->created_at }}" role="button"
                                            ondblclick="this.innerHTML = this.innerHTML !== this.getAttribute('data-format-date') ? this.getAttribute('data-format-date') : '{{ $product->created_at->diffForHumans() }}'">
                                            {{ $product->created_at->diffForHumans() }}</td>

                                        <td class="d-flex gap-2">
                                            <a href="{{ route('products.edit', $product->slug) }}"
                                                class="text-success link">
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

        </div>
    </main>
@endsection
