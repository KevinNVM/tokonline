<header>
    <nav class="navbar navbar-dark {{ $pos ?? '0' ?: 'fixed-top' }} bg-dark shadow">
        <div class="container">
            <a class="navbar-brand" role="button"
                onclick="Swal.fire({
                title: 'Apakah Anda Yakin Ingin Keluar?',
                text: 'Informasi Saat Ini Tidak Akan Disimpan',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar'
              }).then((result) => {
                if (result.isConfirmed) {
                  location = '/';
                } else {
                    return false;
                }
              })">
                <img loading="lazy"src="/img/icons-512.png" alt="Web Icons" width="30" class="p-0 m-0 ">
                E-Comm
            </a>
        </div>
    </nav>
</header>
