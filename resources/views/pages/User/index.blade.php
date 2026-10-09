<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Kelola User - SITAFAS</title>

    {{-- GOOGLE FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">


    {{-- FONT AWESOME --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    {{-- SIDEBAR CSS --}}
    <link rel="stylesheet"
          href="{{ asset('css/sidebar.css') }}">


    {{-- USER CSS --}}
    <link rel="stylesheet"
          href="{{ asset('css/user.css') }}">


    {{-- SWEET ALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>


<body>


{{-- =====================================================
     SIDEBAR
===================================================== --}}

@include('pages.Layouts.sidebar')


{{-- =====================================================
     OVERLAY SIDEBAR
===================================================== --}}

<div class="sidebar-overlay"
     id="sidebarOverlay">
</div>


{{-- =====================================================
     MAIN CONTENT
===================================================== --}}

<main class="main-content">


    {{-- =================================================
         PAGE HEADER
    ================================================== --}}

    <div class="page-header">


        {{-- HEADER LEFT --}}

        <div class="header-left">


            {{-- HAMBURGER --}}

            <button type="button"
                    class="mobile-menu-button"
                    id="mobileMenuButton"
                    aria-label="Buka Menu">

                <i class="fa-solid fa-bars"></i>

            </button>


            {{-- TITLE --}}

            <div class="page-title-wrapper">

                <h1 class="page-title">
                    Kelola User
                </h1>

                <p class="page-subtitle">
                    Kelola akun Admin dan Petugas SITAFAS
                </p>

            </div>

        </div>


        {{-- =================================================
             USER LOGIN
        ================================================== --}}

        <div class="header-user">

            <div class="header-user-icon">

                <i class="fa-solid fa-user"></i>

            </div>


            <div class="header-user-info">

                <strong>
                    {{ Auth::user()->nama ?? 'Admin' }}
                </strong>

                <span>
                    Administrator
                </span>

            </div>

        </div>

    </div>



    {{-- =================================================
         SWEET ALERT SUCCESS
    ================================================== --}}

    @if(session('success'))

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                Swal.fire({

                    icon: 'success',

                    title: 'Berhasil!',

                    text: @json(session('success')),

                    confirmButtonText: 'OK',

                    confirmButtonColor: '#168fc1',

                    timer: 3000,

                    timerProgressBar: true

                });

            });

        </script>

    @endif



    {{-- =================================================
         SWEET ALERT ERROR
    ================================================== --}}

    @if(session('error'))

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                Swal.fire({

                    icon: 'error',

                    title: 'Gagal!',

                    text: @json(session('error')),

                    confirmButtonText: 'OK',

                    confirmButtonColor: '#d33'

                });

            });

        </script>

    @endif



    {{-- =================================================
         VALIDATION ERROR
    ================================================== --}}

    @if($errors->any())

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                Swal.fire({

                    icon: 'error',

                    title: 'Data belum lengkap',

                    html: `{!! implode('<br>', $errors->all()) !!}`,

                    confirmButtonText: 'OK',

                    confirmButtonColor: '#d33'

                });

            });

        </script>

    @endif



    {{-- =================================================
         CONTENT CARD
    ================================================== --}}

    <div class="content-card">


        {{-- =================================================
             CARD HEADER
        ================================================== --}}

        <div class="content-card-header">


            <div>

                <h2>
                    Daftar User
                </h2>

                <p>
                    Daftar akun yang terdaftar di sistem
                </p>

            </div>


            {{-- TAMBAH USER --}}

            <a href="{{ route('admin.users.create') }}"
               class="btn-primary">

                <i class="fa-solid fa-plus"></i>

                Tambah User

            </a>

        </div>



        {{-- =================================================
             FILTER AREA
        ================================================== --}}

        <div class="filter-area">


            {{-- SEARCH --}}

            <form method="GET"
                  action="{{ route('admin.users.index') }}"
                  class="search-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    id="searchUser"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari username, nama, atau email..."
                >

            </form>


            {{-- FILTER STATUS --}}

            <select class="filter-select"
                    onchange="window.location.href=this.value">


                <option value="{{ route('admin.users.index') }}">

                    Semua Status

                </option>


                <option
                    value="{{ route('admin.users.index', ['status' => 'aktif']) }}"
                    {{ request('status') == 'aktif' ? 'selected' : '' }}
                >

                    Aktif

                </option>


                <option
                    value="{{ route('admin.users.index', ['status' => 'nonaktif']) }}"
                    {{ request('status') == 'nonaktif' ? 'selected' : '' }}
                >

                    Nonaktif

                </option>


            </select>


        </div>



        {{-- =================================================
             TABLE
        ================================================== --}}

        <div class="table-wrapper">


            <table class="user-table"
                   id="userTable">


                <thead>

                    <tr>

                        <th>#</th>

                        <th>USER</th>

                        <th>EMAIL</th>

                        <th>ROLE</th>

                        <th>STATUS</th>

                        <th>AKSI</th>

                    </tr>

                </thead>


                <tbody>


                @forelse($users as $user)


                    <tr>


                        {{-- NOMOR --}}

                        <td>

                            {{ $users->firstItem() + $loop->index }}

                        </td>



                        {{-- USER --}}

                        <td>

                            <div class="user-info">


                                <div class="user-avatar">

                                    {{ strtoupper(substr($user->nama, 0, 1)) }}

                                </div>


                                <div class="user-details">

                                    <strong>
                                        {{ $user->nama }}
                                    </strong>

                                    <span>
                                        {{ '@' . $user->username }}
                                    </span>

                                </div>


                            </div>

                        </td>



                        {{-- EMAIL --}}

                        <td>

                            {{ $user->email ?? '-' }}

                        </td>



                        {{-- ROLE --}}

                        <td>


                            @if($user->role === 'admin')

                                <span class="role-badge admin">

                                    <i class="fa-solid fa-crown"></i>

                                    Admin

                                </span>

                            @else

                                <span class="role-badge petugas">

                                    <i class="fa-solid fa-user"></i>

                                    Petugas

                                </span>

                            @endif


                        </td>



                        {{-- STATUS --}}

                        <td>


                            @if($user->status === 'aktif')

                                <span class="status-badge active">

                                    <span></span>

                                    Aktif

                                </span>

                            @else

                                <span class="status-badge inactive">

                                    <span></span>

                                    Nonaktif

                                </span>

                            @endif


                        </td>



                        {{-- AKSI --}}

                        <td>


                            <div class="action-buttons">


                                {{-- EDIT --}}

                                <a
                                    href="{{ route('admin.users.edit', $user->id_user) }}"
                                    class="action-btn edit"
                                    title="Edit User"
                                >

                                    <i class="fa-solid fa-pen"></i>

                                </a>



                                {{-- TOGGLE STATUS --}}

                                <form
                                    method="POST"
                                    action="{{ route('admin.users.toggle', $user->id_user) }}"
                                    class="status-form"
                                >

                                    @csrf

                                    @method('PATCH')


                                    <button
                                        type="submit"
                                        class="action-btn status"
                                        title="{{ $user->status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}"
                                    >


                                        @if($user->status === 'aktif')

                                            <i class="fa-solid fa-user-slash"></i>

                                        @else

                                            <i class="fa-solid fa-user-check"></i>

                                        @endif


                                    </button>

                                </form>



                                {{-- DELETE --}}

                                <form
                                    method="POST"
                                    action="{{ route('admin.users.destroy', $user->id_user) }}"
                                    class="delete-form"
                                >

                                    @csrf

                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="action-btn delete delete-user"
                                        data-name="{{ $user->nama }}"
                                        title="Hapus User"
                                    >

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>


                            </div>


                        </td>


                    </tr>


                @empty


                    <tr>

                        <td colspan="6"
                            class="empty-data">


                            <i class="fa-solid fa-users-slash"></i>


                            <p>
                                Belum ada data user.
                            </p>


                        </td>

                    </tr>


                @endforelse


                </tbody>


            </table>


        </div>



        {{-- =================================================
             PAGINATION
        ================================================== --}}

        @if($users->hasPages())

            <div class="pagination">

                {{ $users->links() }}

            </div>

        @endif


    </div>


</main>



{{-- =====================================================
     USER JAVASCRIPT
===================================================== --}}

<script src="{{ asset('js/user.js') }}"></script>



{{-- =====================================================
     SWEET ALERT DELETE
===================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    document.querySelectorAll('.delete-user').forEach(function (button) {


        button.addEventListener('click', function (event) {

            event.preventDefault();


            const form =
                this.closest('form');


            const userName =
                this.dataset.name || 'user ini';


            Swal.fire({

                title: 'Hapus User?',

                text: 'Apakah Anda yakin ingin menghapus ' + userName + '?',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#d33',

                cancelButtonColor: '#6c757d',

                confirmButtonText: 'Ya, Hapus',

                cancelButtonText: 'Batal'

            }).then((result) => {


                if (result.isConfirmed) {

                    form.submit();

                }


            });


        });


    });


});

</script>


</body>

</html>