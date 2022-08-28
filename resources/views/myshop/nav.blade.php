<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ request()->is($shop->url) ? 'active' : '' }}" aria-current="page"
            href="/{{ $shop->url }}">Produk</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is($shop->url . '/catalog') ? 'active' : '' }}"
            href="/{{ $shop->url }}/catalog">Katalog</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is($shop->url . '/about') ? 'active' : '' }}"
            href="/{{ $shop->url }}/about">Tentang Toko</a>
    </li>
</ul>
