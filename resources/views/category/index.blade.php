@extends('layouts.main')

@section('content')
    @include('layouts.navbar')
    <main style="margin-top: 4em;">
        <div class="container-xl py-3">
            @include('utilities.breadcrumb')

            <div class="row g-3 d-flex justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="sticky-top" style="top: 5em; z-index: 1;">
                        <div class="card rounded border-0 shadow position-relative">
                            <div class="card-body py-5 px-3">
                                <div class="d-flex align-items-center mb-4 pb-4 px-4 border-bottom"><i
                                        class="fa-solid fa-list fa-3x"></i>
                                    <div class="ms-3">
                                        <h4 class="text-uppercase fw-semibold mb-0">Kategori</h4>
                                        <p class="text-gray fst-italic mb-0">Daftar Kategori
                                        </p>
                                        @if (auth()->user()->isAdmin ?? false)
                                            <a role="button" id="btnOpenCategoryModal">Tambah Kategori /
                                                Sub-Kategori</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="accordion accordion-flush" id="category_list_accordion">
                                    @foreach ($categories->reverse() as $key => $category)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#category_list_{{ $key }}"
                                                        aria-expanded="false"
                                                        aria-controls="category_list_{{ $key }}">
                                                        {{ $category->name }}
                                                    </button>
                                                    @if (auth()->user()->isAdmin ?? false)
                                                        <a role="button" onclick="editCategory(this, id)"
                                                            class="badge fs-6 text-bg-danger rounded-pill me-2">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </h2>
                                            <div id="category_list_{{ $key }}"
                                                class="accordion-collapse collapse show"
                                                data-bs-parent="#category_list_accordion">
                                                <div class="accordion-body">
                                                    <ul class="list-group list-group-flush">
                                                        @if ($category->subcategory->count() > 0)
                                                            @foreach ($category->subcategory as $subcategory)
                                                                <li
                                                                    class="list-group-item d-flex justify-content-between bg-hover-sm">
                                                                    <a class="text-decoration-none link-dark stretched-link"
                                                                        href="{{ request()->getPathInfo() . '/' . $category->slug }}/{{ $subcategory->slug }}">
                                                                        {{ $subcategory->name }}
                                                                    </a>
                                                                    <div>
                                                                        <span class="badge bg-info rounded-pill">
                                                                            {{ $subcategory->products->count() }}
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li class="list-group-item">
                                                                Sub Category Kosong.
                                                                <a class="link" href="#">Ajukan Untuk Mengisi</a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="categoryModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content notificationModal">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreateCategoryLabel">Tambah Kategori / Sub-Kategori</h1>
                <span class="closeCategoryModal">&times;</span>
            </div>
            <div class="modal-body d-flex flex-column gap-2">

                <form action="{{ route('category.store') }}" method="post" id="createCategory">
                    @csrf
                    <div class="card border-0">
                        <div class="card-header">Tambah Kategori</div>
                        <div class="mb-3 mt-3">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="mb-3 ">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug"
                                value="{{ old('slug') }}">
                        </div>
                        <div class="mb-3 ">
                            <label for="desc">Deskripsi</label>
                            <textarea name="desc" id="desc" rows="7" class="form-control">{{ old('desc') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </form>

                <hr class="thick">

                <form action="/category/subcategory" method="post" id="createSubCategory">
                    @csrf
                    <div class="card border-0">
                        <div class="card-header">
                            <h1 class="card-title fs-5" id="modalCreateSubCategoryLabel">Tambah Sub-Kategori</h1>
                        </div>
                        <div class="card-body">

                            <div class="mb-3 mt-3">
                                <label for="category_id">Kategori</label>
                                <select name="category_id" id="category_id" class="form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="mb-3 ">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug"
                                    value="{{ old('slug') }}">
                            </div>
                            <div class="mb-3 ">
                                <label for="desc">Deskripsi</label>
                                <textarea name="desc" id="desc" rows="7" class="form-control">{{ old('desc') }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </form>

            </div>


        </div>

    </div>
@endsection

@push('script')
    <script>
        $('form#createCategory').on('submit', (e) => {
            e.preventDefault()
            var data = $('form#createCategory').serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});
            $.ajax({
                type: "post",
                url: "/category",
                data: data,
                success: function(response) {
                    Toastify({
                        text: 'Category Created',
                        style: {
                            background: "linear-gradient(to right, #4ade80, #bbf7d0)"
                        },
                        close: true,
                        duration: 2000,
                        stopOnFocus: true
                    }).showToast()
                },
                error: (e) => {
                    Toastify({
                        text: e.responseJSON.message,
                        close: true,
                        style: {
                            background: "linear-gradient(to right, salmon, #fecdd3)"
                        }
                    }).showToast()
                }
            });
        })
    </script>
    <script>
        $('form#createSubCategory').on('submit', (e) => {
            e.preventDefault()
            var data = $('form#createSubCategory').serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});
            $.ajax({
                type: "post",
                url: "/category/subcategory",
                data: data,
                success: function(response) {
                    Toastify({
                        text: 'Sub-Category Created',
                        style: {
                            background: "linear-gradient(to right, #4ade80, #bbf7d0)"
                        },
                        close: true,
                        duration: 2000,
                        stopOnFocus: true
                    }).showToast()
                },
                error: (e) => {
                    Toastify({
                        text: e.responseJSON.message,
                        close: true,
                        style: {
                            background: "linear-gradient(to right, salmon, #fecdd3)"
                        }
                    }).showToast()
                }
            });
        })
    </script>
    <script>
        // Get the modal
        var modal = document.getElementById("categoryModal");

        // Get the button that opens the modal
        var btn = document.getElementById("btnOpenCategoryModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closeCategoryModal")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endpush
