<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark shadow">
        <div class="container">
            <a class="navbar-brand d-none d-sm-block" href="/"><img src="/img/icons-512.png" alt="Web Icons"
                    width="30" class="p-0 m-0 "></a>
            <form class="d-flex me-auto d-sm-none d-block" role="search">
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" placeholder="Cari Barang..">
                    <button class="input-group-text" type="submit" id="button-search"><i
                            class="fa-solid fa-magnifying-glass fa-lg"></i></button>
                </div>
            </form>
            <div class="position-fixed" style="top: 25; bottom: 25; right: 25; left: 25;">
                <h1>Hello World</h1>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('category*') ? 'active' : '' }}" href="/">Kategori</a>
                    </li>
                </ul>
                <form class="d-flex me-auto d-none d-sm-block w-50" role="search">
                    <div class="input-group flex-nowrap">
                        <input type="text" class="form-control" placeholder="Cari Barang..">
                        <button class="input-group-text" type="submit" id="button-search"><i
                                class="fa-solid fa-magnifying-glass fa-lg"></i></button>
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
