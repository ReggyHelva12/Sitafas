<nav class="navbar navbar-main navbar-expand-sm shadow-none" id="navbarBlur" data-scroll="true">
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            @yield('breadcrumbs')
        </nav>

        <div class="collapse navbar-collapse" id="navbar" style="overflow: visible !important;">
            <div class="dropdown show"
                style="justify-self: flex-end; max-width: fit-content; margin-left: auto;">

                @php
                    $user = auth()->user();

                    // DEFAULT UNTUK ADMIN / USER BIASA
                    $namaUser = $user->username;
                    $fotoProfil = asset('images/default-user.png');

                    // GURU / PENGAJAR
                    if ($user->hasRole('guru') && isset($user->guru) && $user->guru) {
                        $namaUser = $user->guru->nama;

                        if (!empty($user->guru->foto)) {
                            $fotoProfil = asset('storage/' . $user->guru->foto);
                        }
                    }

                    // SISWA
                    elseif ($user->hasRole('siswa') && isset($user->siswa) && $user->siswa) {
                        $namaUser = $user->siswa->nama;

                        if (!empty($user->siswa->foto)) {
                            $fotoProfil = asset('storage/' . $user->siswa->foto);
                        }
                    }

                    // KEPSEK
                    elseif ($user->hasRole('kepsek') && isset($user->guru) && $user->guru) {
                        $namaUser = $user->guru->nama;

                        if (!empty($user->guru->foto)) {
                            $fotoProfil = asset('storage/' . $user->guru->foto);
                        }
                    }

                    // ADMIN FOTO OTOMATIS DARI AVATAR
                    elseif ($user->hasRole('admin')) {
                        $fotoProfil = "https://ui-avatars.com/api/?name=" . urlencode($user->username) . "&background=0D8ABC&color=fff";
                    }
                @endphp

                <button type="button"
                    class="btn btn-primary dropdown-toggle d-flex align-items-center gap-3 px-3 py-2 shadow-sm"
                    data-bs-toggle="dropdown"
                    id="profile-dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    style="
                        border-radius: 14px;
                        border: 2px solid rgba(255,255,255,0.25);
                        min-height: 58px;
                    ">

                    <img src="{{ $fotoProfil }}"
                        alt="Foto Profil"
                        width="60"
                        height="60"
                        class="rounded-circle"
                        style="
                            object-fit: cover;
                            border: 3px solid white;
                            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
                            flex-shrink: 0;
                        ">

                    <strong class="text-white mb-0">
                        {{ $namaUser }}
                    </strong>

                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile-dropdown">

                    <li>
                        <a class="dropdown-item" href="{{ route('profil') }}">
                            <i class="fa fa-user-circle me-2"></i>
                            Profil Saya
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="/option/change-password">
                            <i class="fa fa-lock me-2"></i>
                            Edit Password
                        </a>
                    </li>

                    @if (count(array_diff(explode(',', auth()->user()->role), ['root'])) > 1)
                        <li>
                            <a href="javascript:void(0)"
                                data-bs-toggle="modal"
                                data-bs-target="#update-navbar-role-modal"
                                class="dropdown-item"
                                onclick="navbarSetCheckedRole()">
                                <i class="fa fa-exchange-alt me-2"></i>
                                Ganti Role
                            </a>
                        </li>
                    @endif

                    <li>
                        <form action="{{ route('logout') }}" method="POST"
                            onsubmit="return confirm('Apakah anda yakin akan keluar?')">
                            @csrf

                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fa fa-sign-out-alt me-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>

            </div>
        </div>
    </div>

    @if (count(array_diff(explode(',', auth()->user()->role), ['root'])) > 1)
        <div class="modal fade" id="update-navbar-role-modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white">
                            Ganti Role
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('set_role') }}" method="post" class="row g-3 px-4">
                            @csrf

                            <div style="display:flex; flex-wrap:wrap; gap:10px;">
                                @foreach (explode(',', auth()->user()->role) as $value_role)
                                    @if ($value_role != 'root')
                                        <div style="display:flex; gap:5px;">
                                            <input type="radio"
                                                name="role"
                                                value="{{ $value_role }}"
                                                id="navbar-role-{{ $value_role }}"
                                                current-role="{{ auth()->user()->current_role }}">

                                            <label for="navbar-role-{{ $value_role }}">
                                                {{ ucfirst($value_role) }}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-secondary btn-sm"
                                    data-bs-dismiss="modal">
                                    Tutup
                                </button>

                                <button type="submit"
                                    class="btn btn-primary btn-sm">
                                    Simpan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function navbarSetCheckedRole() {
                const input = document.querySelectorAll("#update-navbar-role-modal input[type='radio']");

                input.forEach(function(radio) {
                    if (radio.getAttribute('current-role') == radio.value) {
                        radio.checked = true;
                    }
                });
            }
        </script>
    @endif

</nav>