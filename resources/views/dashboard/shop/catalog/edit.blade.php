@extends('dashboard.layouts.main')

@push('head')
    <link rel="stylesheet" href="/css/hover.css">
    <script src="/js/curr_format.js" defer></script>
@endpush

@push('foot')
    <script>
        $('#name').on('input change', ({
            currentTarget
        }) => {
            $.ajax({
                type: "get",
                url: "/utilities/getslug",
                data: {
                    string: currentTarget.value
                },
                success: function(response) {
                    $('#slug').val(response.slug)
                    $('#catalog_url').text(response.slug)
                }
            });
        })
    </script>
@endpush

@section('main')
    <div class="main p-3">
        @include('utilities.breadcrumb', ['title' => 'Post Produk Baru'])

        <div class="card shadow-hover">
            <div class="card-header">
                <i class="fa-solid fa-plus"></i> Tambah Katalog Baru
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">

                        @if ($errors->count())
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Update Failed!</strong>
                                <ul>
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Main Form --}}
                        <form action="{{ route('catalogs.update', $catalog->slug) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="slug" id="slug">
                            <div class="mb-3">
                                <label for="name">Nama Katalog</label>
                                <input type="text" id="name" maxlength="75"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', $catalog->name) }}" placeholder="ex: Laptop Gaming" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <code>
                                    <div class="text-muted d-inline">URL Katalog :</div>
                                    {{ env('APP_URL') }}/{{ auth()->user()->shop->url }}/catalog/<span
                                        id="catalog_url">[NamaKatalog]</span>
                                </code>
                            </div>
                            <div class="mb-3">
                                <label for="desc">Deskripsi Katalog</label>
                                <textarea type="text" id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc"
                                    placeholder="ex: Katalog Yang Berisi Laptop Laptop Gaming">{{ old('desc', $catalog->desc) }}</textarea>
                                @error('desc')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-outline-primary px-4">Edit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
