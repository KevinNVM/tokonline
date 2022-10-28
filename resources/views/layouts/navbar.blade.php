<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content notificationModal">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h4>
                Notification
            </h4>
        </div>
        <div class="modal-body d-flex flex-column">
            <div class="row">No new Notification</div>
            <div class="d-flex justify-content-between">
                @if (auth()->user()->isAdmin ?? false)
                    <a role="button" data-bs-toggle="modal" data-bs-target="#newNotificationModal"
                        class="text-muted link">
                        Manage
                    </a>
                @endif
                <a role="button" onclick="getNotification(); notifNew ? '' : this.remove()" class="text-muted link">
                    Load More
                </a>
            </div>
        </div>

    </div>

</div>

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
                                    <li><a class="dropdown-item" href="#notificationModal" id="myBtn"
                                            rel="modal:open"><i class="fa-solid fa-bell"></i>
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
                                    <li><a href="/dashboard/profile" class="dropdown-item"><i
                                                class="fa-solid fa-user"></i>
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
                            <a href="/login" class="nav-link"><i class="fa-solid fa-arrow-right-to-bracket"></i>
                                Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>



@if (\App\Helper\MobileCheck::Check(request()->server('HTTP_USER_AGENT')) && false)
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
@endif

<nav class="d-none d-print-block">
    <a class="navbar-brand" href="/">
        <img src="/img/icons-512.png" alt="Logo" width="35" class="img-fluid">
    </a>
</nav>
<div class="modal" id="notificationModal" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-lg" style="overflow-x: hidden;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="notificationModalLabel">Notification</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="notification-wrapper">
                    <div class="row row-cols-1 g-2">

                    </div>
                    <div class="d-flex justify-content-between">
                        @if (auth()->user()->isAdmin ?? false)
                            <a role="button" data-bs-toggle="modal" data-bs-target="#newNotificationModal"
                                class="text-muted link">
                                Manage
                            </a>
                        @endif
                        <a role="button" onclick="getNotification(); notifNew ? '' : this.remove()"
                            class="text-muted link">
                            Load More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (auth()->user()->isAdmin ?? false)
    <div class="modal fade" id="newNotificationModal" tabindex="-1" aria-labelledby="newNotificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-lg-down modal-lg"
            style="overflow-x: hidden;">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="newNotificationModalLabel">Manage Notification</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="new-notification-wrapper">
                        <div class="row row-cols-1 g-2">
                            <div class="col border-bottom">
                                <div class="card-body">
                                    <ul class="list-group list-notification">

                                    </ul>
                                </div>
                            </div>
                            <div class="col border-bottom">
                                <h4 class="text-muted fw-semibold">
                                    Create New
                                </h4>
                                <div class="card-body">
                                    <form action="{{ route('notification.store') }}" id="notifStore">
                                        <div class="mb-3">
                                            <label for="name">
                                                Name
                                            </label>
                                            <input required class="form-control" type="text" name="name"
                                                id="name" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="body">
                                                Body
                                            </label>
                                            <textarea required class="form-control" type="text" name="body" id="body" cols="30"
                                                rows="10"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="receiver">
                                                Receiver (username)
                                            </label>
                                            <input required type="text" class="form-control" name="receiver"
                                                id="receiver">
                                        </div>

                                        <div class="mb-3">
                                            <button class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<script src="/js/nl2br.js"></script>
<script>
    let notifPage = 1;
    let notifNew = true;

    function getNotification() {
        $.ajax({
            type: "get",
            url: "/notification?page=" + notifPage,
            headers: {
                "X-CSRF-TOKEN": $('meta[name=_token]').attr('content')
            },
            success: function(response) {
                notifPage++
                if (!response.next_page_url) notifNew = false;
                for (const i in response.data) {

                    let date = new Date(response.data[i].created_at),
                        readableDate =
                        `${date.getHours()}:${date.getMinutes()} ${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`
                    if (response.data) $('.notificationModal > .modal-body > .row').html('')
                    $('.notificationModal > .modal-body > .row').append(`
                            <div class="col border-bottom pb-3">
                                <div class="text-muted d-flex align-items-center justify-content-between">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4>${response.data[i].name}</h4>
                                        <?php if (auth()->user()->isAdmin ?? false) : ?>
                                        <small class="badge bg-danger rounded-pill ms-4">
                                                    <a role="button" onclick="deleteNotif(this, '${response.data[i].slug}')" class="bg-transparent border-0 text-white btn-sm"><i
                                                            class="fa fa-trash"></i></a>
                                            </small>
                                        <?php endif; ?>
                                        </div>
                                    <small>${readableDate}</small>
                                </div>
                                <div class="notification-body">
                                    ${nl2br(response.data[i].body)}
                                </div>
                            </div>
                            `);
                }
            }
        });
    }
    getNotification()
</script>
@if (auth()->user()->isAdmin ?? false)
    <script>
        $('form#notifStore').on('submit', (e) => {
            e.preventDefault()
            var data = $('form#notifStore').serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});


            $.ajax({
                type: "POST",
                url: "{{ route('notification.store') }}",
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name=_token]').attr('content')
                },
                success: function(response) {
                    swal.fire('Notification Created', 'success');
                    $('.notification-wrapper > .row').html('')
                    getNotification();
                    $.each($('form#notifStore input'), (i, el) => {
                        el.value = ''
                    })
                    $.each($('form#notifStore textarea'), (i, el) => {
                        el.value = ''
                    })
                },
                error: (e) => swal.fire('Failed', e.responseText)
            });

        });
    </script>
    <script>
        function deleteNotif(el, id) {
            $(el.parentNode.parentNode.parentNode.parentNode).hide(200)
            $.ajax({
                type: "DELETE",
                url: "/notification/" + id,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name=_token]').attr('content')
                },

            });
        }
    </script>
@endif
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

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
