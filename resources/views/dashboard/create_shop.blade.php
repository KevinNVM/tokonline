@extends('dashboard.layouts.main')

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('main')
    <div class="container-fluid px-4">
        @include('utilities.breadcrumb', ['title' => 'Create'])
        <h4>Halo, {{ $user->name }}. Untuk Membuat Toko Isi Dulu Formulir Dibawah Ini</h4>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Buat Toko Sendiri Gratis!
            </div>
            <div class="card-body">
                @if ($errors->count())
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('my-shop.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="name">Nama Toko</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" name="name"
                                placeholder="contoh: Toko {{ Str::words($user->name, 1, '') }}" required>
                            <div class="invalid-feedback">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="url">URL Toko</label>
                            <div class="d-flex align-items-center">
                                <code>{{ url('') . '/' }}</code>
                                <input type="text" id="url" class="form-control @error('url') is-invalid @enderror"
                                    value="{{ old('url') }}" name="url"
                                    placeholder="contoh: toko-{{ Str::words($user->name, 1, '') }}" required>
                                <div class="invalid-feedback">
                                    @error('url')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="location">Lokasi Toko</label>
                            <div class="mb-2">
                                <small class="d-block">Provinsi</small>
                                <select class="form-select @error('location.province') is-invalid @enderror"
                                    name="location.province" id="location_province" required>
                                    <option selected value="{{ old('location.province') }}">
                                        {{ old('location.province') ?? 'Pilih Provinsi' }}</option>
                                    {{-- Foreach Location Using Ajax --}}
                                </select>
                                @error('location.province')
                                    <p class="text-danger ms-3">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="">
                                <small class="d-block">Kabupaten/Kota</small>
                                <select class="form-select @error('location.regency') is-invalid @enderror"
                                    name="location.regency" id="location_regency" required>
                                    <option selected value="{{ old('location.province') }}">
                                        {{ old('location.province') ?? 'Pilih Provinsi Terlebih Dahulu' }}</option>
                                    {{-- Foreach Location Using Ajax --}}
                                </select>
                                @error('location.regency')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="whatsapp">No Whatsapp</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="whatsapp_label">+62</span>
                                <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                    value="{{ old('whatsapp') }}" placeholder="Masukkan No Whatsapp" id="whatsapp"
                                    name="whatsapp" required>
                                <div class="invalid-feedback">
                                    @error('whatsapp')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="desc">Deskripsi Toko</label>
                            <textarea placeholder="Deskripsi Toko Anda" name="desc" id="desc" cols="30" rows="5"
                                class="form-control @error('desc') is-invalid @enderror">{{ old('desc') }}</textarea>
                            <div class="invalid-feedback">
                                @error('desc')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="link_1">Tautan Eksternal 1</label>
                            <input type="url" placeholder="Masukkan Url Lengkap" name="link_1" id="link_1"
                                cols="30" rows="5" class="form-control @error('link_1') is-invalid @enderror">
                            @error('link_1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="link_2">Tautan Eksternal 2</label>
                            <input type="url" placeholder="Masukkan Url Lengkap" name="link_2" id="link_2"
                                cols="30" rows="5" class="form-control @error('link_2') is-invalid @enderror">
                            @error('link_2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-outline-success">Buat Toko</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let prov;
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(response => response.json())
                .then(
                    provinces => $.each(provinces, function(indexInArray, valueOfElement) {
                        $('select#location_province').append(
                            `<option value="${valueOfElement.name}" data-prov-id="${valueOfElement.id}">${valueOfElement.name}</option>`
                        );
                    }));

            $('select#location_province').on('change', (el) => {
                prov = $('select#location_province option:selected').data('prov-id');
                console.log(prov)
                $('select#location_regency').html('');
                fetch(
                        `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${prov}.json`
                    )
                    .then(response => response.json())
                    .then(
                        regencies => $.each(regencies, function(indexInArray, valueOfElement) {
                            $('select#location_regency').append(
                                `<option value="${valueOfElement.name}">${valueOfElement.name}</option>`
                            )
                        }));
            })


            $('select#location_province').select2();
            $('select#location_regency').select2();

            $('input#name').on('change', () => {
                fetch(`/utilities/getslug?string=${$('input#name').val()}`)
                    .then(response => response.json())
                    .then(data => $('input#url').val(data.slug))
            });

        });
    </script>
@endsection
