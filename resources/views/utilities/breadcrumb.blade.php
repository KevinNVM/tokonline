<link rel="stylesheet" href="/css/hover.css">
<?php
$url = request()->getPathInfo();
$items = explode('/', $url);
unset($items[0]);
?>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
    aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/" class="link">Home</a></li>

        @foreach ($items as $key => $item)
            @if ($key == count($items))
                <li class="breadcrumb-item active" aria-current="page">{{ str()->words($title, 2, '...') ?? '' }}</li>
            @else
                <?php
                $cut_from = array_search($item, $items, true);
                $link = implode('/', array_slice($items, 0, $cut_from));
                ?>
                <li class="breadcrumb-item"><a href="/{{ $link }}" class="link">{{ Str::ucfirst($item) }}</a>
                </li>
            @endif
        @endforeach

    </ol>
</nav>
<hr class="semi-thick">
