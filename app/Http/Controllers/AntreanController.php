<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\PengaturanAntrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AntreanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DURASI LAYANAN
    |--------------------------------------------------------------------------
    |
    | Semua perguruan tinggi mendapatkan durasi layanan yang sama.
    | Durasi diambil dari Pengaturan Antrian.
    |
    */

    private function getDurasiLayanan()
    {
        $pengaturan = PengaturanAntrian::first();

        // Default jika pengaturan belum tersedia
        if (!$pengaturan) {
            return 15;
        }

        $durasi = (int) $pengaturan->durasi_layanan;

        // Pastikan tidak kosong / 0
        if ($durasi <= 0) {
            return 15;
        }

        return $durasi;
    }


    /*
    |--------------------------------------------------------------------------
    | FILTER TIKET
    |--------------------------------------------------------------------------
    |
    | Filter yang sama digunakan untuk:
    |
    | 1. Tiket MENUNGGU
    | 2. Tiket DILAYANI
    |
    | Sehingga ketika memilih:
    |
    | Meja 1 + Meja 2
    |
    | tiket menunggu dan tiket yang sedang dilayani
    | dari meja tersebut tetap muncul.
    |
    */

    private function applyFilters($query, Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTER MEJA MULTIPLE
        |--------------------------------------------------------------------------
        */

        $meja = $request->input('meja', []);

        /*
        |--------------------------------------------------------------------------
        | PASTIKAN SELALU ARRAY
        |--------------------------------------------------------------------------
        */

        if (!is_array($meja)) {
            $meja = [$meja];
        }

        /*
        |--------------------------------------------------------------------------
        | BERSIHKAN NILAI KOSONG
        |--------------------------------------------------------------------------
        */

        $meja = array_values(
            array_filter(
                $meja,
                function ($value) {
                    return $value !== null &&
                           $value !== '';
                }
            )
        );

        /*
        |--------------------------------------------------------------------------
        | FILTER BERDASARKAN MEJA
        |--------------------------------------------------------------------------
        */

        if (!empty($meja)) {

            $query->whereHas(
                'registrasi.master',
                function ($q) use ($meja) {

                    $q->whereIn(
                        'no_meja',
                        $meja
                    );

                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        |
        | Bisa mencari:
        |
        | - nomor tiket
        | - nama perguruan tinggi
        |
        */

        if ($request->filled('search')) {

            $search = trim(
                $request->input('search')
            );

            if ($search !== '') {

                $query->where(
                    function ($q) use ($search) {

                        /*
                        |--------------------------------------------------------------------------
                        | NOMOR TIKET
                        |--------------------------------------------------------------------------
                        */

                        $q->where(
                            'nomor_tiket',
                            'like',
                            '%' . $search . '%'
                        )

                        /*
                        |--------------------------------------------------------------------------
                        | NAMA PERGURUAN TINGGI
                        |--------------------------------------------------------------------------
                        */

                        ->orWhereHas(
                            'registrasi.master',
                            function ($q) use ($search) {

                                $q->where(
                                    'nama_pt',
                                    'like',
                                    '%' . $search . '%'
                                );

                            }
                        );

                    }
                );
            }
        }


        return $query;
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN ANTREAN PETUGAS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {

        /*
        |--------------------------------------------------------------------------
        | ANTREAN YANG SEDANG DILAYANI
        |--------------------------------------------------------------------------
        |
        | Semua petugas dapat melihat tiket yang sedang dilayani
        | oleh petugas/meja lain.
        |
        | Tetapi filter meja dan search tetap berlaku.
        |
        */

        $queryDilayani = Tiket::with([
            'registrasi.master'
        ])
            ->where(
                'status',
                'dilayani'
            );


        /*
        |--------------------------------------------------------------------------
        | TERAPKAN FILTER KE TIKET DILAYANI
        |--------------------------------------------------------------------------
        */

        $queryDilayani = $this->applyFilters(
            $queryDilayani,
            $request
        );


        /*
        |--------------------------------------------------------------------------
        | AMBIL TIKET DILAYANI
        |--------------------------------------------------------------------------
        */

        $antreanSaatIni = $queryDilayani
            ->orderBy(
                'id_tiket',
                'asc'
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | CEK TIMER TIKET DILAYANI
        |--------------------------------------------------------------------------
        |
        | Jika timer sudah mencapai waktu akhir,
        | status timer otomatis menjadi habis.
        |
        */

        foreach ($antreanSaatIni as $tiket) {

            if (
                $tiket->status_timer === 'berjalan' &&
                !empty($tiket->timer_berakhir) &&
                now()->greaterThanOrEqualTo(
                    $tiket->timer_berakhir
                )
            ) {

                $tiket->status_timer = 'habis';

                $tiket->timer_sisa = 0;

                $tiket->timer_berakhir = null;

                $tiket->save();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | ANTREAN MENUNGGU
        |--------------------------------------------------------------------------
        */

        $query = Tiket::with([
            'registrasi.master'
        ])
            ->where(
                'status',
                'menunggu'
            );


        /*
        |--------------------------------------------------------------------------
        | TERAPKAN FILTER KE ANTREAN MENUNGGU
        |--------------------------------------------------------------------------
        */

        $query = $this->applyFilters(
            $query,
            $request
        );


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        |
        | 8 tiket menunggu per halaman.
        |
        | Filter dan search tetap dibawa ke halaman berikutnya.
        |
        */

        $antrean = $query
            ->orderBy(
                'id_tiket',
                'asc'
            )
            ->paginate(8)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | DAFTAR MEJA
        |--------------------------------------------------------------------------
        |
        | Mengambil nomor meja dari tabel masters.
        |
        */

        $daftarMeja = \App\Models\Master::query()
            ->whereNotNull('no_meja')
            ->where(
                'no_meja',
                '!=',
                ''
            )
            ->select('no_meja')
            ->distinct()
            ->orderBy(
                'no_meja',
                'asc'
            )
            ->pluck('no_meja');


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.Petugas.antrean.index',
            compact(
                'antreanSaatIni',
                'antrean',
                'daftarMeja'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PANGGIL ANTREAN
    |--------------------------------------------------------------------------
    |
    | Menggunakan lockForUpdate agar dua petugas tidak dapat
    | memanggil tiket yang sama secara bersamaan.
    |
    */

    public function panggil($id)
    {

        $tiket = DB::transaction(
            function () use ($id) {

                /*
                |--------------------------------------------------------------------------
                | AMBIL TIKET + LOCK
                |--------------------------------------------------------------------------
                */

                $tiket = Tiket::with(
                    'registrasi'
                )
                    ->where(
                        'id_tiket',
                        $id
                    )
                    ->lockForUpdate()
                    ->firstOrFail();


                /*
                |--------------------------------------------------------------------------
                | PASTIKAN MASIH MENUNGGU
                |--------------------------------------------------------------------------
                */

                if (
                    $tiket->status !== 'menunggu'
                ) {
                    return null;
                }


                /*
                |--------------------------------------------------------------------------
                | WAKTU MULAI
                |--------------------------------------------------------------------------
                */

                $waktuMulai = now();


                /*
                |--------------------------------------------------------------------------
                | DURASI TIMER
                |--------------------------------------------------------------------------
                */

                $durasiLayanan =
                    $this->getDurasiLayanan();


                /*
                |--------------------------------------------------------------------------
                | WAKTU TIMER BERAKHIR
                |--------------------------------------------------------------------------
                */

                $timerBerakhir =
                    $waktuMulai
                        ->copy()
                        ->addMinutes(
                            $durasiLayanan
                        );


                /*
                |--------------------------------------------------------------------------
                | UPDATE TIKET
                |--------------------------------------------------------------------------
                */

                $tiket->status =
                    'dilayani';

                $tiket->aksi_terakhir =
                    'dipanggil';

                $tiket->waktu_aksi =
                    now();

                $tiket->waktu_mulai =
                    $waktuMulai;

                $tiket->durasi_timer =
                    $durasiLayanan;

                $tiket->timer_berakhir =
                    $timerBerakhir;

                $tiket->timer_sisa =
                    null;

                $tiket->jumlah_reset_timer =
                    0;

                $tiket->status_timer =
                    'berjalan';

                $tiket->save();


                /*
                |--------------------------------------------------------------------------
                | UPDATE REGISTRASI
                |--------------------------------------------------------------------------
                */

                if ($tiket->registrasi) {

                    $tiket->registrasi->status =
                        'diproses';

                    $tiket->registrasi->save();
                }


                return $tiket;
            }
        );


        /*
        |--------------------------------------------------------------------------
        | JIKA SUDAH DIPANGGIL PETUGAS LAIN
        |--------------------------------------------------------------------------
        */

        if (!$tiket) {

            return back()->with(
                'error',
                'Antrean ini sudah dipanggil oleh petugas lain.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | BERHASIL
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Antrean ' .
            $tiket->nomor_tiket .
            ' sedang dilayani. Timer ' .
            $tiket->durasi_timer .
            ' menit telah dimulai.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAUSE TIMER
    |--------------------------------------------------------------------------
    */

    public function pauseTimer($id)
    {

        $tiket =
            Tiket::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN DILAYANI
        |--------------------------------------------------------------------------
        */

        if (
            $tiket->status !== 'dilayani'
        ) {

            return back()->with(
                'error',
                'Timer hanya dapat di-pause ketika antrean sedang dilayani.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN TIMER BERJALAN
        |--------------------------------------------------------------------------
        */

        if (
            $tiket->status_timer !== 'berjalan'
        ) {

            return back()->with(
                'error',
                'Timer tidak sedang berjalan.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN TIMER BERAKHIR ADA
        |--------------------------------------------------------------------------
        */

        if (
            !$tiket->timer_berakhir
        ) {

            return back()->with(
                'error',
                'Waktu akhir timer tidak ditemukan.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | HITUNG SISA WAKTU
        |--------------------------------------------------------------------------
        */

        $sisa =
            now()->diffInSeconds(
                $tiket->timer_berakhir,
                false
            );

        $sisa =
            max(
                0,
                (int) $sisa
            );


        /*
        |--------------------------------------------------------------------------
        | JIKA HABIS
        |--------------------------------------------------------------------------
        */

        if (
            $sisa <= 0
        ) {

            $tiket->timer_sisa =
                0;

            $tiket->timer_berakhir =
                null;

            $tiket->status_timer =
                'habis';

            $tiket->save();


            return back()->with(
                'error',
                'Waktu layanan sudah habis.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN SISA WAKTU
        |--------------------------------------------------------------------------
        */

        $tiket->timer_sisa =
            $sisa;

        $tiket->timer_berakhir =
            null;

        $tiket->status_timer =
            'pause';

        $tiket->save();


        /*
        |--------------------------------------------------------------------------
        | PESAN
        |--------------------------------------------------------------------------
        */

        $menit =
            floor(
                $sisa / 60
            );

        $detik =
            $sisa % 60;


        return back()->with(
            'success',
            'Timer berhasil di-pause. Sisa waktu: ' .
            $menit .
            ' menit ' .
            $detik .
            ' detik.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RESUME TIMER
    |--------------------------------------------------------------------------
    */

    public function resumeTimer($id)
    {

        $tiket =
            Tiket::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN DILAYANI
        |--------------------------------------------------------------------------
        */

        if (
            $tiket->status !== 'dilayani'
        ) {

            return back()->with(
                'error',
                'Antrean tidak sedang dilayani.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PAUSE
        |--------------------------------------------------------------------------
        */

        if (
            $tiket->status_timer !== 'pause'
        ) {

            return back()->with(
                'error',
                'Timer tidak sedang di-pause.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL SISA WAKTU
        |--------------------------------------------------------------------------
        */

        $sisa =
            (int) (
                $tiket->timer_sisa ?? 0
            );


        /*
        |--------------------------------------------------------------------------
        | JIKA HABIS
        |--------------------------------------------------------------------------
        */

        if (
            $sisa <= 0
        ) {

            $tiket->timer_sisa =
                0;

            $tiket->timer_berakhir =
                null;

            $tiket->status_timer =
                'habis';

            $tiket->save();


            return back()->with(
                'error',
                'Waktu layanan sudah habis.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | LANJUTKAN TIMER
        |--------------------------------------------------------------------------
        */

        $tiket->timer_berakhir =
            now()->addSeconds(
                $sisa
            );

        $tiket->timer_sisa =
            null;

        $tiket->status_timer =
            'berjalan';

        $tiket->save();


        return back()->with(
            'success',
            'Timer dilanjutkan dari sisa waktu sebelumnya.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RESET TIMER
    |--------------------------------------------------------------------------
    */

    public function resetTimer($id)
    {

        $tiket =
            Tiket::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN DILAYANI
        |--------------------------------------------------------------------------
        */

        if (
            $tiket->status !== 'dilayani'
        ) {

            return back()->with(
                'error',
                'Timer hanya dapat di-reset ketika antrean sedang dilayani.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL DURASI AWAL
        |--------------------------------------------------------------------------
        */

        $durasiLayanan =
            $this->getDurasiLayanan();


        /*
        |--------------------------------------------------------------------------
        | RESET KE DURASI PENUH
        |--------------------------------------------------------------------------
        |
        | Contoh:
        |
        | Sisa 03:21
        |      ↓
        | Reset
        |      ↓
        | 15:00
        |
        */

        $tiket->durasi_timer =
            $durasiLayanan;

        $tiket->timer_berakhir =
            now()->addMinutes(
                $durasiLayanan
            );

        $tiket->timer_sisa =
            null;


        /*
        |--------------------------------------------------------------------------
        | JUMLAH RESET
        |--------------------------------------------------------------------------
        */

        $tiket->jumlah_reset_timer =
            ($tiket->jumlah_reset_timer ?? 0) + 1;


        /*
        |--------------------------------------------------------------------------
        | TIMER BERJALAN
        |--------------------------------------------------------------------------
        */

        $tiket->status_timer =
            'berjalan';

        $tiket->save();


        return back()->with(
            'success',
            'Timer berhasil di-reset menjadi ' .
            $durasiLayanan .
            ' menit.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TIMER HABIS
    |--------------------------------------------------------------------------
    */

    public function timerHabis($id)
    {

        $tiket =
            Tiket::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN DILAYANI
        |--------------------------------------------------------------------------
        */

        if (
            $tiket->status !== 'dilayani'
        ) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Antrean tidak sedang dilayani.'
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN TIMER BERJALAN
        |--------------------------------------------------------------------------
        */

        if (
            $tiket->status_timer !== 'berjalan'
        ) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Timer tidak sedang berjalan.'
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN WAKTU HABIS
        |--------------------------------------------------------------------------
        */

        if (
            !$tiket->timer_berakhir ||
            now()->lessThan(
                $tiket->timer_berakhir
            )
        ) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Timer belum habis.'
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | UBAH STATUS TIMER
        |--------------------------------------------------------------------------
        */

        $tiket->status_timer =
            'habis';

        $tiket->timer_sisa =
            0;

        $tiket->timer_berakhir =
            null;

        $tiket->save();


        return response()->json([
            'success' => true,
            'message' =>
                'Waktu layanan telah habis.'
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | LEWATI ANTREAN
    |--------------------------------------------------------------------------
    */

    public function lewati($id)
    {

        /*
        |--------------------------------------------------------------------------
        | AMBIL TIKET
        |--------------------------------------------------------------------------
        */

        $tiket =
            Tiket::with(
                'registrasi'
            )->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN DILAYANI
        |--------------------------------------------------------------------------
        */

        if (
            $tiket->status !== 'dilayani'
        ) {

            return back()->with(
                'error',
                'Antrean ini tidak sedang dilayani. Status saat ini: ' .
                ($tiket->status ?? 'kosong')
            );
        }


        /*
        |--------------------------------------------------------------------------
        | UBAH STATUS TIKET
        |--------------------------------------------------------------------------
        */

        $tiket->status =
            'dilewati';

        $tiket->aksi_terakhir =
            'dilewati';

        $tiket->waktu_aksi =
            now();

        $tiket->waktu_selesai =
            now();

        $tiket->status_timer =
            'selesai';

        $tiket->timer_berakhir =
            null;

        $tiket->timer_sisa =
            0;

        $tiket->save();


        /*
        |--------------------------------------------------------------------------
        | UPDATE REGISTRASI
        |--------------------------------------------------------------------------
        */

        if (
            $tiket->registrasi
        ) {

            $tiket->registrasi->status =
                'dilewati';

            $tiket->registrasi->save();
        }


        /*
        |--------------------------------------------------------------------------
        | VERIFIKASI
        |--------------------------------------------------------------------------
        */

        $tiket->refresh();


        if (
            $tiket->status !== 'dilewati'
        ) {

            return back()->with(
                'error',
                'Status tiket gagal disimpan ke database.'
            );
        }


        return back()->with(
            'success',
            'Antrean ' .
            $tiket->nomor_tiket .
            ' telah dilewati.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PANGGIL ULANG ANTREAN
    |--------------------------------------------------------------------------
    */

    public function panggilUlang($id)
    {

        $tiket =
            Tiket::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN DILAYANI
        |--------------------------------------------------------------------------
        */

        if (
            $tiket->status !== 'dilayani'
        ) {

            return back()->with(
                'error',
                'Antrean ini tidak sedang dilayani.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS TETAP DILAYANI
        |--------------------------------------------------------------------------
        |
        | Timer tidak di-reset.
        |
        | Jika pause → tetap pause.
        |
        | Jika berjalan → tetap berjalan.
        |
        */

        $tiket->status =
            'dilayani';

        $tiket->aksi_terakhir =
            'dipanggil_ulang';

        $tiket->waktu_aksi =
            now();

        $tiket->save();


        return back()->with(
            'success',
            'Antrean ' .
            $tiket->nomor_tiket .
            ' dipanggil ulang.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SELESAIKAN ANTREAN
    |--------------------------------------------------------------------------
    */

    public function selesai($id)
    {

        /*
        |--------------------------------------------------------------------------
        | AMBIL TIKET
        |--------------------------------------------------------------------------
        */

        $tiket =
            Tiket::with(
                'registrasi'
            )->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN DILAYANI
        |--------------------------------------------------------------------------
        */

        if (
            $tiket->status !== 'dilayani'
        ) {

            return back()->with(
                'error',
                'Antrean ini tidak sedang dilayani.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | UBAH STATUS TIKET
        |--------------------------------------------------------------------------
        */

        $tiket->status =
            'selesai';

        $tiket->aksi_terakhir =
            'selesai';

        $tiket->waktu_aksi =
            now();

        $tiket->waktu_selesai =
            now();

        $tiket->status_timer =
            'selesai';

        $tiket->timer_berakhir =
            null;

        $tiket->timer_sisa =
            0;

        $tiket->save();


        /*
        |--------------------------------------------------------------------------
        | UPDATE REGISTRASI
        |--------------------------------------------------------------------------
        */

        if (
            $tiket->registrasi
        ) {

            $tiket->registrasi->status =
                'selesai';

            $tiket->registrasi->save();
        }


        return back()->with(
            'success',
            'Antrean ' .
            $tiket->nomor_tiket .
            ' telah selesai dilayani.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CEK STATUS / AKSI TIKET
    |--------------------------------------------------------------------------
    |
    | Digunakan halaman registrasi untuk mengetahui
    | status tiket secara realtime.
    |
    */

    public function cekStatusTiket($id)
    {

        /*
        |--------------------------------------------------------------------------
        | AMBIL TIKET
        |--------------------------------------------------------------------------
        */

        $tiket =
            Tiket::with([
                'registrasi.master',
                'meja'
            ])->find($id);


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
        | STATUS
        |--------------------------------------------------------------------------
        */

        $status =
            $tiket->status;


        /*
        |--------------------------------------------------------------------------
        | AKSI TERAKHIR
        |--------------------------------------------------------------------------
        */

        $aksi =
            $tiket->aksi_terakhir;


        /*
        |--------------------------------------------------------------------------
        | PESAN
        |--------------------------------------------------------------------------
        */

        switch ($aksi) {

            case 'dipanggil':

                $pesan =
                    'Tiket ' .
                    $tiket->nomor_tiket .
                    ' sedang dipanggil oleh petugas. Silakan menuju meja pelayanan.';

                break;


            case 'dipanggil_ulang':

                $pesan =
                    'Tiket ' .
                    $tiket->nomor_tiket .
                    ' dipanggil ulang oleh petugas. Silakan menuju meja pelayanan.';

                break;


            case 'dilewati':

                $pesan =
                    'Tiket ' .
                    $tiket->nomor_tiket .
                    ' telah dilewati oleh petugas.';

                break;


            case 'selesai':

                $pesan =
                    'Layanan untuk tiket ' .
                    $tiket->nomor_tiket .
                    ' telah selesai. Terima kasih.';

                break;


            default:

                switch ($status) {

                    case 'menunggu':

                        $pesan =
                            'Tiket ' .
                            $tiket->nomor_tiket .
                            ' masih dalam antrean dan sedang menunggu dipanggil.';

                        break;


                    case 'dilayani':

                        $pesan =
                            'Tiket ' .
                            $tiket->nomor_tiket .
                            ' sedang dilayani oleh petugas.';

                        break;


                    case 'dilewati':

                        $pesan =
                            'Tiket ' .
                            $tiket->nomor_tiket .
                            ' telah dilewati oleh petugas.';

                        break;


                    case 'selesai':

                        $pesan =
                            'Layanan untuk tiket ' .
                            $tiket->nomor_tiket .
                            ' telah selesai.';

                        break;


                    default:

                        $pesan =
                            'Status tiket belum diketahui.';

                        break;
                }

                break;
        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSE JSON
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' =>
                true,

            'id_tiket' =>
                $tiket->id_tiket,

            'nomor_tiket' =>
                $tiket->nomor_tiket,

            'status' =>
                $status,

            'aksi_terakhir' =>
                $aksi,

            'pesan' =>
                $pesan,

            'updated_at' =>
                optional(
                    $tiket->updated_at
                )->format(
                    'Y-m-d H:i:s'
                ),

            'waktu_mulai' =>
                optional(
                    $tiket->waktu_mulai
                )->format(
                    'H:i:s'
                ),

            'waktu_aksi' =>
                optional(
                    $tiket->waktu_aksi
                )->format(
                    'Y-m-d H:i:s'
                ),

            'waktu_selesai' =>
                optional(
                    $tiket->waktu_selesai
                )->format(
                    'H:i:s'
                ),

            'nama_pt' =>
                optional(
                    optional(
                        $tiket->registrasi
                    )->master
                )->nama_pt,

            'nama_faswil' =>
                optional(
                    optional(
                        $tiket->registrasi
                    )->master
                )->nama_faswil,

            'kode_meja' =>
                optional(
                    $tiket->meja
                )->kode_meja,

        ]);
    }
}