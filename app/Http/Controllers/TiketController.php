<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * =========================================================
     * KELOLA TIKET
     * =========================================================
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | QUERY DATA TIKET
        |--------------------------------------------------------------------------
        |
        | Semua informasi PT, Faswil, Meja, Sesi, Jadwal dan Pendamping
        | sekarang berasal dari relasi registrasi -> master.
        |
        */

        $query = Tiket::with([
            'registrasi.master'
        ]);


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        | Bisa mencari berdasarkan:
        | - Nomor tiket
        | - Kode PT
        | - Nama Perguruan Tinggi
        | - Nama Faswil
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Nomor tiket
                $q->where(
                    'nomor_tiket',
                    'like',
                    '%' . $search . '%'
                )

                // Kode PT
                ->orWhereHas(
                    'registrasi.master',
                    function ($master) use ($search) {

                        $master->where(
                            'kode_pt',
                            'like',
                            '%' . $search . '%'
                        );
                    }
                )

                // Nama PT
                ->orWhereHas(
                    'registrasi.master',
                    function ($master) use ($search) {

                        $master->where(
                            'nama_pt',
                            'like',
                            '%' . $search . '%'
                        );
                    }
                )

                // Nama Faswil
                ->orWhereHas(
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

        if ($request->filled('status')) {

            $status = $request->status;

            if ($status !== 'semua') {

                $query->where(
                    'status',
                    $status
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER FASWIL
        |--------------------------------------------------------------------------
        |
        | Karena Faswil sekarang berada di tabel masters,
        | filter dilakukan melalui masters.nama_faswil.
        |
        */

        if ($request->filled('wilayah')) {

            $wilayah = $request->wilayah;

            $query->whereHas(
                'registrasi.master',
                function ($q) use ($wilayah) {

                    $q->where(
                        'nama_faswil',
                        $wilayah
                    );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DATA TIKET
        |--------------------------------------------------------------------------
        */

        $tikets = $query
            ->latest('waktu_daftar')
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | DATA FASWIL UNTUK FILTER
        |--------------------------------------------------------------------------
        |
        | Tidak lagi mengambil dari tabel faswils.
        | Ambil langsung dari masters.
        |
        */

        $faswils = Master::select('nama_faswil')
    ->whereNotNull('nama_faswil')
    ->where('nama_faswil', '!=', '')
    ->distinct()
    ->orderBy('nama_faswil')
    ->get();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.Tiket.index',
            compact(
                'tikets',
                'faswils'
            )
        );
    }


    /**
     * =========================================================
     * EXPORT DATA TIKET
     * =========================================================
     */
    public function export()
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA TIKET
        |--------------------------------------------------------------------------
        */

        $tikets = Tiket::with([
            'registrasi.master'
        ])
            ->latest('waktu_daftar')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | NAMA FILE
        |--------------------------------------------------------------------------
        */

        $filename =
            'data-tiket-' .
            date('Y-m-d') .
            '.csv';


        /*
        |--------------------------------------------------------------------------
        | HEADER RESPONSE
        |--------------------------------------------------------------------------
        */

        $headers = [

            'Content-Type' =>
                'text/csv',

            'Content-Disposition' =>
                'attachment; filename="' .
                $filename .
                '"',

        ];


        /*
        |--------------------------------------------------------------------------
        | KOLOM EXPORT
        |--------------------------------------------------------------------------
        */

        $columns = [

            'No',
            'Nomor Tiket',
            'Kode PT',
            'Perguruan Tinggi',
            'Faswil',
            'No. Meja',
            'Sesi',
            'Tanggal',
            'Jam Mulai',
            'Jam Akhir',
            'Pendamping',
            'Tanggal Daftar',
            'Waktu Daftar',
            'Mulai Diproses',
            'Selesai',
            'Status',

        ];


        /*
        |--------------------------------------------------------------------------
        | CALLBACK CSV
        |--------------------------------------------------------------------------
        */

        $callback = function () use (
            $tikets,
            $columns
        ) {

            $file = fopen(
                'php://output',
                'w'
            );


            /*
            |--------------------------------------------------------------------------
            | HEADER
            |--------------------------------------------------------------------------
            */

            fputcsv(
                $file,
                $columns
            );


            /*
            |--------------------------------------------------------------------------
            | DATA
            |--------------------------------------------------------------------------
            */

            foreach (
                $tikets as $index => $tiket
            ) {

                /*
                |--------------------------------------------------------------------------
                | MASTER
                |--------------------------------------------------------------------------
                */

                $master =
                    $tiket->registrasi?->master;


                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */

                $status = match (
                    $tiket->status
                ) {

                    'menunggu' =>
                        'Menunggu',

                    'dipanggil' =>
                        'Dipanggil',

                    'dilewat' =>
                        'Dilewat',

                    'selesai' =>
                        'Selesai',

                    default =>
                        ucfirst(
                            $tiket->status ??
                            'Menunggu'
                        ),

                };


                /*
                |--------------------------------------------------------------------------
                | FORMAT TANGGAL MASTER
                |--------------------------------------------------------------------------
                */

                $tanggalMaster = '-';

                if ($master?->tanggal) {

                    try {

                        $tanggalMaster =
                            \Carbon\Carbon::parse(
                                $master->tanggal
                            )->format('d-m-Y');

                    } catch (\Exception $e) {

                        $tanggalMaster =
                            $master->tanggal;
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | DATA CSV
                |--------------------------------------------------------------------------
                */

                fputcsv(
                    $file,
                    [

                        // No
                        $index + 1,

                        // Nomor tiket
                        $tiket->nomor_tiket
                            ?? '-',

                        // Kode PT
                        $master?->kode_pt
                            ?? '-',

                        // Nama PT
                        $master?->nama_pt
                            ?? '-',

                        // Faswil
                        $master?->nama_faswil
                            ?? '-',

                        // No meja
                        $master?->no_meja
                            ?? '-',

                        // Sesi
                        $master?->sesi
                            ?? '-',

                        // Tanggal jadwal
                        $tanggalMaster,

                        // Jam mulai
                        $master?->jam_mulai
                            ?? '-',

                        // Jam akhir
                        $master?->jam_akhir
                            ?? '-',

                        // Pendamping
                        $master?->pendamping
                            ?? '-',

                        // Tanggal daftar
                        $tiket->waktu_daftar
                            ? $tiket->waktu_daftar->format('d-m-Y')
                            : '-',

                        // Waktu daftar
                        $tiket->waktu_daftar
                            ? $tiket->waktu_daftar->format('H:i')
                            : '-',

                        // Mulai diproses
                        $tiket->waktu_mulai
                            ? $tiket->waktu_mulai->format('d-m-Y H:i')
                            : '-',

                        // Selesai
                        $tiket->waktu_selesai
                            ? $tiket->waktu_selesai->format('d-m-Y H:i')
                            : '-',

                        // Status
                        $status,

                    ]
                );
            }


            fclose($file);
        };


        /*
        |--------------------------------------------------------------------------
        | DOWNLOAD CSV
        |--------------------------------------------------------------------------
        */

        return response()->stream(
            $callback,
            200,
            $headers
        );
    }


    /**
     * =========================================================
     * CEK STATUS TIKET
     * =========================================================
     */
    public function cekStatus($nomor_tiket)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL TIKET + MASTER
        |--------------------------------------------------------------------------
        */

        $tiket = Tiket::with([
            'registrasi.master'
        ])
            ->where(
                'nomor_tiket',
                $nomor_tiket
            )
            ->first();


        /*
        |--------------------------------------------------------------------------
        | TIKET TIDAK DITEMUKAN
        |--------------------------------------------------------------------------
        */

        if (!$tiket) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Tiket tidak ditemukan.'

            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | MASTER
        |--------------------------------------------------------------------------
        */

        $master =
            $tiket->registrasi?->master;


        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' => true,

            'nomor_tiket' =>
                $tiket->nomor_tiket,

            'status' =>
                $tiket->status,

            'aksi_terakhir' =>
                $tiket->aksi_terakhir,

            'waktu_aksi' =>
                $tiket->waktu_aksi
                    ? $tiket->waktu_aksi->format('H:i:s')
                    : null,

            /*
            |--------------------------------------------------------------------------
            | DATA MASTER
            |--------------------------------------------------------------------------
            */

            'kode_pt' =>
                $master?->kode_pt,

            'nama_pt' =>
                $master?->nama_pt,

            'meja' =>
                $master?->no_meja,

            'nama_meja' =>
                $master?->no_meja
                    ? 'Meja ' . $master->no_meja
                    : null,

            'faswil' =>
                $master?->nama_faswil,

            'sesi' =>
                $master?->sesi,

            'tanggal' =>
                $master?->tanggal,

            'jam_mulai' =>
                $master?->jam_mulai,

            'jam_akhir' =>
                $master?->jam_akhir,

            'pendamping' =>
                $master?->pendamping,

        ]);
    }


    /**
     * =========================================================
     * DETAIL TIKET
     * =========================================================
     */
    public function show($id)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL TIKET + MASTER
        |--------------------------------------------------------------------------
        */

        $tiket = Tiket::with([
            'registrasi.master'
        ])
            ->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.Tiket.show',
            compact('tiket')
        );
    }


    /**
     * =========================================================
     * PANGGIL / MULAI TIKET
     * =========================================================
     */
    public function mulai($id)
    {
        $tiket =
            Tiket::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | UBAH STATUS MENJADI DIPANGGIL
        |--------------------------------------------------------------------------
        */

        $tiket->update([

            'status' =>
                'dipanggil',

            'waktu_mulai' =>
                $tiket->waktu_mulai
                ?? now(),

        ]);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->back()
            ->with(
                'success',
                'Tiket berhasil dipanggil.'
            );
    }


    /**
     * =========================================================
     * HAPUS TIKET
     * =========================================================
     */
    public function destroy($id)
    {
        $tiket =
            Tiket::findOrFail($id);


        $tiket->delete();


        return redirect()
            ->back()
            ->with(
                'success',
                'Tiket berhasil dihapus.'
            );
    }


    /**
     * =========================================================
     * LEWATI TIKET
     * =========================================================
     */
    public function lewati($id)
    {
        $tiket =
            Tiket::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | UBAH STATUS MENJADI DILEWAT
        |--------------------------------------------------------------------------
        */

        $tiket->update([

            'status' =>
                'dilewat',

        ]);


        return redirect()
            ->back()
            ->with(
                'success',
                'Tiket berhasil dilewati.'
            );
    }


    /**
     * =========================================================
     * SELESAIKAN TIKET
     * =========================================================
     */
    public function selesai($id)
    {
        $tiket =
            Tiket::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | UBAH STATUS MENJADI SELESAI
        |--------------------------------------------------------------------------
        */

        $tiket->update([

            'status' =>
                'selesai',

            'waktu_selesai' =>
                $tiket->waktu_selesai
                ?? now(),

        ]);


        return redirect()
            ->back()
            ->with(
                'success',
                'Tiket berhasil diselesaikan.'
            );
    }
}