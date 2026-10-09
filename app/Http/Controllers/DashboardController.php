<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Tiket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * =========================================================
     * DASHBOARD ADMIN
     * =========================================================
     */
    public function index(Request $request)
    {
        $today = Carbon::today();

        /*
        |--------------------------------------------------------------------------
        | STATISTIK UTAMA
        |--------------------------------------------------------------------------
        */

        // =====================================================
        // TOTAL PERGURUAN TINGGI
        // Diambil dari Master
        // =====================================================

        $totalPT = Master::query()
            ->whereNotNull('kode_pt')
            ->whereNotNull('nama_pt')
            ->distinct('kode_pt')
            ->count('kode_pt');


        // =====================================================
        // TOTAL FASWIL
        // Diambil dari Master
        // =====================================================

        $totalFaswil = Master::query()
            ->whereNotNull('nama_faswil')
            ->distinct('nama_faswil')
            ->count('nama_faswil');


        // =====================================================
        // FASWIL AKTIF
        //
        // Karena sekarang tidak ada kolom status_faswil,
        // faswil dianggap aktif apabila terdapat pada Master.
        // =====================================================

        $faswilAktif = Master::query()
            ->whereNotNull('nama_faswil')
            ->where('nama_faswil', '!=', '')
            ->distinct('nama_faswil')
            ->count('nama_faswil');


        // =====================================================
        // TOTAL TIKET HARI INI
        // =====================================================

        $tiketHariIni = Tiket::whereDate(
            'tanggal_antrian',
            $today
        )->count();


        // =====================================================
        // ANTREAN AKTIF HARI INI
        // =====================================================

        $antreanAktif = Tiket::whereDate(
                'tanggal_antrian',
                $today
            )
            ->whereIn('status', [
                'menunggu',
                'dipanggil',
                'dilayani'
            ])
            ->count();


        // =====================================================
        // PETUGAS AKTIF
        // =====================================================

        $petugasAktif = User::where(
                'role',
                'petugas'
            )
            ->where(
                'status',
                'aktif'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | STATUS TIKET HARI INI
        |--------------------------------------------------------------------------
        */

        $statusTiket = [

            'menunggu' => Tiket::whereDate(
                    'tanggal_antrian',
                    $today
                )
                ->where('status', 'menunggu')
                ->count(),

            'dipanggil' => Tiket::whereDate(
                    'tanggal_antrian',
                    $today
                )
                ->where('status', 'dipanggil')
                ->count(),

            'dilayani' => Tiket::whereDate(
                    'tanggal_antrian',
                    $today
                )
                ->where('status', 'dilayani')
                ->count(),

            'selesai' => Tiket::whereDate(
                    'tanggal_antrian',
                    $today
                )
                ->where('status', 'selesai')
                ->count(),

            'dilewati' => Tiket::whereDate(
                    'tanggal_antrian',
                    $today
                )
                ->where('status', 'dilewati')
                ->count(),

        ];


        /*
        |--------------------------------------------------------------------------
        | GRAFIK TIKET 7 HARI TERAKHIR
        |--------------------------------------------------------------------------
        */

        $tanggalGrafik = [];
        $jumlahGrafik = [];

        for ($i = 6; $i >= 0; $i--) {

            $tanggal = Carbon::today()->subDays($i);

            $tanggalGrafik[] = $tanggal->format('d M');

            $jumlahGrafik[] = Tiket::whereDate(
                'tanggal_antrian',
                $tanggal
            )->count();
        }


        /*
        |--------------------------------------------------------------------------
        | MONITOR ANTREAN BERDASARKAN MASTER / FASWIL
        |--------------------------------------------------------------------------
        |
        | Sekarang tidak menggunakan tabel faswils.
        |
        | Data faswil diambil dari:
        | masters.nama_faswil
        |
        | Tiket dihubungkan melalui:
        | registrasis.id_master
        |
        */

        $monitorFaswil = DB::table('masters')

            ->leftJoin(
                'registrasis',
                'masters.id_master',
                '=',
                'registrasis.id_master'
            )

            ->leftJoin(
                'tikets',
                'registrasis.id_registrasi',
                '=',
                'tikets.id_registrasi'
            )

            ->whereNotNull('masters.nama_faswil')

            ->where(
                'masters.nama_faswil',
                '!=',
                ''
            )

            ->select(
                'masters.nama_faswil',

                DB::raw("
                    SUM(
                        CASE
                            WHEN DATE(tikets.tanggal_antrian) = '{$today->format('Y-m-d')}'
                            AND tikets.status = 'menunggu'
                            THEN 1
                            ELSE 0
                        END
                    ) AS jumlah_menunggu
                "),

                DB::raw("
                    SUM(
                        CASE
                            WHEN DATE(tikets.tanggal_antrian) = '{$today->format('Y-m-d')}'
                            AND tikets.status = 'dipanggil'
                            THEN 1
                            ELSE 0
                        END
                    ) AS jumlah_dipanggil
                "),

                DB::raw("
                    SUM(
                        CASE
                            WHEN DATE(tikets.tanggal_antrian) = '{$today->format('Y-m-d')}'
                            AND tikets.status = 'dilayani'
                            THEN 1
                            ELSE 0
                        END
                    ) AS jumlah_dilayani
                "),

                DB::raw("
                    SUM(
                        CASE
                            WHEN DATE(tikets.tanggal_antrian) = '{$today->format('Y-m-d')}'
                            AND tikets.status = 'selesai'
                            THEN 1
                            ELSE 0
                        END
                    ) AS jumlah_selesai
                ")
            )

            ->groupBy(
                'masters.nama_faswil'
            )

            ->orderByDesc(
                'jumlah_menunggu'
            )

            ->orderBy(
                'masters.nama_faswil',
                'asc'
            )

            ->take(5)

            ->get();


        /*
        |--------------------------------------------------------------------------
        | DATA MEJA
        |--------------------------------------------------------------------------
        |
        | Tidak lagi menggunakan Model Meja.
        |
        | Data meja diambil dari Master:
        | masters.no_meja
        | masters.nama_faswil
        | masters.pendamping
        |
        */

        $mejas = Master::query()

            ->whereNotNull('no_meja')

            ->where(
                'no_meja',
                '!=',
                ''
            )

            ->orderBy(
                'no_meja',
                'asc'
            )

            ->get();


        /*
        |--------------------------------------------------------------------------
        | HILANGKAN DUPLIKAT MEJA
        |--------------------------------------------------------------------------
        |
        | Karena satu meja bisa digunakan oleh beberapa PT,
        | kita hanya tampilkan satu data untuk setiap nomor meja.
        |
        */

        $mejas = $mejas
            ->unique('no_meja')
            ->take(4)
            ->values();


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS TERBARU
        |--------------------------------------------------------------------------
        |
        | Menggunakan relasi:
        |
        | Tiket
        |   -> Registrasi
        |       -> Master
        |
        */

        $aktivitasTerbaru = Tiket::with([
                'registrasi.master'
            ])
            ->whereDate(
                'tanggal_antrian',
                $today
            )
            ->latest('updated_at')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STATUS MEJA
        |--------------------------------------------------------------------------
        |
        | Tidak lagi menggunakan Model Meja.
        |
        | Semua data diambil dari Master.
        |
        */

        $statusMeja = Master::query()

            ->whereNotNull('no_meja')

            ->where(
                'no_meja',
                '!=',
                ''
            )

            ->orderBy(
                'no_meja',
                'asc'
            )

            ->get()

            ->unique('no_meja')

            ->values();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.Dashboard.Dashboardadmin',
            compact(
                'totalPT',
                'totalFaswil',
                'faswilAktif',
                'tiketHariIni',
                'antreanAktif',
                'petugasAktif',
                'statusTiket',
                'tanggalGrafik',
                'jumlahGrafik',
                'monitorFaswil',
                'mejas',
                'aktivitasTerbaru',
                'statusMeja'
            )
        );
    }
}