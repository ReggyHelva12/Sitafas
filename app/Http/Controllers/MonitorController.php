<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class MonitorController extends Controller
{

    /**
 * =========================================================
 * DETAIL TIKET MONITOR
 * =========================================================
 */
public function show($id)
{
    /*
    |--------------------------------------------------------------------------
    | AMBIL TIKET
    |--------------------------------------------------------------------------
    | Tiket berhubungan dengan:
    |
    | Tiket
    |   -> Registrasi
    |       -> Master
    |
    */

    $tiket = Tiket::with([
        'registrasi.master'
    ])->findOrFail($id);


    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN HALAMAN DETAIL
    |--------------------------------------------------------------------------
    */

    return view(
        'pages.Monitor.show',
        compact('tiket')
    );
}
    /**
     * =========================================================
     * MONITOR ANTREAN
     * =========================================================
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        |
        | Tanggal Monitor menggunakan:
        | tikets.tanggal_antrian
        |
        */

        $tanggal = $request->input(
            'tanggal',
            now()->format('Y-m-d')
        );

        /*
        |--------------------------------------------------------------------------
        | QUERY DATA TIKET
        |--------------------------------------------------------------------------
        |
        | Relasi:
        |
        | Tiket
        |   -> Registrasi
        |       -> Master
        |
        */

        $query = Tiket::with([
            'registrasi.master'
        ]);

        /*
        |--------------------------------------------------------------------------
        | FILTER BERDASARKAN TANGGAL ANTRIAN TIKET
        |--------------------------------------------------------------------------
        */

        if (!empty($tanggal)) {

            $query->whereDate(
                'tanggal_antrian',
                $tanggal
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        |
        | Bisa mencari:
        | - Nomor tiket
        | - Nama perguruan tinggi
        | - Nama Faswil
        |
        */

        if ($request->filled('search')) {

            $search = trim(
                $request->input('search')
            );

            $query->where(function ($q) use ($search) {

                /*
                |--------------------------------------------------------------------------
                | NOMOR TIKET
                |--------------------------------------------------------------------------
                */

                $q->where(
                    'nomor_tiket',
                    'like',
                    '%' . $search . '%'
                );

                /*
                |--------------------------------------------------------------------------
                | NAMA PERGURUAN TINGGI
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas(
                    'registrasi.master',
                    function ($master) use ($search) {

                        $master->where(
                            'nama_pt',
                            'like',
                            '%' . $search . '%'
                        );
                    }
                );

                /*
                |--------------------------------------------------------------------------
                | FASWIL
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas(
                    'registrasi.master',
                    function ($master) use ($search) {

                        $master->where(
                            'nama_faswil',
                            'like',
                            '%' . $search . '%'
                        );
                    }
                );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('status') &&
            $request->input('status') !== 'semua'
        ) {

            $query->where(
                'status',
                $request->input('status')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | DATA TIKET
        |--------------------------------------------------------------------------
        */

        $tikets = $query
            ->orderBy(
                'waktu_daftar',
                'asc'
            )
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        |
        | SEMUANYA berdasarkan:
        | tikets.tanggal_antrian
        |
        */

        $statistik = Tiket::query()
            ->whereDate(
                'tanggal_antrian',
                $tanggal
            );

        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        $totalTiket = (clone $statistik)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | MENUNGGU
        |--------------------------------------------------------------------------
        */

        $menunggu = (clone $statistik)
            ->where(
                'status',
                'menunggu'
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | DIPANGGIL
        |--------------------------------------------------------------------------
        */

        $dipanggil = (clone $statistik)
            ->where(
                'status',
                'dipanggil'
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | DILAYANI
        |--------------------------------------------------------------------------
        */

        $dilayani = (clone $statistik)
            ->where(
                'status',
                'dilayani'
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | DILEWATI
        |--------------------------------------------------------------------------
        */

        $dilewati = (clone $statistik)
            ->where(
                'status',
                'dilewati'
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */

        $selesai = (clone $statistik)
            ->where(
                'status',
                'selesai'
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.Monitor.index',
            compact(
                'tikets',
                'tanggal',
                'totalTiket',
                'menunggu',
                'dipanggil',
                'dilayani',
                'dilewati',
                'selesai'
            )
        );
    }
}