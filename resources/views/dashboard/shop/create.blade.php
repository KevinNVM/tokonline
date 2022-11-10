@extends('dashboard.layouts.main')

@push('head')
    <link rel="stylesheet" href="/css/hover.css">
@endpush

@section('main')
    <div class="main p-3">
        @include('utilities.breadcrumb', ['title' => 'Post Produk Baru'])

        <div class="card shadow-hover">
            <div class="card-header">
                <i class="fa-solid fa-plus"></i> Tambah Produk Baru
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">

                        {{-- Main Form --}}
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="d-flex flex-column">
                                {{-- <div class="d-flex flex-column align-items-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="mb-3">
                                            <img loading="lazy"src="/img/icons-512.png" width="250">
                                        </div>
                                        <div class="d-block d-lg-flex flex-row">
                                            <div class="mb-3">
                                                <img loading="lazy"src="/img/icons-512.png" width="125" class="mx-1">
                                            </div>
                                            <div class="mb-3">
                                                <img loading="lazy"src="/img/icons-512.png" width="125" class="mx-1">
                                            </div>
                                            <div class="mb-3">
                                                <img loading="lazy"src="/img/icons-512.png" width="125" class="mx-1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="thumbnail1">Gambar Produk Utama</label>
                                        <input type="file" class="form-control" id="thumbnail1" name="img1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="thumbnail2">Gambar Produk 2</label>
                                        <input type="file" class="form-control" id="thumbnail2" name="img2">
                                    </div>
                                    <div class="mb-3">
                                        <label for="thumbnail3">Gambar Produk 3</label>
                                        <input type="file" class="form-control" id="thumbnail3" name="img3">
                                    </div>
                                    <div class="mb-3">
                                        <label for="thumbnail4">Gambar Produk 4</label>
                                        <input type="file" class="form-control" id="thumbnail4" name="img4">
                                    </div>
                                </div> --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger pt-4 my-2">
                                        <h6 class="fw-semibold">Error!</h6>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}"
                                        placeholder="ex: Laptop Gaming Ram 16GB SSD 512GB" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="desc">Deskripsi Produk</label>
                                    <textarea type="text" class="form-control @error('desc') is-invalid @enderror" name="desc"
                                        placeholder="ex: Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, voluptates voluptatibus vero, explicabo vel libero iure qui tempore quam sit quibusdam quos ullam voluptatem accusantium veritatis necessitatibus dolorum optio amet!"
                                        required>{{ old('desc') }}</textarea>
                                    @error('desc')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="weight">Berat Produk</label>
                                    <input type="number" class="form-control @error('weight') is-invalid @enderror"
                                        min="0" name="weight" value="{{ old('weight') }}"
                                        placeholder="ex: 1 -> 1Kg, 0.5 -> 500g/0.5Kg" required>
                                    @error('weight')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="condition">Kondisi Produk</label>
                                    <select name="condition" id="condition"
                                        class="form-select @error('condition') is-invalid @enderror" required>
                                        <option value="1" {{ old('condition') == 1 ? 'selected' : '' }}>Baru</option>
                                        <option value="0" {{ old('condition') != 1 ? '' : 'selected' }}>Bekas</option>
                                    </select>
                                    @error('condition')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="stock">Stok Produk</label>
                                    <input type="number" min="0"
                                        class="form-control @error('stock') is-invalid @enderror" name="stock"
                                        value="{{ old('stock') }}" placeholder="ex: 200" required>
                                    @error('stock')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="price">Harga Produk</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text"
                                            class="form-control @error('price') is-invalid @enderror rounded-end"
                                            min="0" value="{{ old('price') }}" placeholder="ex: 100000 -> 100.000"
                                            onchange="this.value = $.number( $('input[name=price]').val(), 0, ',', '.' )"
                                            oninput="$('input[name=price]').val(this.value)" required>
                                        <input type="hidden" name="price">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="catalog">Katalog</label>
                                    <select name="catalog_id" id="catalog" class="form-select" required>
                                        <optgroup label="Katalog on {{ $shop->name }}">
                                            @foreach ($shop->catalog as $catalog)
                                                <option value="{{ $catalog->id }}"
                                                    {{ old('catalog_id') == $catalog->id ? 'selected' : '' }}>
                                                    {{ $catalog->name }}</option>
                                            @endforeach
                                        </optgroup label="Pilih Katalog">
                                    </select>
                                    @error('catalog_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="category">Kategori</label>
                                    <select name="sub_category_id" id="category" class="form-select" required>
                                        @foreach ($categories as $category)
                                            <optgroup label="Kategori: {{ $category->name }}">
                                                @if ($category->subcategory->count())
                                                    @foreach ($category->subcategory as $subcategory)
                                                        <option value="{{ $subcategory->id }}"
                                                            {{ old('sub_category_id') == $subcategory->id ? 'selected' : '' }}>
                                                            · {{ $subcategory->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="" disabled>- Sub Category is Empty -</option>
                                                @endif
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @error('sub_category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="confirm d-flex flex-column gap-2">
                                <div class="check user-select-none">
                                    <input type="checkbox" id="confirm" class="form-check-input"
                                        onchange="if(this.checked){$('button#submit').removeAttr('disabled')}else{$('button#submit').attr('disabled', 'true')}">
                                    <label for="confirm">
                                        <small>Data yang diisi sudah sesuai dan siap untuk di post.</small>
                                    </label>
                                </div>
                                <div class="mb-3 d-grid col-6 col-md-4 col-lg-2">
                                    <button class="btn btn-primary shadow-hover" id="submit" disabled>Buat
                                        Produk</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/curr_format.js"></script>
@endsection
