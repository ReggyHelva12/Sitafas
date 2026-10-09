<link rel="stylesheet"
href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
rel="stylesheet">

<style>
/* SIDEBAR BACKGROUND */
.sidebar-custom {
    background: linear-gradient(180deg, #0875cf, #203a43, #2c5364);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    min-height: 100vh;
    transition: 0.3s;
}

/* LOGO AREA */
.sidebar-custom img {
    filter: drop-shadow(0 0 5px rgba(0, 55, 255, 0.3));
}

/* MENU UTAMA */
.sidebar-custom .btn {
    color: #e0e0e0 !important;
    border-radius: 12px;
    transition: 0.3s;
}

/* HOVER MENU */
.sidebar-custom .btn:hover {
    background: rgba(112, 152, 189, 0.99);
    transform: translateX(5px);
}

/* ACTIVE MENU */
.bg-gradient-primary {
    background: linear-gradient(135deg, #397cb6, #0e78b9) !important;
    box-shadow: 0 4px 15px rgba(0, 242, 254, 0.5);
}

/* SUB MENU */
.sidebar-custom .link-light {
    transition: 0.3s;
    padding-left: 10px;
}

.sidebar-custom .link-light:hover {
    background: rgba(255,255,255,0.08);
    border-radius: 8px;
    padding-left: 15px;
}

/* ICON */
.material-symbols-outlined {
    color: #ffffff;
    font-size: 20px;
    font-variation-settings:
    'FILL' 1,
    'wght' 400,
    'GRAD' 0,
    'opsz' 24;
}

/* ICON MATERIAL */
.material-icons {
    color: #ffffff;
    font-size: 20px;
}

/* SCROLLBAR (BIAR KEREN) */
.sidebar-custom::-webkit-scrollbar {
    width: 6px;
}

.sidebar-custom::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.2);
    border-radius: 10px;
}

/* TEXT */
.sidebar-custom span,
.sidebar-custom a {
    font-size: 14px;
    letter-spacing: 0.3px;
}
</style>    

<div class="flex-shrink-0 p-3 sidebar-custom" >
    <a href="/" class="d-flex align-items-center pb-3 my-4 link-dark text-decoration-none"
        style="border-bottom: 2px solid white; justify-content: center">
        <div class="text-white w-auto "
            style="display: flex; align-items: center; justify-content: center; column-gap: 3px">
            {{-- <img src="{{ asset('assets/img/web-icon-brain.png') }}" alt="HTML tutorial"
            style="height: 36px;filter:brightness(0%) invert(90%)"> --}}
            <img src="{{ asset('assets/img/LOGO DUTA .png') }}" alt="HTML tutorial" style="height: 60px;">
            {{-- <span class="ms-1 font-weight-bold text-white" style="font-size:23px">Smart School</span> --}}
        </div>
    </a>
    <ul class="list-unstyled ps-0" style="width: 100%">

        <li class="mb-1">
    <a href="{{
        auth()->user()->current_role == 'guru'
            ? route('dashboard.guru')
            : route('dashboard.admin')
    }}"
       class="btn rounded text-white font-weight-bold d-flex align-items-center gap-2
       {{
            request()->routeIs('dashboard.admin') ||
            request()->routeIs('dashboard.guru')
                ? 'bg-gradient-primary'
                : ''
       }}"
       style="text-transform:none; width:100%;">

        <span class="material-symbols-outlined">
            dashboard
        </span>

        Dashboard
    </a>
</li>
        @if (auth()->user()->hasRole('admin'))
            <li class="mb-1" style="width: 100%">
                <button class="btn align-items-center rounded collapsed text-white font-weight-bold"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px;"
                    data-bs-toggle="collapse" data-bs-target="#master-collapse" aria-expanded="true">
                    <span class="material-symbols-outlined">  dashboard_customize </span> Master <i
                        class="material-icons opacity-10 ms-auto">expand_more</i>
                </button>
                <div class="collapse {{ Request::is('administrasi/guru*') || Request::is('administrasi/siswa*') || Request::is('akademik/mapel*') || Request::is('sarana/kelas*') || Request::is('sarana/ruang*') || Request::is('sarana/barang*') ? 'show' : '' }}"
                    id="master-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 {{ Request::is('administrasi/users*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/administrasi/users"><i
                                    class="material-icons opacity-10 mx-2">manage_accounts</i> Data User</a>
                        </li>
                        <li><a class="link-light rounded mb-1 {{ Request::is('administrasi/guru*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/administrasi/guru"><i
                                    class="material-icons opacity-10 mx-2">school</i> Data
                                Pengajar</a></li>
                        <li><a class="link-light rounded mb-1 {{ Request::is('administrasi/siswa*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/administrasi/siswa"><i
                                    class="material-icons opacity-10 mx-2">groups</i> Data
                                Murid</a></li>
                        <li><a class="link-light rounded mb-1 {{ Request::is('akademik/mapel*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/akademik/mapel"><i
                                    class="material-icons opacity-10 mx-2">menu_book</i> Data Mata
                                Pelajaran</a></li>
                        <li><a class="link-light rounded mb-1 {{ Request::is('sarana/kelas*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/sarana/kelas"><i
                                    class="material-icons opacity-10 mx-2">meeting_room</i> Data Kelas</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="mb-1" style="width: 100%">
                <button class="btn align-items-center rounded collapsed text-white font-weight-bold"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px"
                    data-bs-toggle="collapse" data-bs-target="#kurikulum-collapse" aria-expanded="false">
                    <span class="material-symbols-outlined">
                    school
                    </span>
                    Kurikulum <i class="material-icons opacity-10 ms-auto">expand_more</i>
                </button>

                <div class="collapse {{
    request()->routeIs('jadwal.*')
    ? 'show'
    : ''
}}" id="kurikulum-collapse">

    {{-- JADWAL PELAJARAN --}}
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
        <li>
            <a class="link-light rounded mb-1 {{
                request()->routeIs('jadwal.biasa') ||
                request()->routeIs('jadwal.kelas')
                ? 'bg-gradient-primary'
                : ''
            }}"
            style="width: 100%"
            href="{{ route('jadwal.biasa') }}">

                <i class="material-icons opacity-10 mx-2">schedule</i>
                Jadwal Pelajaran
            </a>
        </li>
    </ul>

    {{-- KALENDER AKADEMIK --}}
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
        <li>
            <a class="link-light rounded mb-1 {{
                Request::is('akademik/kalender*')
                ? 'bg-gradient-primary'
                : ''
            }}"
            style="width: 100%"
            href="/akademik/kalender/index">

                <i class="material-icons opacity-10 mx-2">calendar_month</i>
                Kalender Akademik
            </a>
        </li>
    </ul>

    {{-- KELAS TAMBAHAN --}}
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
        <li>
            <a class="link-light rounded mb-1 {{
                request()->routeIs('jadwal.premium') ||
                request()->routeIs('jadwal.kelas.premium')
                ? 'bg-gradient-primary'
                : ''
            }}"
            style="width: 100%"
            href="{{ route('jadwal.premium') }}">

                <i class="material-icons opacity-10 mx-2">workspace_premium</i>
                Kelas Tambahan
            </a>
        </li>
    </ul>

    {{-- PENGUMUMAN --}}
<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
    <li>
        <a class="link-light rounded mb-1 {{
            request()->routeIs('pengumuman.index') ||
            request()->routeIs('pengumuman.create') ||
            request()->routeIs('pengumuman.edit')
            ? 'bg-gradient-primary'
            : ''
        }}"
        style="width: 100%"
        href="{{ route('pengumuman.index') }}">

            <i class="material-icons opacity-10 mx-2">announcement</i>
            Pengumuman
        </a>
    </li>
</ul>

</div>
            </li>

            {{-- Presensi --}}

            <li class="mb-1" style="width: 100%">
    <button
        class="btn align-items-center rounded collapsed text-white font-weight-bold"
        style="text-transform: none; width: 100%; display: flex; align-items: center; column-gap:10px;"
        data-bs-toggle="collapse"
        data-bs-target="#kesiswaan-collapse"
        aria-expanded="false">

        <span class="material-symbols-outlined">
            groups
        </span>

        Kelola Murid
        <i class="material-icons opacity-10 ms-auto">expand_more</i>
    </button>

    <div class="collapse {{ Request::is('akademik/data-absensi*') || Request::is('data-nilai*') || Request::is('nilaisikap*') || Request::is('rapor*') ? 'show' : '' }}"
        id="kesiswaan-collapse">

        <ul class="btn-toggle-nav list-unstyled fw-normal small mt-2">

            <li class="mb-1">
                <a href="/akademik/data-absensi"
                    class="btn rounded text-white d-flex align-items-center gap-2 w-100
                    {{ Request::is('akademik/data-absensi*') ? 'bg-gradient-primary' : '' }}"
                    style="text-transform:none;">

                    <i class="material-icons opacity-10">fact_check</i>
                    Absensi Murid
                </a>
            </li>

            <li class="mb-1">
                <a href="{{ route('data.nilai.index') }}"
                    class="btn rounded text-white d-flex align-items-center gap-2 w-100
                    {{ Request::is('data-nilai*') ? 'bg-gradient-primary' : '' }}"
                    style="text-transform:none;">

                    <i class="material-icons opacity-10">assignment</i>
                    Nilai Tugas
                </a>
            </li>

            <li class="mb-1">
                <a href="{{ route('nilaisikap.index') }}"
                    class="btn rounded text-white d-flex align-items-center gap-2 w-100
                    {{ Request::is('nilaisikap*') ? 'bg-gradient-primary' : '' }}"
                    style="text-transform:none;">

                    <i class="material-icons opacity-10">psychology</i>
                    Nilai Sikap
                </a>
            </li>

            <li class="mb-1">
                <a href="{{ route('rapor.index') }}"
                    class="btn rounded text-white d-flex align-items-center gap-2 w-100
                    {{ Request::is('rapor*') ? 'bg-gradient-primary' : '' }}"
                    style="text-transform:none;">

                    <i class="material-icons opacity-10">menu_book</i>
                    Rapot Pembelajaran
                </a>
            </li>

        </ul>
    </div>
</li>

            <li class="mb-1">
                <button class="btn align-items-center rounded collapsed text-white font-weight-bold"
                    style="text-transform: none; width: 100%; display: flex; align-items: center; column-gap:10px"
                    data-bs-toggle="collapse"
                    data-bs-target="#pengajar-collapse"
                    aria-expanded="false">

                    <span class="material-symbols-outlined">
                        school
                    </span>

                    Kelola Pengajar
                    <i class="material-icons opacity-10 ms-auto">expand_more</i>
                </button>

    <div class="collapse {{
    request()->routeIs('absensi.guru*') || request()->routeIs('absensi.guru.rekap*')
    ? 'show'
    : ''
}}" id="pengajar-collapse">

    <ul class="btn-toggle-nav list-unstyled fw-normal small mt-2">
        {{-- ABSENSI PENGAJAR --}}
            <li class="mb-1">
                <a href="{{ route('absensi.guru') }}"
                   class="btn rounded text-white font-weight-bold d-flex align-items-center gap-2 w-100
                   {{ request()->routeIs('absensi.guru') ? 'bg-gradient-primary' : '' }}"
                   style="text-transform:none;">

                    <span class="material-symbols-outlined">
                        how_to_reg
                    </span>

                    Absensi Pengajar
                </a>
            </li>

        {{-- REKAP BULANAN --}}
        <li class="mb-1">
            <a href="{{ route('absensi.guru.rekap') }}"
               class="btn rounded text-white font-weight-bold d-flex align-items-center gap-2 w-100
               {{ request()->routeIs('absensi.guru.rekap*') ? 'bg-gradient-primary' : '' }}"
               style="text-transform:none;">

                <span class="material-symbols-outlined">
                    analytics
                </span>

                Rekap Bulanan
            </a>
        </li>

    </ul>
</div>


            <li class="mb-1" style="width: 100%">
                <button class="btn align-items-center rounded collapsed text-white font-weight-bold"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px"
                    data-bs-toggle="collapse" data-bs-target="#humas-collapse" aria-expanded="false">
                    <span class="material-symbols-outlined">
                        handshake
                    </span>
                    Humas <i class="material-icons opacity-10 ms-auto">expand_more</i>
                </button>
                <div class="collapse {{ Request::is('data-tamu*') || Request::is('mou*') ? 'show' : '' }}"
                    id="humas-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

                        {{-- <li><a class="link-light rounded mb-1" href="{{ route('kerjasama.lihat') }}"> <i --}}
                        <li>
    <a href="/mou"
        class="btn rounded text-white d-flex align-items-center gap-2 w-100
        {{ Request::is('mou*') ? 'bg-gradient-primary' : '' }}"
        style="text-transform:none;">

        <i class="material-icons opacity-10">
            diversity_3
        </i>

        Kerja Sama ( MoU )
    </a>
</li>
                    </ul>
                </div>
            </li>

            <li class="mb-1">
    <a href="{{ route('spk.index') }}"
        class="btn align-items-center rounded text-white font-weight-bold
        {{ request()->routeIs('spk.*') ? 'bg-gradient-primary' : '' }}"
        style="text-transform: none; width: 100%; display: flex; align-items: center; column-gap:10px">

        <span class="material-symbols-outlined">
            analytics
        </span>

        Hasil SPK
    </a>
</li>

            <li class="mb-1">
                <button class="btn align-items-center rounded collapsed text-white font-weight-bold"
        style="text-transform: none; width: 100%; display: flex; align-items: center; column-gap:10px"
        data-bs-toggle="collapse"
        data-bs-target="#galeri-collapse"
        aria-expanded="false">

        <span class="material-symbols-outlined">
            photo_library
        </span>

        Galeri

        <i class="material-icons opacity-10 ms-auto">expand_more</i>
    </button>

                <div class="collapse {{ Request::is('galeri/album*') || Request::is('galeri/konten*') ? 'show' : '' }}"
        id="galeri-collapse">

                    <!-- Menu Album -->
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li>
                            <a class="link-light rounded mb-1 {{ Request::is('galeri/album*') ? 'bg-gradient-primary' : '' }}"
                            href="/galeri/album">
                                <i class="material-icons opacity-10 mx-2">photo_album</i>
                                Album
                            </a>
                        </li>
                    </ul>

                    <!-- Menu Konten -->
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li>
                            <a class="link-light rounded mb-1 {{ Request::is('galeri/konten*') ? 'bg-gradient-primary' : '' }}"
                            href="/galeri/konten">
                                <i class="material-icons opacity-10 mx-2">image</i>
                                Konten
                            </a>
                        </li>
                    </ul>

                </div>
            </li>


            
        @elseif (auth()->user()->hasRole('guru'))
             {{-- NILAI TUGAS --}}
<li class="mb-1">
    <a href="{{ route('data.nilai.index') }}"
        class="btn rounded text-white font-weight-bold
        {{ request()->routeIs('data.nilai.*') ? 'bg-gradient-primary' : '' }}"
        style="text-transform: none; width: 100%; display: flex; align-items: center; column-gap:10px;">

        <span class="material-symbols-outlined">
            assignment
        </span>

        Nilai Tugas
    </a>
</li>


{{-- NILAI SIKAP --}}
<li class="mb-1">
    <a href="{{ route('nilaisikap.index') }}"
        class="btn rounded text-white font-weight-bold
        {{ request()->routeIs('nilaisikap.*') ? 'bg-gradient-primary' : '' }}"
        style="text-transform: none; width: 100%; display: flex; align-items: center; column-gap:10px;">

        <span class="material-symbols-outlined">
            psychology
        </span>

        Nilai Sikap
    </a>
</li>


{{-- JADWAL MENGAJAR --}}
<li class="mb-1">
    <a href="{{ route('guru.jadwal') }}"
        class="btn rounded text-white font-weight-bold
        {{ request()->routeIs('guru.jadwal') || request()->routeIs('guru.jadwal.hariini') ? 'bg-gradient-primary' : '' }}"
        style="text-transform: none; width: 100%; display: flex; align-items: center; column-gap:10px;">

        <span class="material-symbols-outlined">
            calendar_month
        </span>

        Jadwal Mengajar
    </a>
</li>


{{-- ABSENSI MURID --}}
<li class="mb-1">
    <a href="{{ url('/akademik/data-absensi') }}"
        class="btn rounded text-white font-weight-bold
        {{ request()->is('akademik/data-absensi*') ? 'bg-gradient-primary' : '' }}"
        style="text-transform: none; width: 100%; display: flex; align-items: center; column-gap:10px;">

        <span class="material-symbols-outlined">
            fact_check
        </span>

        Absensi Murid
    </a>
</li>


{{-- RAPOT --}}
<li class="mb-1">
    <a href="{{ route('rapor.index') }}"
        class="btn rounded text-white font-weight-bold
        {{ request()->routeIs('rapor.*') ? 'bg-gradient-primary' : '' }}"
        style="text-transform: none; width: 100%; display: flex; align-items: center; column-gap:10px;">

        <span class="material-symbols-outlined">
            school
        </span>

        Rapot Pembelajaran
    </a>
</li>
        @endif
    </ul>
</div>
<script>
    function konfirmasiBukaLink() {
        var konfirmasi = confirm("Apakah Anda yakin ingin membuka Elearning?");

        if (konfirmasi) {
            window.open("http://localhost/moodle/login/index.php", "_blank");
        }
    }
</script>
