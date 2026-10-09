{{-- =========================
DASHBOARD ADMIN / KEPSEK
========================= --}}

@php
    use App\Models\NilaiTugas;
    use App\Models\Absensi;
    use App\Models\Kelas;

    $rataNilai = round(NilaiTugas::avg('skor_tugas') ?? 0);

    $hadir = $hadir ?? Absensi::where('role', 'siswa')
        ->whereRaw('LOWER(status_absen) = ?', ['hadir'])
        ->count();

    $izin = $izin ?? Absensi::where('role', 'siswa')
        ->whereRaw('LOWER(status_absen) = ?', ['izin'])
        ->count();

    $sakit = $sakit ?? Absensi::where('role', 'siswa')
        ->whereRaw('LOWER(status_absen) = ?', ['sakit'])
        ->count();

    $tidakHadir = $tidakHadir ?? Absensi::where('role', 'siswa')
        ->whereIn(\DB::raw('LOWER(status_absen)'), ['alpha', 'alpa', 'tidak hadir'])
        ->count();

    $jumlahKelas = Kelas::count();
@endphp

@if (auth()->user()->hasRole('admin'))

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
            <h2 class="fw-bold mb-1 text-dark">
                Hallo Admin 👋
            </h2>
            <p class="text-muted mb-0">
                Selamat datang kembali di dashboard
            </p>
        </div>

        
    </div>

    {{-- CARD STATISTIK --}}
    <div class="row g-4 mb-4">

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-4 p-3 me-3" style="background:#dbeafe">
                        <i class="material-icons fs-1 text-primary">school</i>
                    </div>
                    <div>
                        <small class="text-muted">Total Siswa</small>
                        <h2 class="fw-bold mb-0">{{ $siswa->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-4 p-3 me-3" style="background:#dcfce7">
                        <i class="material-icons fs-1 text-success">groups</i>
                    </div>
                    <div>
                        <small class="text-muted">Total Pengajar</small>
                        <h2 class="fw-bold mb-0">{{ $guru->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- JUMLAH KELAS --}}
<div class="col-lg-3 col-md-6">
    <div class="card border-0 shadow rounded-4 h-100">
        <div class="card-body d-flex align-items-center">
            <div class="rounded-4 p-3 me-3" style="background:#fee2e2">
                <i class="material-icons fs-1 text-danger">meeting_room</i>
            </div>
            <div>
                <small class="text-muted">Jumlah Kelas</small>
                <h2 class="fw-bold mb-0">{{ $jumlahKelas }}</h2>
            </div>
        </div>
    </div>
</div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-4 p-3 me-3" style="background:#fef3c7">
                        <i class="material-icons fs-1 text-warning">assignment</i>
                    </div>
                    <div>
                        <small class="text-muted">Rata-rata Nilai</small>
                        <h2 class="fw-bold mb-0">{{ $rataNilai }}%</h2>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- CONTENT --}}
    {{-- CONTENT --}}
<div class="row g-4 mb-4">

    {{-- JADWAL WEEKEND --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow rounded-4 h-100">
            <div class="card-body p-4">

                <h5 class="fw-bold mb-4">
                    <i class="material-icons align-middle text-primary me-2">menu_book</i>
                    Jadwal Belajar Weekend
                </h5>

                <div class="row g-3">

                    <div class="col-6">
                        <div class="p-3 rounded-4 h-100"
                            style="background:#dbeafe;">

                            <div class="fw-bold text-primary mb-3">
                                Sabtu
                            </div>

                            <div class="small mb-3">
                                🕘 09:00 - 12:00
                            </div>

                            <div class="small mb-2 fw-semibold">
                                Kelas 1 & 2
                            </div>

                            <div class="small mb-2 fw-semibold">
                                Kelas 3 & 4
                            </div>

                            <div class="small fw-semibold">
                                Kelas 5 & 6
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="p-3 rounded-4 h-100"
                            style="background:#d1fae5;">

                            <div class="fw-bold text-success mb-3">
                                Minggu
                            </div>

                            <div class="small mb-3">
                                🕘 09:00 - 12:00
                            </div>

                            <div class="small mb-2 fw-semibold">
                                Kelas 1 & 2
                            </div>

                            <div class="small mb-2 fw-semibold">
                                Kelas 3 & 4
                            </div>

                            <div class="small fw-semibold">
                                Kelas 5 & 6
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-3 small text-muted">
                    📌 Sabtu dan Minggu siswa berbeda. Tim Pengajar menyesuaikan dengan yang hadir
                </div>

            </div>
        </div>
    </div>

    {{-- KELAS TAMBAHAN --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow rounded-4 h-100">
            <div class="card-body p-4">

                <h5 class="fw-bold mb-4">
                    <i class="material-icons align-middle text-primary me-2">import_contacts</i>
                    Kelas Tambahan Weekday
                </h5>

                <div class="p-3 rounded-4 mb-3"
                    style="background:#d1fae5;">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <small class="fw-bold text-success">
                                Senin • Rabu • Jumat
                            </small>

                            <div class="fw-bold mt-2">
                                Calistung
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <span class="badge bg-success">Pagi</span>
                            <span class="badge bg-success">Siang</span>
                            <span class="badge bg-success">Sore</span>
                        </div>

                    </div>
                </div>

                <div class="p-3 rounded-4 mb-3"
                    style="background:#f3d9fa;">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <small class="fw-bold text-purple">
                                Selasa • Kamis
                            </small>

                            <div class="fw-bold mt-2">
                                Bahasa Inggris
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <span class="badge bg-secondary">Pagi</span>
                            <span class="badge bg-secondary">Siang</span>
                            <span class="badge bg-secondary">Sore</span>
                        </div>

                    </div>
                </div>

                <div class="p-3 rounded-4"
                    style="background:#fde7d3;">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <small class="fw-bold text-warning">
                                Kamis • Jumat
                            </small>

                            <div class="fw-bold mt-2">
                                Matematika
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <span class="badge bg-warning text-dark">Pagi</span>
                            <span class="badge bg-warning text-dark">Siang</span>
                            <span class="badge bg-warning text-dark">Sore</span>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    
        {{-- CHART --}}
        <div class="col-lg-4">
            <div class="card shadow rounded-4 border-0 h-100">

                <div class="card-header bg-white border-0">
                    <h2 class="fw-bold mb-0">Statistik Kehadiran</h2>
                </div>

                <div class="card-body">
                    <div class="chart-wrapper">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>

                <div class="card-footer bg-white border-0 d-flex justify-content-center gap-4 flex-wrap pb-4">
                    <div class="text-center">
                        <span class="legend-box bg-success"></span>
                        <div class="mt-1">Hadir</div>
                    </div>

                    <div class="text-center">
                        <span class="legend-box bg-warning"></span>
                        <div class="mt-1">Izin</div>
                    </div>

                    <div class="text-center">
                        <span class="legend-box bg-primary"></span>
                        <div class="mt-1">Sakit</div>
                    </div>

                    <div class="text-center">
                        <span class="legend-box bg-danger"></span>
                        <div class="mt-1">Tidak Hadir</div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- SESI BELAJAR --}}
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow rounded-4">
            <div class="card-body p-4">

                <div class="mb-4">
                    <h5 class="fw-bold mb-1">
                        <i class="material-icons align-middle text-primary me-2">schedule</i>
                        Sesi Belajar
                    </h5>
                    <small class="text-muted">
                        Pilihan waktu belajar setiap kelas tambahan
                    </small>
                </div>

                <div class="row g-3">

                    {{-- PAGI --}}
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 h-100 shadow-sm"
                            style="background:#dbeafe;">

                            <div class="d-flex align-items-center mb-3">
                                <i class="material-icons text-primary me-2 fs-2">
                                    wb_sunny
                                </i>

                                <div>
                                    <h5 class="fw-bold text-primary mb-0">
                                        Pagi
                                    </h5>
                                </div>
                            </div>

                            <div class="fw-semibold text-muted">
                                07:30 - 10:00
                            </div>

                        </div>
                    </div>

                    {{-- SIANG --}}
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 h-100 shadow-sm"
                            style="background:#fef3c7;">

                            <div class="d-flex align-items-center mb-3">
                                <i class="material-icons text-warning me-2 fs-2">
                                    light_mode
                                </i>

                                <div>
                                    <h5 class="fw-bold text-warning mb-0">
                                        Siang
                                    </h5>
                                </div>
                            </div>

                            <div class="fw-semibold text-muted">
                                12:30 - 15:00
                            </div>

                        </div>
                    </div>

                    {{-- SORE --}}
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 h-100 shadow-sm"
                            style="background:#f3d9fa;">

                            <div class="d-flex align-items-center mb-3">
                                <i class="material-icons me-2 fs-2"
                                    style="color:#9333ea;">
                                    nights_stay
                                </i>

                                <div>
                                    <h5 class="fw-bold mb-0"
                                        style="color:#9333ea;">
                                        Sore
                                    </h5>
                                </div>
                            </div>

                            <div class="fw-semibold text-muted">
                                15:30 - 18:00
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
window.addEventListener('load', function () {
    const ctx = document.getElementById('attendanceChart');

    if (!ctx) return;

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Hadir', 'Izin', 'Sakit', 'Tidak Hadir'],
            datasets: [{
                data: [
                    {{ $hadir }},
                    {{ $izin }},
                    {{ $sakit }},
                    {{ $tidakHadir }}
                ],
                backgroundColor: [
                    '#22c55e',
                    '#eab308',
                    '#3b82f6',
                    '#ef4444'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>

<style>
.text-purple{
    color:#7c3aed;
}

.card{
    transition:.3s;
}

.card:hover{
    transform:translateY(-3px);
}

.chart-wrapper{
    position: relative;
    width: 100%;
    height: 320px;
}

.legend-box{
    display:inline-block;
    width:70px;
    height:20px;
    border-radius:8px;
}
</style>

@endif