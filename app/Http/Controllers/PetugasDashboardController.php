<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetugasDashboardController extends Controller
{
    /**
     * =========================================================
     * DASHBOARD PETUGAS
     * =========================================================
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | 1. ANTREAN YANG SEDANG DILAYANI
        |--------------------------------------------------------------------------
        |
        | Mengambil tiket yang sedang dipanggil/dilayani.
        |
        */

        $antreanSekarang = DB::table('tikets')
            ->join(
                'registrasis',
                'registrasis.id_registrasi',
                '=',
                'tikets.id_registrasi'
            )
            ->leftJoin(
                'masters',
                'masters.id_master',
                '=',
                'registrasis.id_master'
            )
            ->whereIn('tikets.status', [
                'dipanggil',
                'dilayani',
                'sedang_dilayani'
            ])
            ->orderByDesc('tikets.waktu_mulai')
            ->select(
                'tikets.id_tiket',
                'tikets.id_registrasi',
                'tikets.nomor_tiket',
                'tikets.status',
                'tikets.waktu_daftar',
                'tikets.waktu_mulai',
                'tikets.waktu_selesai',

                // Data registrasi yang memang digunakan
                'registrasis.id_master',
                'registrasis.tgl_registrasi',
                'registrasis.kebutuhan',

                // Data master
                'masters.nama_pt',
                'masters.kode_pt',
                'masters.nama_faswil',
                'masters.no_meja',
                'masters.sesi',
                'masters.jam_mulai',
                'masters.jam_selesai',
                'masters.pendamping'
            )
            ->first();


        /*
        |--------------------------------------------------------------------------
        | 2. JUMLAH ANTREAN MENUNGGU
        |--------------------------------------------------------------------------
        |
        | Semua tiket dengan status menunggu.
        | Tidak menggunakan filter tanggal.
        |
        */

        $jumlahMenunggu = DB::table('tikets')
            ->where('status', 'menunggu')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 3. JUMLAH ANTREAN SELESAI
        |--------------------------------------------------------------------------
        */

        $jumlahDilayani = DB::table('tikets')
            ->where('status', 'selesai')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 4. JUMLAH ANTREAN DILEWATI
        |--------------------------------------------------------------------------
        */

        $jumlahDilewati = DB::table('tikets')
            ->whereIn('status', [
                'dilewati',
                'dilewatkan'
            ])
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 5. ANTREAN BERIKUTNYA
        |--------------------------------------------------------------------------
        |
        | Mengambil tiket yang masih menunggu.
        |
        | Urutan:
        | 1. waktu_daftar paling awal
        | 2. id_tiket paling kecil
        |
        */

        $antreanBerikutnya = DB::table('tikets')
            ->join(
                'registrasis',
                'registrasis.id_registrasi',
                '=',
                'tikets.id_registrasi'
            )
            ->leftJoin(
                'masters',
                'masters.id_master',
                '=',
                'registrasis.id_master'
            )
            ->where('tikets.status', 'menunggu')
            ->orderBy('tikets.waktu_daftar', 'asc')
            ->orderBy('tikets.id_tiket', 'asc')
            ->select(
                'tikets.id_tiket',
                'tikets.id_registrasi',
                'tikets.nomor_tiket',
                'tikets.status',
                'tikets.waktu_daftar',
                'tikets.waktu_mulai',
                'tikets.waktu_selesai',

                // Data registrasi
                'registrasis.id_master',
                'registrasis.tgl_registrasi',
                'registrasis.kebutuhan',

                // Data master
                'masters.nama_pt',
                'masters.kode_pt',
                'masters.nama_faswil',
                'masters.no_meja',
                'masters.sesi',
                'masters.jam_mulai',
                'masters.jam_selesai',
                'masters.pendamping'
            )
            ->limit(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | 6. TOTAL TIKET
        |--------------------------------------------------------------------------
        */

        $totalTiket = DB::table('tikets')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 7. TOTAL REGISTRASI
        |--------------------------------------------------------------------------
        */

        $totalRegistrasi = DB::table('registrasis')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 8. TOTAL ANTREAN AKTIF
        |--------------------------------------------------------------------------
        |
        | Antrean aktif:
        | - menunggu
        | - dipanggil
        | - dilayani
        | - sedang_dilayani
        |
        */

        $totalAntreanAktif = DB::table('tikets')
            ->whereIn('status', [
                'menunggu',
                'dipanggil',
                'dilayani',
                'sedang_dilayani'
            ])
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 9. KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.petugas.dashboard',
            compact(
                'antreanSekarang',
                'jumlahMenunggu',
                'jumlahDilayani',
                'jumlahDilewati',
                'antreanBerikutnya',
                'totalTiket',
                'totalRegistrasi',
                'totalAntreanAktif'
            )
        );
    }
}