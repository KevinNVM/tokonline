<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Dashboard</div>
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-columns"></i></div>
                    Dashboard
                </a>
                <a class="nav-link {{ request()->is('dashboard/profile*') ? 'active' : '' }}" href="/dashboard/profile">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-address-card"></i></div>
                    Profile
                </a>
                <a class="nav-link collapsed {{ request()->is('shop*') ? 'active' : '' }}" href="/dashboard/shop"
                    data-bs-toggle="collapse" data-bs-target="#shop-drop" aria-expanded="false"
                    aria-controls="shop-drop">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-shop"></i></div>
                    Shop
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ request()->is('shop*') ? 'show' : '' }}" id="shop-drop"
                    aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="d-flex gap-2 nav-link {{ request()->is('shop') ? 'active' : '' }}" href="/shop">
                            <i class="fa-solid fa-house"></i> Beranda
                        </a>
                        <div class="sb-sidenav-menu-heading">Tambah Data</div>
                        <a class="d-flex gap-2 nav-link {{ request()->is('shop/products/create') ? 'active' : '' }}"
                            href="{{ route('products.create') }}">
                            <i class="fa-solid fa-plus"></i> Produk Baru
                        </a>
                        <a class="d-flex gap-2 nav-link {{ request()->is('shop/create') ? 'active' : '' }}"
                            href="/dashboard/shop/catalog/create">
                            <i class="fa-solid fa-plus"></i> Katalog Baru
                        </a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Settings</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Layouts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Static Navigation</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Str::words(auth()->user()->name, 1, '') }}
        </div>
    </nav>
</div>
