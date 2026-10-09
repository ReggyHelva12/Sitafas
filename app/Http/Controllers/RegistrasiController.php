<?php



namespace App\Http\Controllers;


use App\Exports\RegistrasiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Master;

use App\Models\Registrasi;

use App\Models\Tiket;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;



class RegistrasiController extends Controller

{
public function create()
{
    // Ambil semua data master sesuai jadwal.
    $masters = Master::orderBy('tanggal')
        ->orderBy('jam_mulai')
        ->orderBy('nama_pt')
        ->get();

    // Ambil nama PT yang sudah memiliki registrasi.
    $namaPtTerdaftar = Registrasi::with('master')
        ->get()
        ->pluck('master.nama_pt')
        ->filter()
        ->map(function ($nama) {
            return mb_strtolower(trim($nama));
        })
        ->unique()
        ->values()
        ->all();

    // Ambil tiket aktif untuk popup yang sudah berjalan.
    $idTiketAktif = session('sitafas_id_tiket_aktif');

    $tiket = null;

    if ($idTiketAktif) {
        $tiket = Tiket::with([
            'registrasi.master'
        ])->find($idTiketAktif);
    }

    return view(
        'pages.Registrasi.registrasi',
        compact(
            'masters',
            'idTiketAktif',
            'tiket',
            'namaPtTerdaftar'
        )
    );
}


    /*

    |--------------------------------------------------------------------------

    | SIMPAN REGISTRASI + GENERATE TIKET

    |--------------------------------------------------------------------------

    */



    public function store(Request $request)

    {

        /*

        |--------------------------------------------------------------------------

        | VALIDASI

        |--------------------------------------------------------------------------

        */



        $request->validate([

            'id_master' => [

                'required',

                'exists:masters,id_master'

            ],



            'kebutuhan' => [

                'nullable',

                'string',

                'max:1000'

            ],

        ], [



            'id_master.required' =>

                'Perguruan tinggi wajib dipilih.',



            'id_master.exists' =>

                'Data master tidak ditemukan.',



            'kebutuhan.max' =>

                'Kebutuhan maksimal 1000 karakter.',

        ]);





        /*

        |--------------------------------------------------------------------------

        | AMBIL MASTER

        |--------------------------------------------------------------------------

        */

        $master = Master::findOrFail(
            $request->id_master
        );

    /*
|--------------------------------------------------------------------------
| CEK DUPLIKAT REGISTRASI PERGURUAN TINGGI
|--------------------------------------------------------------------------
|
| Satu Perguruan Tinggi hanya boleh melakukan registrasi satu kali.
|
| Jika nama PT yang sama sudah pernah melakukan registrasi,
| registrasi baru akan ditolak.
|
*/

$registrasiSudahAda = Registrasi::whereHas(
    'master',
    function ($query) use ($master) {

        $query->where(
            'nama_pt',
            $master->nama_pt
        );

    }
)->exists();


if ($registrasiSudahAda) {

    return redirect ()
        ->back()
        ->withInput()
        ->with(
            'error',
            'Perguruan Tinggi "' .
            $master->nama_pt .
            '" sudah terdaftar. Silakan gunakan tiket yang sudah diberikan untuk melakukan pelacakan.'
        );

}



        /*

        |--------------------------------------------------------------------------

        | CEK STATUS MASTER

        |--------------------------------------------------------------------------

        */



        if (

            isset($master->status) &&

            $master->status !== 'aktif'

        ) {



            return back()

                ->withInput()

                ->with(

                    'error',

                    'Jadwal Perguruan Tinggi tersebut sudah tidak aktif.'

                );

        }





        /*

        |--------------------------------------------------------------------------

        | CEK TANGGAL MASTER

        |--------------------------------------------------------------------------

        |

        | Jika master mempunyai tanggal jadwal,

        | gunakan tanggal tersebut sebagai tanggal registrasi.

        |

        */



        $tanggalRegistrasi = null;



        if (!empty($master->tanggal)) {



            try {



                $tanggalRegistrasi =

                    Carbon::parse(

                        $master->tanggal

                    )->startOfDay();



            } catch (\Exception $e) {



                $tanggalRegistrasi = now()->startOfDay();

            }



        } else {



            $tanggalRegistrasi =

                now()->startOfDay();

        }





        /*

        |--------------------------------------------------------------------------

        | SIMPAN REGISTRASI

        |--------------------------------------------------------------------------

        */



        DB::beginTransaction();



        try {



            $registrasi = Registrasi::create([



                'id_master' =>

                    $master->id_master,



                'tgl_registrasi' => now(),



                'kebutuhan' =>

                    $request->kebutuhan,



                'status' =>

                    'terdaftar',

            ]);





            /*

            |--------------------------------------------------------------------------

            | GENERATE NOMOR TIKET

            |--------------------------------------------------------------------------

            */



            $nomorTiket = $this->generateNomorTiket(
                $master->nama_faswil,
                $tanggalRegistrasi
            );





            /*

            |--------------------------------------------------------------------------

            | SIMPAN TIKET

            |--------------------------------------------------------------------------

            |

            | Tiket mengambil jadwal dari master melalui registrasi.

            |

            */



            $tiket = Tiket::create([



                'id_registrasi' =>

                    $registrasi->id_registrasi,



                'tanggal_antrian' =>

                    $tanggalRegistrasi,



                'nomor_tiket' =>

                    $nomorTiket,



                'status' =>

                    'menunggu',



                'waktu_daftar' =>

                    now(),



                'waktu_mulai' =>

                    null,



                'waktu_selesai' =>

                    null,



                'aksi_terakhir' =>

                    'registrasi',



                'waktu_aksi' =>

                    now(),



                /*

                |--------------------------------------------------------------------------

                | TIMER

                |--------------------------------------------------------------------------

                |

                | Timer belum berjalan.

                | Timer baru dimulai ketika petugas memanggil antrean.

                |

                */



                'durasi_timer' =>

                    null,



                'timer_berakhir' =>

                    null,



                'jumlah_reset_timer' =>

                    0,



                'status_timer' =>

                    'belum_mulai',



                'timer_sisa' =>

                    null,

            ]);

            /*

            |--------------------------------------------------------------------------

            | COMMIT

            |--------------------------------------------------------------------------

            */

            DB::commit();

            session([
    'sitafas_id_tiket_aktif' =>
        $tiket->id_tiket,

    'sitafas_nomor_tiket_aktif' =>
        $tiket->nomor_tiket,

    'sitafas_nama_pt_aktif' =>
        $master->nama_pt,
]);


// Session penanda bahwa PT sudah berhasil mendaftar.
session([
    'sitafas_pt_terdaftar' => [
        'id_master' => $master->id_master,
        'nama_pt' => $master->nama_pt,
        'nomor_tiket' => $tiket->nomor_tiket,
    ]
    ]);



            return redirect()
    ->route('registrasi.create')
    ->with(
        'success',
        'Registrasi berhasil dan nomor tiket berhasil dibuat.'
    )
    ->with(
        'tiket_baru',
        $tiket->id_tiket
    );


        } catch (\Exception $e) {



            DB::rollBack();



            return back()

                ->withInput()

                ->with(

                    'error',

                    'Registrasi gagal disimpan: ' .

                    $e->getMessage()

                );

        }

    }





    /*

    |--------------------------------------------------------------------------

    | GENERATE NOMOR TIKET

    |--------------------------------------------------------------------------

    |

    | Contoh:

    |

    | A-001

    | A-002

    | A-003

    |

    | Prefix dan panjang nomor mengikuti pengaturan antrean.

    |

    */



/*

\|--------------------------------------------------------------------------

\| GENERATE NOMOR TIKET BERDASARKAN FASWIL

\|--------------------------------------------------------------------------

|

\| Contoh:

|

\| Muhani      → MUH-001, MUH-002, MUH-003

\| Magdalena   → MAG-001, MAG-002, MAG-003

\| Desiana     → DES-001, DES-002, DES-003

|

\| Setiap Faswil mempunyai urutan antrean sendiri.

|

*/



/*
|--------------------------------------------------------------------------
| GENERATE NOMOR TIKET BERDASARKAN FASWIL
|--------------------------------------------------------------------------
|
| Setiap Faswil memiliki nomor antrean sendiri.
|
| Contoh:
|
| VNG → VNG-001
| VNG → VNG-002
| VNG → VNG-003
|
| SUS → SUS-001
| SUS → SUS-002
|
| LUT → LUT-001
|
|--------------------------------------------------------------------------
*/

private function generateNomorTiket(
    $namaFaswil,
    $tanggalLayanan
) {

    /*
    |--------------------------------------------------------------------------
    | AMBIL PENGATURAN ANTREAN
    |--------------------------------------------------------------------------
    */

    $pengaturan =
        \App\Models\PengaturanAntrian::first();


    /*
    |--------------------------------------------------------------------------
    | PANJANG NOMOR
    |--------------------------------------------------------------------------
    */

    $panjangNomor = 3;


    if (
        $pengaturan &&
        !empty($pengaturan->panjang_nomor)
    ) {

        $panjangNomor =
            (int) $pengaturan->panjang_nomor;

    }


    /*
    |--------------------------------------------------------------------------
    | PASTIKAN MINIMAL 1
    |--------------------------------------------------------------------------
    */

    if ($panjangNomor < 1) {

        $panjangNomor = 3;

    }


    /*
    |--------------------------------------------------------------------------
    | NAMA FASWIL
    |--------------------------------------------------------------------------
    */

    $namaFaswil = trim(
        strtoupper(
            (string) $namaFaswil
        )
    );


    /*
    |--------------------------------------------------------------------------
    | GENERATE PREFIX FASWIL
    |--------------------------------------------------------------------------
    */

    $prefix =
        $this->generatePrefixFaswil(
            $namaFaswil
        );


    /*
    |--------------------------------------------------------------------------
    | TANGGAL LAYANAN
    |--------------------------------------------------------------------------
    */

    $tanggalLayanan =
        \Carbon\Carbon::parse(
            $tanggalLayanan
        )->format('Y-m-d');


    /*
    |--------------------------------------------------------------------------
    | QUERY TIKET
    |--------------------------------------------------------------------------
    */

    $query = \App\Models\Tiket::query();


    /*
    |--------------------------------------------------------------------------
    | RESET HARIAN
    |--------------------------------------------------------------------------
    |
    | Jika aktif:
    |
    | 06-10-2026
    | VNG-001
    | VNG-002
    |
    | 07-10-2026
    | VNG-001
    |
    */

    if (
        $pengaturan &&
        (int) $pengaturan->reset_harian === 1
    ) {

        $query->whereDate(
            'tanggal_antrian',
            $tanggalLayanan
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CARI TIKET TERAKHIR FASWIL
    |--------------------------------------------------------------------------
    |
    | Hanya tiket dengan prefix Faswil
    | yang sedang diproses.
    |
    */

    $tiketTerakhir = $query

        ->where(
            'nomor_tiket',
            'like',
            $prefix . '-%'
        )

        ->orderByDesc(
            'id_tiket'
        )

        ->first();


    /*
    |--------------------------------------------------------------------------
    | NOMOR AWAL
    |--------------------------------------------------------------------------
    */

    $nomor = 1;


    /*
    |--------------------------------------------------------------------------
    | JIKA SUDAH ADA TIKET
    |--------------------------------------------------------------------------
    */

    if ($tiketTerakhir) {

        /*
        | Ambil hanya angka.
        |
        | VNG-043
        | ↓
        | 043
        */

        $nomorLama =
            preg_replace(
                '/[^0-9]/',
                '',
                $tiketTerakhir->nomor_tiket
            );


        if (
            $nomorLama !== '' &&
            is_numeric($nomorLama)
        ) {

            $nomor =
                ((int) $nomorLama) + 1;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | FORMAT NOMOR
    |--------------------------------------------------------------------------
    |
    | panjang = 3
    | 1 → 001
    |
    | panjang = 4
    | 1 → 0001
    |
    */

    $nomorFormat =
        str_pad(
            $nomor,
            $panjangNomor,
            '0',
            STR_PAD_LEFT
        );


    /*
    |--------------------------------------------------------------------------
    | HASIL
    |--------------------------------------------------------------------------
    */

    return $prefix .
        '-' .
        $nomorFormat;
}

/*
|--------------------------------------------------------------------------
| GENERATE PREFIX FASWIL
|--------------------------------------------------------------------------
|
| Muhani      -> MUH
| Magdalena   -> MAG
| Desiana     -> DES
|
| Faswil lain mendapatkan prefix otomatis 3 karakter.
|
*/

private function generatePrefixFaswil($namaFaswil)
{
    $prefixKhusus = [
        'MUHANI' => 'MUH',
        'MAGDALENA' => 'MAG',
        'DESIANA' => 'DES',
    ];

    if (isset($prefixKhusus[$namaFaswil])) {
        return $prefixKhusus[$namaFaswil];
    }

    $kata = preg_split(
        '/\s+/',
        trim($namaFaswil)
    );

    // Satu kata: Jakarta -> JAK
    if (count($kata) === 1) {

        $bersih = preg_replace(
            '/[^A-Z0-9]/',
            '',
            $kata[0]
        );

        return strtoupper(
            substr($bersih, 0, 3)
        ) ?: 'FAS';
    }

    // Beberapa kata: ambil huruf awal tiap kata.
    $prefix = '';

    foreach ($kata as $kataSatu) {

        $kataSatu = preg_replace(
            '/[^A-Z0-9]/',
            '',
            $kataSatu
        );

        if ($kataSatu !== '') {
            $prefix .= substr(
                $kataSatu,
                0,
                1
            );
        }

        if (strlen($prefix) >= 3) {
            break;
        }
    }

    // Jika masih kurang dari 3 karakter, ambil dari gabungan nama.
    if (strlen($prefix) < 3) {

        $gabungan = preg_replace(
            '/[^A-Z0-9]/',
            '',
            $namaFaswil
        );

        $prefix = substr(
            $gabungan,
            0,
            3
        );
    }

    return strtoupper(
        $prefix ?: 'FAS'
    );
}





    public function success($id)

{

    /*

    |--------------------------------------------------------------------------

    | AMBIL REGISTRASI + MASTER + TIKET

    |--------------------------------------------------------------------------

    */



    $registrasi = Registrasi::with([

        'master',

        'tiket'

    ])->findOrFail($id);





    /*

    |--------------------------------------------------------------------------

    | AMBIL MASTER

    |--------------------------------------------------------------------------

    */



    $master = $registrasi->master;





    /*

    |--------------------------------------------------------------------------

    | AMBIL TIKET

    |--------------------------------------------------------------------------

    */



    $tiket = $registrasi->tiket;





    /*

    |--------------------------------------------------------------------------

    | JIKA TIKET BELUM DITEMUKAN

    |--------------------------------------------------------------------------

    */



    if (!$tiket) {

        return redirect()

            ->route('registrasi.create')

            ->with(

                'error',

                'Tiket untuk registrasi ini belum ditemukan.'

            );

    }





    /*

    |--------------------------------------------------------------------------

    | KIRIM DATA KE HALAMAN SUKSES

    |--------------------------------------------------------------------------

    */



    return view(

        'pages.Registrasi.sukses',

        compact(

            'registrasi',

            'master',

            'tiket'

        )

    );

}





    /*

    |--------------------------------------------------------------------------

    | HALAMAN TRACKING TIKET

    |--------------------------------------------------------------------------

    */



   /**
 * =========================================================
 * TRACKING TIKET BERDASARKAN NAMA PERGURUAN TINGGI
 * =========================================================
 *
 * Alur:
 *
 * Nama PT
 *    ↓
 * Masters
 *    ↓
 * Registrasi
 *    ↓
 * id_registrasi
 *    ↓
 * Tiket
 *
 * Tiket SELALU diambil berdasarkan id_registrasi
 * yang ditemukan dari PT tersebut.
 *
 */
public function track(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | VALIDASI
    |--------------------------------------------------------------------------
    */

    $request->validate([
        'nama_pt' => [
            'required',
            'string',
            'max:255',
        ],
    ], [
        'nama_pt.required' =>
            'Nama Perguruan Tinggi wajib diisi.',

        'nama_pt.string' =>
            'Nama Perguruan Tinggi harus berupa teks.',

        'nama_pt.max' =>
            'Nama Perguruan Tinggi maksimal 255 karakter.',
    ]);


    /*
    |--------------------------------------------------------------------------
    | NORMALISASI INPUT
    |--------------------------------------------------------------------------
    */

    $namaPT = trim(
        $request->nama_pt
    );


    /*
    |--------------------------------------------------------------------------
    | CARI REGISTRASI BERDASARKAN NAMA PT
    |--------------------------------------------------------------------------
    |
    | PENTING:
    |
    | Kita tidak mengambil tiket dulu.
    |
    | Kita cari REGISTRASI yang benar berdasarkan:
    |
    | registrasis.id_master
    |        ↓
    | masters.nama_pt
    |
    */

    $registrasi = Registrasi::with([
        'master',
    ])

        ->whereHas(
            'master',
            function ($query) use ($namaPT) {

                $query->where(
                    'nama_pt',
                    'like',
                    '%' . $namaPT . '%'
                );

            }
        )

        ->whereHas(
            'tiket'
        )

        ->latest(
            'id_registrasi'
        )

        ->first();


    /*
    |--------------------------------------------------------------------------
    | JIKA PT TIDAK DITEMUKAN
    |--------------------------------------------------------------------------
    */

    if (!$registrasi) {

        return redirect()

            ->route(
                'registrasi.create'
            )

            ->withInput()

            ->with(
                'track_error',

                'Belum ditemukan tiket untuk Perguruan Tinggi "' .
                $namaPT .
                '". Pastikan nama PT sudah melakukan pendaftaran.'
            );

    }


    /*
    |--------------------------------------------------------------------------
    | AMBIL MASTER DARI REGISTRASI YANG BENAR
    |--------------------------------------------------------------------------
    */

    $master =
        $registrasi->master;


    /*
    |--------------------------------------------------------------------------
    | PENGAMAN
    |--------------------------------------------------------------------------
    */

    if (!$master) {

        return redirect()

            ->route(
                'registrasi.create'
            )

            ->withInput()

            ->with(
                'track_error',

                'Data master untuk Perguruan Tinggi "' .
                $namaPT .
                '" tidak ditemukan.'
            );

    }


    /*
    |--------------------------------------------------------------------------
    | AMBIL TIKET LANGSUNG BERDASARKAN ID REGISTRASI
    |--------------------------------------------------------------------------
    |
    | INI BAGIAN PALING PENTING.
    |
    | Jangan menggunakan:
    |
    | $registrasi->tiket
    |
    | untuk proses pencarian utama.
    |
    | Kita ambil langsung dari tabel tikets:
    |
    | tikets.id_registrasi
    | =
    | registrasis.id_registrasi
    |
    */

    $tiket = Tiket::query()

        ->where(
            'id_registrasi',
            $registrasi->id_registrasi
        )

        ->latest(
            'id_tiket'
        )

        ->first();


    /*
    |--------------------------------------------------------------------------
    | JIKA TIKET TIDAK DITEMUKAN
    |--------------------------------------------------------------------------
    */

    if (!$tiket) {

        return redirect()

            ->route(
                'registrasi.create'
            )

            ->withInput()

            ->with(
                'track_error',

                'Tiket untuk Perguruan Tinggi "' .
                $master->nama_pt .
                '" belum ditemukan.'
            );

    }


    /*
    |--------------------------------------------------------------------------
    | AMBIL SEMUA MASTER
    |--------------------------------------------------------------------------
    |
    | Tetap dikirim supaya fungsi form registrasi
    | sebelumnya tidak berubah.
    |
    */

    $masters = Master::query()

        ->orderBy(
            'tanggal',
            'asc'
        )

        ->orderBy(
            'jam_mulai',
            'asc'
        )

        ->orderBy(
            'nama_pt',
            'asc'
        )

        ->get();


    /*
    |--------------------------------------------------------------------------
    | KEMBALIKAN KE HALAMAN REGISTRASI
    |--------------------------------------------------------------------------
    */

    return view(

        'pages.Registrasi.registrasi',

        compact(
            'masters',
            'tiket',
            'registrasi',
            'master'
        )

    );
}



    /*

    |--------------------------------------------------------------------------

    | TRACKING BERDASARKAN NOMOR TIKET

    |--------------------------------------------------------------------------

    */



    public function trackStatus($nomor_tiket)

{

    $nomorTiket = strtoupper(

        trim($nomor_tiket)

    );



    /*

    |--------------------------------------------------------------------------

    | CARI TIKET

    |--------------------------------------------------------------------------

    */



    $tiket = Tiket::with([

        'registrasi.master'

    ])

    ->whereRaw(

        'UPPER(TRIM(nomor_tiket)) = ?',

        [$nomorTiket]

    )

    ->first();



    /*

    |--------------------------------------------------------------------------

    | TIDAK DITEMUKAN

    |--------------------------------------------------------------------------

    */



    if (!$tiket) {

        return response()->json([

            'success' => false,

            'found' => false,

            'message' => 'Nomor tiket tidak ditemukan.'

        ], 404);

    }



    /*

    |--------------------------------------------------------------------------

    | REGISTRASI

    |--------------------------------------------------------------------------

    */



    $registrasi = $tiket->registrasi;



    /*

    |--------------------------------------------------------------------------

    | MASTER

    |--------------------------------------------------------------------------

    */



    $master = $registrasi

        ? $registrasi->master

        : null;



    /*

    |--------------------------------------------------------------------------

    | RESPONSE

    |--------------------------------------------------------------------------

    */



    return response()->json([



        'success' => true,



        'found' => true,



        'message' => 'Data tiket ditemukan.',



        'id_tiket' => $tiket->id_tiket,



        'nomor_tiket' => $tiket->nomor_tiket,



        'status' => $tiket->status,



        'waktu_daftar' => $tiket->waktu_daftar,



        'waktu_mulai' => $tiket->waktu_mulai,



        'waktu_selesai' => $tiket->waktu_selesai,



        'tanggal_antrian' => $tiket->tanggal_antrian,



        'durasi_timer' => $tiket->durasi_timer,



        'timer_berakhir' => $tiket->timer_berakhir,



        'jumlah_reset_timer' =>

            $tiket->jumlah_reset_timer ?? 0,



        'status_timer' =>

            $tiket->status_timer ?? null,



        'registrasi' => $registrasi ? [



            'id_registrasi' =>

                $registrasi->id_registrasi,



            'id_master' =>

                $registrasi->id_master,



            'kebutuhan' =>

                $registrasi->kebutuhan,



            'status' =>

                $registrasi->status,



        ] : null,



        'master' => $master ? [



            'id_master' =>

                $master->id_master,



            'kode_pt' =>

                $master->kode_pt,



            'nama_pt' =>

                $master->nama_pt,



            'nama_faswil' =>

                $master->nama_faswil,



            'no_meja' =>

                $master->no_meja,



            'sesi' =>

                $master->sesi,



            'tanggal' =>

                $master->tanggal,



            'jam_mulai' =>

                $master->jam_mulai,



            'jam_selesai' =>

                $master->jam_selesai,



            'pendamping' =>

                $master->pendamping,



        ] : null,

    ]);

}



    /*

    |--------------------------------------------------------------------------

    | CHECK STATUS

    |--------------------------------------------------------------------------

    |

    | Digunakan oleh halaman registrasi untuk polling status tiket.

    |

    */



    /*

\|--------------------------------------------------------------------------

\| CHECK STATUS TIKET

\|--------------------------------------------------------------------------

|

\| Digunakan oleh halaman registrasi untuk mengecek perubahan

\| aksi yang dilakukan oleh petugas.

|

*/



/**
 * =========================================================
 * CHECK STATUS TIKET
 * =========================================================
 *
 * Digunakan oleh halaman registrasi untuk polling
 * perubahan status dan aksi petugas setiap 1 detik.
 *
 */
public function checkStatus(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | VALIDASI NOMOR TIKET
    |--------------------------------------------------------------------------
    */

    $request->validate([
        'nomor_tiket' => [
            'required',
            'string',
            'max:50',
        ],
    ]);


    /*
    |--------------------------------------------------------------------------
    | NORMALISASI NOMOR TIKET
    |--------------------------------------------------------------------------
    */

    $nomorTiket = strtoupper(
        trim($request->nomor_tiket)
    );


    /*
    |--------------------------------------------------------------------------
    | CARI TIKET
    |--------------------------------------------------------------------------
    */

    $tiket = Tiket::with([
        'registrasi.master'
    ])
        ->whereRaw(
            'UPPER(TRIM(nomor_tiket)) = ?',
            [$nomorTiket]
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
            'found' => false,
            'message' => 'Tiket tidak ditemukan.',
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
    | AKSI TERAKHIR
    |--------------------------------------------------------------------------
    */

    $aksiTerakhir =
        $tiket->aksi_terakhir;


    /*
    |--------------------------------------------------------------------------
    | WAKTU AKSI
    |--------------------------------------------------------------------------
    |
    | Gunakan waktu_aksi sebagai identitas event.
    |
    | Contoh:
    |
    | Panggil       08:10:01
    | Panggil Ulang 08:11:15
    | Panggil Ulang 08:12:20
    |
    | Ketiganya dianggap event berbeda.
    |
    */

    $waktuAksi =
        $tiket->waktu_aksi
            ? $tiket->waktu_aksi->format(
                'Y-m-d H:i:s'
            )
            : null;


    /*
    |--------------------------------------------------------------------------
    | RESPONSE
    |--------------------------------------------------------------------------
    */

    return response()->json([

        'success' => true,

        'found' => true,


        /*
        |--------------------------------------------------------------------------
        | TIKET
        |--------------------------------------------------------------------------
        */

        'id_tiket' =>
            $tiket->id_tiket,

        'nomor_tiket' =>
            $tiket->nomor_tiket,


        /*
        |--------------------------------------------------------------------------
        | STATUS TIKET
        |--------------------------------------------------------------------------
        */

        'status' =>
            $tiket->status,


        'pesan' =>
            $this->pesanStatus(
                $tiket->status
            ),


        /*
        |--------------------------------------------------------------------------
        | EVENT AKSI PETUGAS
        |--------------------------------------------------------------------------
        */

        'aksi_terakhir' =>
            $aksiTerakhir,

        'waktu_aksi' =>
            $waktuAksi,


        /*
        |--------------------------------------------------------------------------
        | DATA MASTER
        |--------------------------------------------------------------------------
        */

        'kode_pt' =>
            $master?->kode_pt,

        'nama_pt' =>
            $master?->nama_pt,

        'faswil' =>
            $master?->nama_faswil,

        'meja' =>
            $master?->no_meja,

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


        /*
        |--------------------------------------------------------------------------
        | UPDATED AT
        |--------------------------------------------------------------------------
        */

        'updated_at' =>
            $tiket->updated_at
                ? $tiket->updated_at->format(
                    'Y-m-d H:i:s'
                )
                : null,

    ]);
}



    /*

    |--------------------------------------------------------------------------

    | PESAN STATUS

    |--------------------------------------------------------------------------

    */



    private function pesanStatus($status)

    {

        return match ($status) {



            'menunggu' =>

                'Tiket Anda masih dalam antrean dan sedang menunggu dipanggil.',



            'dipanggil' =>

                'Tiket Anda sedang dipanggil. Silakan menuju meja pelayanan.',



            'dilayani' =>

                'Tiket Anda sedang dilayani oleh petugas.',



            'dilewati' =>

                'Tiket Anda telah dilewati oleh petugas.',



            'dilewat' =>

                'Tiket Anda telah dilewati oleh petugas.',



            'selesai' =>

                'Layanan untuk tiket Anda telah selesai. Terima kasih.',



            default =>

                'Status tiket belum diketahui.',

        };

    }





    /*

    |--------------------------------------------------------------------------

    | DETAIL REGISTRASI

    |--------------------------------------------------------------------------

    */



    public function show($id)

    {

        $registrasi = Registrasi::with([

            'master',

            'tiket'

        ])->findOrFail($id);





        return view(

            'pages.Registrasi.show',

            compact('registrasi')

        );

    }





    /*

    |--------------------------------------------------------------------------

    | DAFTAR REGISTRASI ADMIN

    |--------------------------------------------------------------------------

    */



    /*
|--------------------------------------------------------------------------
| HALAMAN KELOLA REGISTRASI
|--------------------------------------------------------------------------
*/

public function index(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | QUERY REGISTRASI
    |--------------------------------------------------------------------------
    */

    $query = Registrasi::with([
        'master',
        'tiket'
    ]);


    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    | Bisa mencari:
    | - Nomor tiket
    | - Kode PT
    | - Nama PT
    | - Nama Faswil
    | - Nomor meja
    */

    if ($request->filled('search')) {

        $search = trim($request->search);

        $query->where(function ($q) use ($search) {

            /*
            |--------------------------------------------------------------------------
            | NOMOR TIKET
            |--------------------------------------------------------------------------
            */

            $q->whereHas('tiket', function ($tiket) use ($search) {

                $tiket->where(
                    'nomor_tiket',
                    'like',
                    '%' . $search . '%'
                );

            });


            /*
            |--------------------------------------------------------------------------
            | DATA MASTER
            |--------------------------------------------------------------------------
            */

            $q->orWhereHas('master', function ($master) use ($search) {

                $master->where(function ($m) use ($search) {

                    $m->where(
                        'kode_pt',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhere(
                        'nama_pt',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhere(
                        'nama_faswil',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhere(
                        'no_meja',
                        'like',
                        '%' . $search . '%'
                    );

                });

            });

        });

    }


    /*
    |--------------------------------------------------------------------------
    | FILTER MEJA
    |--------------------------------------------------------------------------
    |
    | Contoh:
    | ?meja=1
    | ?meja=4
    | ?meja=15
    |
    */

    if ($request->filled('meja')) {

        $query->whereHas('master', function ($master) use ($request) {

            $master->where(
                'no_meja',
                $request->meja
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
        $request->status !== 'semua'
    ) {

        $query->where(
            'status',
            $request->status
        );

    }


    /*
    |--------------------------------------------------------------------------
    | PAGINATION
    |--------------------------------------------------------------------------
    |
    | 10 data per halaman.
    | Search + meja + status tetap dibawa ketika pindah halaman.
    |
    */

    $registrasis = $query
        ->latest('id_registrasi')
        ->paginate(10)
        ->withQueryString();


    /*
    |--------------------------------------------------------------------------
    | DATA MASTER
    |--------------------------------------------------------------------------
    */

    $masters = Master::query()
        ->orderBy('tanggal', 'asc')
        ->orderBy('jam_mulai', 'asc')
        ->orderBy('nama_pt', 'asc')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | DATA NOMOR MEJA
    |--------------------------------------------------------------------------
    |
    | Mengambil nomor meja unik dari tabel masters.
    |
    */

    $mejas = Master::query()
        ->whereNotNull('no_meja')
        ->where('no_meja', '!=', '')
        ->select('no_meja')
        ->distinct()
        ->orderByRaw('CAST(no_meja AS UNSIGNED) ASC')
        ->pluck('no_meja');


    /*
    |--------------------------------------------------------------------------
    | RETURN VIEW
    |--------------------------------------------------------------------------
    */

    return view(
        'pages.Registrasi.index',
        compact(
            'registrasis',
            'masters',
            'mejas'
        )
    );
}


    /*\*

 \* =========================================================

 \* TRACK TIKET BERDASARKAN NAMA PERGURUAN TINGGI

 \* =========================================================

 */

    public function trackByPT(Request $request)

    {

        // Kompatibilitas untuk route lama.

        return $this->track($request);

    }



    /*

    |--------------------------------------------------------------------------

    | UPDATE STATUS REGISTRASI

    |--------------------------------------------------------------------------

    */



    public function updateStatus(

        Request $request,

        $id

    ) {



        $request->validate([



            'status' => [

                'required',

                'in:terdaftar,diproses,selesai,dibatalkan,dilewati'

            ],



        ]);





        $registrasi =

            Registrasi::findOrFail($id);





        $registrasi->status =

            $request->status;





        $registrasi->save();





        /*

        |--------------------------------------------------------------------------

        | Sinkronisasi status tiket

        |--------------------------------------------------------------------------

        */



        if ($registrasi->tiket) {



            $statusTiket =

                $request->status;





            /*

            | Status registrasi dibatalkan

            | tidak harus sama dengan tiket.

            */



            if ($statusTiket === 'dibatalkan') {



                $registrasi->tiket->status =

                    'dilewat';



            } else {



                $registrasi->tiket->status =

                    $statusTiket;

            }





            $registrasi->tiket->aksi_terakhir =

                'update_status';



            $registrasi->tiket->waktu_aksi =

                now();



            $registrasi->tiket->save();

        }





        return back()->with(

            'success',

            'Status registrasi berhasil diperbarui.'

        );

    }





    /*

    |--------------------------------------------------------------------------

    | HAPUS REGISTRASI

    |--------------------------------------------------------------------------

    */



    public function destroy($id)

    {

        $registrasi =

            Registrasi::with('tiket')

                ->findOrFail($id);





        DB::beginTransaction();



        try {



            /*

            |--------------------------------------------------------------------------

            | Hapus tiket terlebih dahulu

            |--------------------------------------------------------------------------

            |

            | Karena tiket mempunyai FK ke registrasi.

            |

            */



            if ($registrasi->tiket) {



                $registrasi->tiket->delete();

            }





            /*

            |--------------------------------------------------------------------------

            | Hapus registrasi

            |--------------------------------------------------------------------------

            */



            $registrasi->delete();





            DB::commit();





            return back()->with(

                'success',

                'Data registrasi dan tiket berhasil dihapus.'

            );



        } catch (\Exception $e) {



            DB::rollBack();





            return back()->with(

                'error',

                'Data registrasi gagal dihapus: ' .

                $e->getMessage()

            );

        }

    }





    /*

    |--------------------------------------------------------------------------

    | EXPORT REGISTRASI

    |--------------------------------------------------------------------------

    */



    public function export()
{
    /*
    |--------------------------------------------------------------------------
    | AMBIL DATA REGISTRASI
    |--------------------------------------------------------------------------
    | Relasi:
    | - master
    | - tiket
    |--------------------------------------------------------------------------
    */

    $registrasis = Registrasi::with([
        'master',
        'tiket'
    ])
        ->orderBy('id_registrasi', 'desc')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | NAMA FILE
    |--------------------------------------------------------------------------
    */

    $filename = 'data-registrasi-' . date('Y-m-d-His') . '.csv';


    /*
    |--------------------------------------------------------------------------
    | HEADER RESPONSE
    |--------------------------------------------------------------------------
    */

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Cache-Control' => 'no-store, no-cache',
        'Pragma' => 'no-cache',
    ];


    /*
    |--------------------------------------------------------------------------
    | CALLBACK CSV
    |--------------------------------------------------------------------------
    */

    $callback = function () use ($registrasis) {

        /*
        |--------------------------------------------------------------------------
        | OUTPUT CSV
        |--------------------------------------------------------------------------
        */

        $file = fopen('php://output', 'w');


        /*
        |--------------------------------------------------------------------------
        | BOM UTF-8
        |--------------------------------------------------------------------------
        | Supaya tulisan Indonesia di Excel tidak berantakan.
        |--------------------------------------------------------------------------
        */

        fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));


        /*
        |--------------------------------------------------------------------------
        | HEADER KOLOM
        |--------------------------------------------------------------------------
        */

        fputcsv($file, [
            'No',
            'Nomor Tiket',
            'Kode PT',
            'Perguruan Tinggi',
            'Faswil',
            'No. Meja',
            'Sesi',
            'Tanggal Jadwal',
            'Jam Mulai',
            'Jam Selesai',
            'Pendamping',
            'Tanggal Registrasi',
            'Kebutuhan',
            'Status',
        ]);


        /*
        |--------------------------------------------------------------------------
        | DATA REGISTRASI
        |--------------------------------------------------------------------------
        */

        foreach ($registrasis as $index => $registrasi) {

            /*
            |--------------------------------------------------------------------------
            | MASTER
            |--------------------------------------------------------------------------
            */

            $master = $registrasi->master;


            /*
            |--------------------------------------------------------------------------
            | TIKET
            |--------------------------------------------------------------------------
            */

            $tiket = $registrasi->tiket;


            /*
            |--------------------------------------------------------------------------
            | FORMAT TANGGAL JADWAL
            |--------------------------------------------------------------------------
            */

            $tanggalJadwal = '-';

            if ($master && !empty($master->tanggal)) {

                try {

                    $tanggalJadwal = \Carbon\Carbon::parse(
                        $master->tanggal
                    )->format('d-m-Y');

                } catch (\Exception $e) {

                    $tanggalJadwal = $master->tanggal;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | FORMAT TANGGAL REGISTRASI
            |--------------------------------------------------------------------------
            */

            $tanggalRegistrasi = '-';

            if ($registrasi->tgl_registrasi) {

                try {

                    $tanggalRegistrasi = \Carbon\Carbon::parse(
                        $registrasi->tgl_registrasi
                    )->format('d-m-Y H:i:s');

                } catch (\Exception $e) {

                    $tanggalRegistrasi = $registrasi->tgl_registrasi;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $status = $registrasi->status
                ? ucfirst($registrasi->status)
                : '-';


            /*
            |--------------------------------------------------------------------------
            | TULIS DATA KE CSV
            |--------------------------------------------------------------------------
            */

            fputcsv($file, [

                // No
                $index + 1,

                // Nomor Tiket
                $tiket?->nomor_tiket ?? '-',

                // Kode PT
                $master?->kode_pt ?? '-',

                // Perguruan Tinggi
                $master?->nama_pt ?? '-',

                // Faswil
                $master?->nama_faswil ?? '-',

                // No Meja
                $master?->no_meja ?? '-',

                // Sesi
                $master?->sesi ?? '-',

                // Tanggal Jadwal
                $tanggalJadwal,

                // Jam Mulai
                $master?->jam_mulai ?? '-',

                // Jam Selesai
                $master?->jam_selesai ?? '-',

                // Pendamping
                $master?->pendamping ?? '-',

                // Tanggal Registrasi
                $tanggalRegistrasi,

                // Kebutuhan
                $registrasi->kebutuhan ?? '-',

                // Status
                $status,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | TUTUP FILE
        |--------------------------------------------------------------------------
        */

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


    public function cetakTiket($id)

{

    /*

    |--------------------------------------------------------------------------

    | AMBIL REGISTRASI

    |--------------------------------------------------------------------------

    */



    $registrasi = Registrasi::with([

        'master',

        'tiket'

    ])->findOrFail($id);





    /*

    |--------------------------------------------------------------------------

    | AMBIL TIKET

    |--------------------------------------------------------------------------

    */



    $tiket = $registrasi->tiket;





    /*

    |--------------------------------------------------------------------------

    | CEK TIKET

    |--------------------------------------------------------------------------

    */



    if (!$tiket) {



        return redirect()

            ->route('registrasi.create')

            ->with(

                'track_error',

                'Tiket untuk registrasi ini tidak ditemukan.'

            );

    }





    /*

    |--------------------------------------------------------------------------

    | AMBIL MASTER

    |--------------------------------------------------------------------------

    */



    $master = $registrasi->master;





    /*

    |--------------------------------------------------------------------------

    | TAMPILKAN HALAMAN SUKSES / CETAK TIKET

    |--------------------------------------------------------------------------

    */



    return view(

        'pages.Registrasi.sukses',

        compact(

            'registrasi',

            'tiket',

            'master'

        )

    );

}



/**
 * =========================================================
 * CEK STATUS AKSI TIKET UNTUK POPUP OTOMATIS
 * =========================================================
 *
 * Method khusus untuk registrasi.blade.php.
 *
 * Tidak menggantikan:
 * - checkStatus()
 * - cekStatusTiket()
 * - trackStatus()
 *
 * Method ini khusus membaca tiket berdasarkan id_tiket.
 */
public function cekStatusPopup($id)
{
    /*
    |--------------------------------------------------------------------------
    | AMBIL TIKET BERDASARKAN ID TIKET
    |--------------------------------------------------------------------------
    */

    $tiket = Tiket::with([
        'registrasi.master',
    ])->find($id);

    /*
    |--------------------------------------------------------------------------
    | TIKET TIDAK DITEMUKAN
    |--------------------------------------------------------------------------
    */

    if (!$tiket) {

        return response()->json([
            'success' => false,
            'found' => false,
            'message' => 'Tiket tidak ditemukan.'
        ], 404);
    }

    /*
    |--------------------------------------------------------------------------
    | MASTER
    |--------------------------------------------------------------------------
    */

    $master = $tiket->registrasi?->master;

    /*
    |--------------------------------------------------------------------------
    | AKSI TERAKHIR
    |--------------------------------------------------------------------------
    |
    | Tetap menggunakan field database:
    |
    | aksi_terakhir
    |
    */

    $aksi = $tiket->aksi_terakhir;

    /*
    |--------------------------------------------------------------------------
    | PESAN POPUP
    |--------------------------------------------------------------------------
    */

    switch ($aksi) {

        case 'dipanggil':

            $pesan =
                'Antrean ' .
                $tiket->nomor_tiket .
                ' sedang dipanggil. Silakan menuju meja pelayanan.';

            break;


        case 'dipanggil_ulang':

            $pesan =
                'Antrean ' .
                $tiket->nomor_tiket .
                ' dipanggil ulang. Silakan menuju meja pelayanan.';

            break;


        case 'dilewati':

            $pesan =
                'Antrean ' .
                $tiket->nomor_tiket .
                ' telah dilewati oleh petugas.';

            break;


        case 'selesai':

            $pesan =
                'Layanan untuk antrean ' .
                $tiket->nomor_tiket .
                ' telah selesai. Terima kasih.';

            break;


        default:

            $pesan = null;

            break;
    }

    /*
    |--------------------------------------------------------------------------
    | RESPONSE
    |--------------------------------------------------------------------------
    |
    | waktu_aksi digunakan oleh Blade sebagai identitas
    | setiap aksi baru.
    |
    */

    return response()->json([

        'success' => true,

        'found' => true,

        'id_tiket' =>
            $tiket->id_tiket,

        'nomor_tiket' =>
            $tiket->nomor_tiket,

        'status' =>
            $tiket->status,

        'aksi_terakhir' =>
            $aksi,

        'waktu_aksi' =>
            optional(
                $tiket->waktu_aksi
            )->format('Y-m-d H:i:s'),

        'pesan' =>
            $pesan,

        /*
        |--------------------------------------------------------------------------
        | DATA TAMBAHAN
        |--------------------------------------------------------------------------
        */

        'kode_pt' =>
            $master?->kode_pt,

        'nama_pt' =>
            $master?->nama_pt,

        'faswil' =>
            $master?->nama_faswil,

        'meja' =>
            $master?->no_meja,

        'sesi' =>
            $master?->sesi,

        'tanggal' =>
            $master?->tanggal,

        'jam_mulai' =>
            $master?->jam_mulai,

        'jam_selesai' =>
            $master?->jam_selesai,

        'pendamping' =>
            $master?->pendamping,

    ]);
}


/*
|--------------------------------------------------------------------------
| PETUGAS - KELOLA REGISTRASI
|--------------------------------------------------------------------------
| Petugas hanya dapat melihat data registrasi.
| Tidak dapat tambah, edit, hapus, atau export.
|---------------------------------------------------
/*
|--------------------------------------------------------------------------
| KELOLA REGISTRASI PETUGAS
|--------------------------------------------------------------------------
| Petugas hanya membaca data registrasi.
| Data tetap mengambil dari tabel registrasis yang sama dengan Admin.
|--------------------------------------------------------------------------
*/

public function petugasIndex(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | QUERY DATA REGISTRASI
    |--------------------------------------------------------------------------
    */

    $query = Registrasi::with([
        'master',
        'tiket'
    ]);


    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    | Bisa mencari:
    | - Nomor tiket
    | - Kode PT
    | - Nama PT
    | - Nama Faswil
    | - Nomor meja
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $search = trim($request->search);

        $query->where(function ($q) use ($search) {

            /*
            |--------------------------------------------------------------------------
            | CARI NOMOR TIKET
            |--------------------------------------------------------------------------
            */

            $q->whereHas('tiket', function ($tiket) use ($search) {

                $tiket->where(
                    'nomor_tiket',
                    'like',
                    '%' . $search . '%'
                );

            });


            /*
            |--------------------------------------------------------------------------
            | CARI DATA MASTER
            |--------------------------------------------------------------------------
            */

            $q->orWhereHas('master', function ($master) use ($search) {

                $master->where(function ($m) use ($search) {

                    /*
                    | Kode PT
                    */

                    $m->where(
                        'kode_pt',
                        'like',
                        '%' . $search . '%'
                    )

                    /*
                    | Nama PT
                    */

                    ->orWhere(
                        'nama_pt',
                        'like',
                        '%' . $search . '%'
                    )

                    /*
                    | Nama Faswil
                    */

                    ->orWhere(
                        'nama_faswil',
                        'like',
                        '%' . $search . '%'
                    )

                    /*
                    | Nomor Meja
                    */

                    ->orWhere(
                        'no_meja',
                        'like',
                        '%' . $search . '%'
                    );

                });

            });

        });

    }


    /*
    |--------------------------------------------------------------------------
    | FILTER MEJA
    |--------------------------------------------------------------------------
    | Contoh:
    | ?meja=1
    | ?meja=4
    | ?meja=15
    |--------------------------------------------------------------------------
    */

    if (
        $request->filled('meja') &&
        $request->meja !== 'semua'
    ) {

        $meja = $request->meja;

        /*
        | Pastikan apabila Blade mengirim array,
        | tetap bisa diproses.
        */

        if (!is_array($meja)) {
            $meja = [$meja];
        }

        $query->whereHas('master', function ($master) use ($meja) {

            $master->whereIn(
                'no_meja',
                $meja
            );

        });

    }



    /*
    |--------------------------------------------------------------------------
    | PAGINATION
    |--------------------------------------------------------------------------
    | 10 data per halaman.
    | Semua filter tetap dibawa ketika pindah halaman.
    |--------------------------------------------------------------------------
    */

    $registrasis = $query
        ->latest('id_registrasi')
        ->paginate(10)
        ->withQueryString();


    /*
    |--------------------------------------------------------------------------
    | DATA MASTER
    |--------------------------------------------------------------------------
    | Tetap disediakan apabila Blade membutuhkan data master.
    |--------------------------------------------------------------------------
    */

    $masters = Master::query()
        ->orderBy('tanggal', 'asc')
        ->orderBy('jam_mulai', 'asc')
        ->orderBy('nama_pt', 'asc')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | DATA NOMOR MEJA
    |--------------------------------------------------------------------------
    | Diambil dari tabel masters.
    | Hanya nomor meja yang unik yang ditampilkan.
    |--------------------------------------------------------------------------
    */

    $mejas = Master::query()
        ->whereNotNull('no_meja')
        ->where('no_meja', '!=', '')
        ->select('no_meja')
        ->distinct()
        ->orderByRaw('CAST(no_meja AS UNSIGNED) ASC')
        ->pluck('no_meja');


    /*
    |--------------------------------------------------------------------------
    | RETURN VIEW
    |--------------------------------------------------------------------------
    */

    return view(
        'pages.Petugas.Registrasi.index',
        compact(
            'registrasis',
            'masters',
            'mejas'
        )
    );
}


/*
|--------------------------------------------------------------------------
| PETUGAS - DETAIL REGISTRASI
|--------------------------------------------------------------------------
| Petugas hanya dapat melihat detail.
|--------------------------------------------------------------------------
*/

public function petugasShow($id)
{
    $registrasi = Registrasi::with([
        'master',
        'tiket'
    ])->findOrFail($id);


    return view(
        'pages.Petugas.Registrasi.show',
        compact('registrasi')
    );
}

    /*

    |--------------------------------------------------------------------------

    | CEK STATUS TIKET DARI REGISTRASI

    |--------------------------------------------------------------------------

    */



    public function cekStatusTiket($id)

    {

        /*

        |--------------------------------------------------------------------------

        | AMBIL REGISTRASI

        |--------------------------------------------------------------------------

        */



        $registrasi =

            Registrasi::with([

                'master',

                'tiket'

            ])->find($id);





        if (!$registrasi) {



            return response()->json([



                'success' => false,



                'message' =>

                    'Registrasi tidak ditemukan.'



            ], 404);

        }





        /*

        |--------------------------------------------------------------------------

        | TIKET

        |--------------------------------------------------------------------------

        */



        $tiket =

            $registrasi->tiket;





        if (!$tiket) {



            return response()->json([



                'success' => false,



                'message' =>

                    'Tiket belum dibuat.'



            ], 404);

        }





        /*

        |--------------------------------------------------------------------------

        | MASTER

        |--------------------------------------------------------------------------

        */



        $master =

            $registrasi->master;





        /*

        |--------------------------------------------------------------------------

        | RESPONSE

        |--------------------------------------------------------------------------

        */



        return response()->json([



            'success' => true,



            'id_tiket' =>

                $tiket->id_tiket,



            'nomor_tiket' =>

                $tiket->nomor_tiket,



            'status' =>

                $tiket->status,



            'aksi_terakhir' =>

                $tiket->aksi_terakhir,



            'pesan' =>

                $this->pesanStatus(

                    $tiket->status

                ),



            'kode_pt' =>

                $master?->kode_pt,



            'nama_pt' =>

                $master?->nama_pt,



            'faswil' =>

                $master?->nama_faswil,



            'meja' =>

                $master?->no_meja,



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



            'waktu_daftar' =>

                $tiket->waktu_daftar

                    ? $tiket->waktu_daftar->format(

                        'H:i:s'

                    )

                    : null,



            'waktu_mulai' =>

                $tiket->waktu_mulai

                    ? $tiket->waktu_mulai->format(

                        'H:i:s'

                    )

                    : null,



            'waktu_selesai' =>

                $tiket->waktu_selesai

                    ? $tiket->waktu_selesai->format(

                        'H:i:s'

                    )

                    : null,



            'updated_at' =>

                $tiket->updated_at

                    ? $tiket->updated_at->format(

                        'Y-m-d H:i:s'

                    )

                    : null,



        ]);

    }

}


