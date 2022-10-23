<header>
    <nav id="topbar" class="navbar navbar-expand-lg navbar-dark text-bg-dark fixed-top d-print-none"
        style="z-index: 50">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/img/icons-512.png" alt="Logo" width="35" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('category*') ? 'active' : '' }}"
                            href="/category">Kategori</a>
                    </li>
                </ul>
                <div class="col-12 col-md-8">
                    <form class="d-flex input-group flex-nowrap" role="search" action="/products" id="form-search">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle rounded-0 rounded-start" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false" id="search-for">
                                Cari
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" role="button"
                                        onclick="$('#form-search').attr('action', '/products'); $('#search-for').html('Cari Produk')">
                                        Cari Produk
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" role="button"
                                        onclick="$('#form-search').attr('action', '/shops'); $('#search-for').html('Cari Toko')">
                                        Cari Di Toko
                                    </a>
                                </li>
                                <li><button class="dropdown-item" role="button" disabled>Cari Di Kategori</button></li>
                            </ul>
                        </div>
                        <input class="form-control" id="search" type="search" onfocus="$('body').unbind();"
                            onclick="$(this).on('keypress', (e) => {if (e.which === 13) $('#form-search').submit()})"
                            name="search" onblur="hotkeys()" placeholder="Cari di.. [/ or K]" aria-label="Search"
                            autocomplete="off" maxlength="300"
                            value="{{ request('search') === str_replace('/', '', request()->getPathInfo()) ? '' : request('search') }}">
                    </form>
                </div>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="nav-link bg-transparent border-0 p-0 dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (!auth()->user()->hasVerifiedEmail())
                                        <span class="badge rounded-pill text-bg-warning">!</span>
                                    @endif
                                    <i class="fa-solid fa-user"></i>
                                    {{ Str::words(auth()->user()->name, 1, '') }}
                                </button>
                                <ul class="dropdown-menu">
                                    @if (!auth()->user()->hasVerifiedEmail())
                                        <li>
                                            <a href="{{ route('verification.notice') }}" class="dropdown-item">
                                                Verify Your Email
                                            </a>
                                        </li>
                                        <li class="dropdown-divider"></li>
                                    @endif
                                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bell"></i>
                                            Notifikasi</a></li>
                                    <li><a class="dropdown-item" href="/orders"><i class="fa-solid fa-list"></i>
                                            Pesanan</a></li>
                                    <li>
                                        <a class="dropdown-item" href="/cart"><i class="fa-solid fa-cart-shopping"></i>
                                            Keranjang <span @php $user = auth()->user() @endphp
                                                class="badge text-bg-secondary">{{ $user->cart ? $user->cart->products->count() : '!!!' }}</span></a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/wishlist"><i class="fa-regular fa-heart"></i>
                                            Wishlist <span
                                                class="badge text-bg-secondary">{{ $user->wishlist->count() ? $user->wishlist->first()->products->count() : '!!!' }}</span></a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li><a href="/dashboard/profile" class="dropdown-item"><i class="fa-solid fa-user"></i>
                                            Profil</a></li>
                                    <li><a class="dropdown-item" href="/shop"><i class="fa-solid fa-shop"></i>
                                            Toko</a></li>
                                    <li>
                                        <a role="button" class="dropdown-item"
                                            onclick="Swal.fire({title:'Confirm Logout',text:'Are You Sure?',icon:'question',showCancelButton:true,confirmButtonText:'Yes',cancelButtonText: 'Cancel',reverseButtons: true}).then((result)=>{if(result.isConfirmed)location='/logout?token={{ csrf_token() }}'})">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="/login" class="nav-link"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>



<!-- Bottom Navbar -->
<nav id="bottombar" class="navbar navbar-dark bg-dark navbar-expand fixed-bottom p-0 d-print-none">
    <ul class="navbar-nav nav-justified w-100 pt-2">
        <li class="nav-item">
            <a href="/home" class="nav-link text-center {{ request()->RouteIs('home') ? 'active' : '' }}">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                    <path fill-rule="evenodd"
                        d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                </svg>
                <span class="small d-block">Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/cart" class="nav-link text-center {{ request()->is('cart*') ? 'active' : '' }}">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <span class="small d-block">Cart</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/dashboard/profile" class="nav-link text-center" role="button" id="dropdownMenuProfile"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                </svg>
                <span class="small d-block">Profile</span>
            </a>
        </li>
    </ul>
</nav>

<nav class="d-none d-print-block">
    <a class="navbar-brand" href="/">
        <img src="/img/icons-512.png" alt="Logo" width="35" class="img-fluid">
    </a>
</nav>
