<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Registrasi;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;
use Throwable;

class MasterController extends Controller
{
    /**
     * =========================================================
     * HALAMAN MASTER DATA
     * =========================================================
     */
    public function index(Request $request)
{
    $query = Master::query();

    // ==========================================
    // SEARCH NAMA PERGURUAN TINGGI
    // ==========================================
    if ($request->filled('search')) {

        $search = trim($request->search);

        $query->where('nama_pt', 'like', '%' . $search . '%');
    }

    // ==========================================
    // DATA MASTER
    // ==========================================
    $masters = $query
        ->orderBy('id_master', 'asc')
        ->paginate(15)
        ->withQueryString();

    return view('pages.Master.index', compact('masters'));
}


    /**
     * =========================================================
     * UPLOAD EXCEL MASTER
     * =========================================================
     *
     * Kolom Excel:
     *
     * No
     * Kode PT
     * Nama PT
     * Nama Faswil
     * No. Meja
     * Sesi
     * Tanggal
     * Jam
     * Pendamping
     *
     * Database:
     *
     * kode_pt
     * nama_pt
     * nama_faswil
     * no_meja
     * sesi
     * tanggal
     * jam_mulai
     * jam_selesai
     * pendamping
     *
     */
    public function upload(Request $request)
    {
        /*
         * =====================================================
         * 1. VALIDASI FILE
         * =====================================================
         */

        $request->validate(
            [
                'file' => [
                    'required',
                    'file',
                    'mimes:xlsx,xls,csv',
                    'max:10240',
                ],
            ],
            [
                'file.required' =>
                    'Silakan pilih dokumen Excel terlebih dahulu.',

                'file.file' =>
                    'File yang dipilih tidak valid.',

                'file.mimes' =>
                    'Format file harus .xlsx, .xls, atau .csv.',

                'file.max' =>
                    'Ukuran file maksimal 10 MB.',
            ]
        );


        DB::beginTransaction();


        try {

            /*
             * =================================================
             * 2. AMBIL FILE
             * =================================================
             */

            $file = $request->file('file');


            if (!$file) {

                DB::rollBack();

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'File Excel tidak ditemukan.'
                    );
            }


            if (!$file->isValid()) {

                DB::rollBack();

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'File Excel tidak valid atau gagal diupload.'
                    );
            }


            /*
             * =================================================
             * 3. PATH FILE
             * =================================================
             */

            $filePath = $file->getRealPath();


            if (
                !$filePath ||
                !file_exists($filePath)
            ) {

                DB::rollBack();

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'File upload tidak dapat ditemukan di server.'
                    );
            }


            /*
             * =================================================
             * 4. LOG FILE
             * =================================================
             */

            Log::info(
                'MASTER UPLOAD - MULAI',
                [
                    'nama_file' =>
                        $file->getClientOriginalName(),

                    'path' =>
                        $filePath,

                    'ukuran' =>
                        $file->getSize(),

                    'extension' =>
                        $file->getClientOriginalExtension(),
                ]
            );


            /*
             * =================================================
             * 5. BACA EXCEL
             * =================================================
             */

            $spreadsheet =
                IOFactory::load($filePath);


            Log::info(
                'MASTER UPLOAD - EXCEL BERHASIL DIBACA'
            );


            /*
             * =================================================
             * 6. AMBIL SHEET AKTIF
             * =================================================
             */

            $worksheet =
                $spreadsheet->getActiveSheet();


            if (!$worksheet) {

                DB::rollBack();

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Sheet Excel tidak ditemukan.'
                    );
            }


            /*
             * =================================================
             * 7. BACA SEMUA DATA
             * =================================================
             */

            $rows =
                $worksheet->toArray(
                    null,
                    true,
                    true,
                    false
                );


            if (
                empty($rows) ||
                count($rows) === 0
            ) {

                DB::rollBack();

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'File Excel kosong.'
                    );
            }


            Log::info(
                'MASTER UPLOAD - DATA EXCEL TERBACA',
                [
                    'jumlah_baris' =>
                        count($rows),
                ]
            );


            /*
             * =================================================
             * 8. CARI BARIS HEADER
             * =================================================
             *
             * Kita tidak langsung menganggap baris pertama
             * sebagai header.
             *
             * Controller akan mencari baris yang mengandung
             * "Kode PT".
             *
             */

            $headerRowIndex = null;
            $header = [];


            foreach (
                array_slice($rows, 0, 10, true)
                as $rowIndex => $row
            ) {

                $headerSementara = [];


                foreach ($row as $index => $value) {

                    $headerSementara[$index] =
                        $this->normalisasiHeader($value);
                }


                /*
                 * Cari apakah ada "kode pt"
                 */
                foreach (
                    $headerSementara
                    as $namaKolom
                ) {

                    if (
                        $this->headerCocok(
                            $namaKolom,
                            [
                                'kode pt',
                                'kode perguruan tinggi',
                                'kodept',
                            ]
                        )
                    ) {

                        $headerRowIndex =
                            $rowIndex;

                        $header =
                            $headerSementara;

                        break 2;
                    }
                }
            }


            /*
             * =================================================
             * 9. JIKA HEADER TIDAK DITEMUKAN
             * =================================================
             */

            if (
                $headerRowIndex === null
            ) {

                Log::error(
                    'MASTER UPLOAD - HEADER TIDAK DITEMUKAN',
                    [
                        'contoh_data' =>
                            array_slice(
                                $rows,
                                0,
                                5
                            ),
                    ]
                );


                DB::rollBack();


                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Header Excel tidak dapat dikenali. Pastikan terdapat kolom "Kode PT".'
                    );
            }


            Log::info(
                'MASTER UPLOAD - HEADER DITEMUKAN',
                [
                    'baris_header' =>
                        $headerRowIndex + 1,

                    'header' =>
                        $header,
                ]
            );


            /*
             * =================================================
             * 10. CARI INDEX KOLOM
             * =================================================
             */

            $indexNo =
                $this->cariKolom(
                    $header,
                    [
                        'no',
                        'nomor',
                        'no.',
                        'no urut',
                    ]
                );


            $indexKodePt =
                $this->cariKolom(
                    $header,
                    [
                        'kode pt',
                        'kode perguruan tinggi',
                        'kodept',
                        'kode',
                    ]
                );


            $indexNamaPt =
                $this->cariKolom(
                    $header,
                    [
                        'nama pt',
                        'nama perguruan tinggi',
                        'namapt',
                    ]
                );


            $indexFaswil =
                $this->cariKolom(
                    $header,
                    [
                        'nama faswil',
                        'faswil',
                        'nama wilayah',
                    ]
                );


            $indexMeja =
                $this->cariKolom(
                    $header,
                    [
                        'no meja',
                        'no. meja',
                        'nomor meja',
                        'meja',
                    ]
                );


            $indexSesi =
                $this->cariKolom(
                    $header,
                    [
                        'sesi',
                    ]
                );


            $indexTanggal =
                $this->cariKolom(
                    $header,
                    [
                        'tanggal',
                        'tgl',
                        'tanggal jadwal',
                    ]
                );


            $indexJam =
                $this->cariKolom(
                    $header,
                    [
                        'jam',
                        'waktu',
                        'jam jadwal',
                    ]
                );


            $indexPendamping =
                $this->cariKolom(
                    $header,
                    [
                        'pendamping',
                        'nama pendamping',
                    ]
                );


            /*
             * =================================================
             * 11. CEK KOLOM WAJIB
             * =================================================
             */

            $kolomWajib = [

                'No' =>
                    $indexNo,

                'Kode PT' =>
                    $indexKodePt,

                'Nama PT' =>
                    $indexNamaPt,

                'Nama Faswil' =>
                    $indexFaswil,

                'No. Meja' =>
                    $indexMeja,

                'Sesi' =>
                    $indexSesi,

                'Tanggal' =>
                    $indexTanggal,

                'Jam' =>
                    $indexJam,

                'Pendamping' =>
                    $indexPendamping,
            ];


            $kolomTidakDitemukan = [];


            foreach (
                $kolomWajib
                as $namaKolom => $index
            ) {

                if (
                    $index === false ||
                    $index === null
                ) {

                    $kolomTidakDitemukan[] =
                        $namaKolom;
                }
            }


            if (
                count($kolomTidakDitemukan) > 0
            ) {

                Log::error(
                    'MASTER UPLOAD - KOLOM TIDAK DITEMUKAN',
                    [
                        'kolom_tidak_ditemukan' =>
                            $kolomTidakDitemukan,

                        'header_terbaca' =>
                            $header,
                    ]
                );


                DB::rollBack();


                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Kolom berikut tidak ditemukan: ' .
                        implode(
                            ', ',
                            $kolomTidakDitemukan
                        )
                    );
            }


            /*
             * =================================================
             * 12. LOG INDEX
             * =================================================
             */

            Log::info(
                'MASTER UPLOAD - SEMUA KOLOM DITEMUKAN',
                [
                    'no' =>
                        $indexNo,

                    'kode_pt' =>
                        $indexKodePt,

                    'nama_pt' =>
                        $indexNamaPt,

                    'nama_faswil' =>
                        $indexFaswil,

                    'no_meja' =>
                        $indexMeja,

                    'sesi' =>
                        $indexSesi,

                    'tanggal' =>
                        $indexTanggal,

                    'jam' =>
                        $indexJam,

                    'pendamping' =>
                        $indexPendamping,
                ]
            );


            /*
             * =================================================
             * 13. COUNTER
             * =================================================
             */

            $berhasil = 0;

            $dilewati = 0;

            $barisError = [];


            /*
             * =================================================
             * 14. PROSES DATA
             * =================================================
             *
             * Mulai setelah baris header.
             */

            $dataRows =
                array_slice(
                    $rows,
                    $headerRowIndex + 1
                );


            foreach (
                $dataRows
                as $nomorBaris => $row
            ) {

                $nomorBarisExcel =
                    $headerRowIndex +
                    $nomorBaris +
                    2;


                /*
                 * =============================================
                 * CEK BARIS KOSONG
                 * =============================================
                 */

                $adaIsi = false;


                foreach ($row as $value) {

                    if (
                        $value !== null &&
                        trim(
                            (string) $value
                        ) !== ''
                    ) {

                        $adaIsi = true;

                        break;
                    }
                }


                if (!$adaIsi) {

                    continue;
                }


                /*
                 * =============================================
                 * AMBIL DATA EXCEL
                 * =============================================
                 */

                $no =
                    $row[$indexNo] ?? '';

                $kodePt =
                    $row[$indexKodePt] ?? '';

                $namaPt =
                    $row[$indexNamaPt] ?? '';

                $namaFaswil =
                    $row[$indexFaswil] ?? '';

                $noMeja =
                    $row[$indexMeja] ?? '';

                $sesi =
                    $row[$indexSesi] ?? '';

                $tanggalExcel =
                    $row[$indexTanggal] ?? '';

                $jamExcel =
                    $row[$indexJam] ?? '';

                $pendamping =
                    $row[$indexPendamping] ?? '';


                /*
                 * =============================================
                 * CLEAN DATA
                 * =============================================
                 */

                $no =
                    $this->cleanExcelValue(
                        $no
                    );


                $kodePt =
                    $this->cleanExcelValue(
                        $kodePt
                    );


                $namaPt =
                    $this->cleanExcelValue(
                        $namaPt
                    );


                $namaFaswil =
                    $this->cleanExcelValue(
                        $namaFaswil
                    );


                $noMeja =
                    $this->cleanExcelValue(
                        $noMeja
                    );


                $sesi =
                    $this->cleanExcelValue(
                        $sesi
                    );


                $pendamping =
                    $this->cleanExcelValue(
                        $pendamping
                    );


                /*
                 * =============================================
                 * VALIDASI DATA
                 * =============================================
                 */

                if (
                    $kodePt === '' ||
                    $namaPt === '' ||
                    $namaFaswil === '' ||
                    $noMeja === '' ||
                    $sesi === '' ||
                    $tanggalExcel === '' ||
                    $jamExcel === '' ||
                    $pendamping === ''
                ) {

                    $dilewati++;


                    $barisError[] =
                        "Baris {$nomorBarisExcel}: data tidak lengkap.";


                    continue;
                }


                /*
                 * =============================================
                 * KODE PT
                 * =============================================
                 *
                 * Contoh:
                 * 031015
                 *
                 * Jika Excel membacanya sebagai angka:
                 * 31015
                 *
                 * Maka akan dikembalikan menjadi:
                 * 031015
                 */

                $kodePt =
                    preg_replace(
                        '/\D/',
                        '',
                        (string) $kodePt
                    );


                $kodePt =
                    str_pad(
                        $kodePt,
                        6,
                        '0',
                        STR_PAD_LEFT
                    );


                /*
                 * =============================================
                 * NO MEJA
                 * =============================================
                 */

                if (
                    is_numeric($noMeja)
                ) {

                    $noMeja =
                        (int) $noMeja;
                }


                /*
                 * =============================================
                 * PARSE TANGGAL
                 * =============================================
                 */

                try {

                    $tanggal =
                        $this->parseTanggal(
                            $tanggalExcel
                        );

                } catch (Throwable $e) {

                    $dilewati++;


                    $barisError[] =
                        "Baris {$nomorBarisExcel}: " .
                        "tanggal '{$tanggalExcel}' tidak dapat dibaca.";


                    continue;
                }


                /*
                 * =============================================
                 * PARSE JAM
                 * =============================================
                 */

                try {

                    [
                        $jamMulai,
                        $jamSelesai
                    ] =
                        $this->parseJam(
                            $jamExcel
                        );

                } catch (Throwable $e) {

                    $dilewati++;


                    $barisError[] =
                        "Baris {$nomorBarisExcel}: " .
                        "format jam '{$jamExcel}' tidak dapat dibaca.";


                    continue;
                }


                /*
                 * =============================================
                 * CEK DUPLIKAT
                 * =============================================
                 *
                 * Tidak menggunakan kolom "No" karena database
                 * memang tidak mempunyai kolom nomor Excel.
                 */

                $sudahAda =
                    Master::where(
                        'kode_pt',
                        $kodePt
                    )
                    ->where(
                        'nama_pt',
                        $namaPt
                    )
                    ->where(
                        'nama_faswil',
                        $namaFaswil
                    )
                    ->where(
                        'no_meja',
                        $noMeja
                    )
                    ->where(
                        'sesi',
                        $sesi
                    )
                    ->where(
                        'tanggal',
                        $tanggal
                    )
                    ->where(
                        'jam_mulai',
                        $jamMulai
                    )
                    ->where(
                        'jam_selesai',
                        $jamSelesai
                    )
                    ->where(
                        'pendamping',
                        $pendamping
                    )
                    ->exists();


                if ($sudahAda) {

                    $dilewati++;


                    $barisError[] =
                        "Baris {$nomorBarisExcel}: " .
                        "data sudah ada di database.";


                    continue;
                }


                /*
                 * =============================================
                 * SIMPAN KE DATABASE
                 * =============================================
                 */

                $master =
                    new Master();


                $master->kode_pt =
                    $kodePt;


                $master->nama_pt =
                    $namaPt;


                $master->nama_faswil =
                    $namaFaswil;


                $master->no_meja =
                    $noMeja;


                $master->sesi =
                    $sesi;


                $master->tanggal =
                    $tanggal;


                $master->jam_mulai =
                    $jamMulai;


                $master->jam_selesai =
                    $jamSelesai;


                $master->pendamping =
                    $pendamping;


                $master->save();


                $berhasil++;


                /*
                 * LOG SETIAP DATA BERHASIL
                 */

                Log::info(
                    'MASTER UPLOAD - DATA DISIMPAN',
                    [
                        'baris_excel' =>
                            $nomorBarisExcel,

                        'kode_pt' =>
                            $kodePt,

                        'nama_pt' =>
                            $namaPt,

                        'nama_faswil' =>
                            $namaFaswil,

                        'no_meja' =>
                            $noMeja,

                        'sesi' =>
                            $sesi,

                        'tanggal' =>
                            $tanggal,

                        'jam_mulai' =>
                            $jamMulai,

                        'jam_selesai' =>
                            $jamSelesai,

                        'pendamping' =>
                            $pendamping,
                    ]
                );
            }


            /*
             * =================================================
             * 15. COMMIT
             * =================================================
             */

            DB::commit();


            /*
             * =================================================
             * 16. LOG HASIL AKHIR
             * =================================================
             */

            Log::info(
                'MASTER UPLOAD - SELESAI',
                [
                    'berhasil' =>
                        $berhasil,

                    'dilewati' =>
                        $dilewati,

                    'baris_error' =>
                        $barisError,
                ]
            );


            /*
             * =================================================
             * 17. PESAN BERHASIL
             * =================================================
             */

            $pesan =
                "Upload berhasil. " .
                "{$berhasil} data berhasil disimpan.";


            if (
                $dilewati > 0
            ) {

                $pesan .=
                    " {$dilewati} data dilewati.";
            }


            return redirect()
                ->route(
                    'admin.master.index'
                )
                ->with(
                    'success',
                    $pesan
                );


        } catch (Throwable $e) {

            /*
             * =================================================
             * ROLLBACK
             * =================================================
             */

            if (
                DB::transactionLevel() > 0
            ) {

                DB::rollBack();
            }


            /*
             * =================================================
             * LOG ERROR
             * =================================================
             */

            Log::error(
                'MASTER UPLOAD - ERROR',
                [
                    'message' =>
                        $e->getMessage(),

                    'file' =>
                        $e->getFile(),

                    'line' =>
                        $e->getLine(),

                    'trace' =>
                        $e->getTraceAsString(),
                ]
            );


            return back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal upload Excel: ' .
                    $e->getMessage()
                );
        }
    }


    /**
     * =========================================================
     * NORMALISASI HEADER
     * =========================================================
     */
    private function normalisasiHeader($value)
    {
        if ($value === null) {

            return '';
        }


        $value =
            (string) $value;


        /*
         * Hapus BOM
         */
        $value =
            preg_replace(
                '/^\xEF\xBB\xBF/',
                '',
                $value
            );


        /*
         * NBSP
         */
        $value =
            str_replace(
                [
                    "\xC2\xA0",
                    "\xA0",
                ],
                ' ',
                $value
            );


        /*
         * Karakter tersembunyi
         */
        $value =
            preg_replace(
                '/[\x00-\x1F\x7F]/u',
                ' ',
                $value
            );


        /*
         * Trim
         */
        $value =
            trim($value);


        /*
         * Banyak spasi menjadi satu
         */
        $value =
            preg_replace(
                '/\s+/u',
                ' ',
                $value
            );


        /*
         * Lowercase
         */
        $value =
            strtolower($value);


        return $value;
    }


    /**
     * =========================================================
     * NORMALISASI HEADER UNTUK PERBANDINGAN
     * =========================================================
     *
     * Contoh:
     *
     * "Kode PT"
     * " Kode PT "
     * "KODE PT"
     * "Kode  PT"
     *
     * semuanya akan dianggap sama.
     */
    private function headerKey($value)
    {
        $value =
            $this->normalisasiHeader(
                $value
            );


        /*
         * Hanya sisakan huruf dan angka
         *
         * kode pt
         * kodept
         *
         * menjadi:
         *
         * kodept
         */

        return preg_replace(
            '/[^a-z0-9]/',
            '',
            $value
        );
    }


    /**
     * =========================================================
     * CEK HEADER COCOK
     * =========================================================
     */
    private function headerCocok(
        $header,
        array $aliases
    ) {

        $headerKey =
            $this->headerKey(
                $header
            );


        foreach (
            $aliases as $alias
        ) {

            if (
                $headerKey ===
                $this->headerKey(
                    $alias
                )
            ) {

                return true;
            }
        }


        return false;
    }


    /**
     * =========================================================
     * CARI INDEX KOLOM
     * =========================================================
     */
    private function cariKolom(
        array $header,
        array $aliases
    ) {

        foreach (
            $header as $index => $namaKolom
        ) {

            if (
                $this->headerCocok(
                    $namaKolom,
                    $aliases
                )
            ) {

                return $index;
            }
        }


        return false;
    }


    /**
     * =========================================================
     * CLEAN NILAI EXCEL
     * =========================================================
     */
    private function cleanExcelValue($value)
    {
        if ($value === null) {

            return '';
        }


        /*
         * Jika object datetime
         */
        if (
            is_object($value) &&
            method_exists(
                $value,
                'format'
            )
        ) {

            return $value->format(
                'Y-m-d H:i:s'
            );
        }


        $value =
            (string) $value;


        /*
         * NBSP
         */
        $value =
            str_replace(
                [
                    "\xC2\xA0",
                    "\xA0",
                ],
                ' ',
                $value
            );


        /*
         * Bersihkan whitespace
         */
        $value =
            preg_replace(
                '/\s+/u',
                ' ',
                trim($value)
            );


        return $value;
    }


    /**
     * =========================================================
     * PARSE TANGGAL
     * =========================================================
     */
    private function parseTanggal($value)
    {
        /*
         * Object datetime
         */
        if (
            is_object($value) &&
            method_exists(
                $value,
                'format'
            )
        ) {

            return Carbon::instance(
                $value
            )->format(
                'Y-m-d'
            );
        }


        /*
         * Excel serial date
         */
        if (
            is_numeric($value) &&
            (float) $value > 30000
        ) {

            $date =
                ExcelDate::excelToDateTimeObject(
                    $value
                );


            return Carbon::instance(
                $date
            )->format(
                'Y-m-d'
            );
        }


        $value =
            trim(
                (string) $value
            );


        /*
         * YYYY-MM-DD
         */
        if (
            preg_match(
                '/^\d{4}-\d{1,2}-\d{1,2}$/',
                $value
            )
        ) {

            return Carbon::parse(
                $value
            )->format(
                'Y-m-d'
            );
        }


        /*
         * DD-MM-YYYY
         */
        if (
            preg_match(
                '/^\d{1,2}-\d{1,2}-\d{4}$/',
                $value
            )
        ) {

            return Carbon::createFromFormat(
                'd-m-Y',
                $value
            )->format(
                'Y-m-d'
            );
        }


        /*
         * DD/MM/YYYY
         */
        if (
            preg_match(
                '/^\d{1,2}\/\d{1,2}\/\d{4}$/',
                $value
            )
        ) {

            return Carbon::createFromFormat(
                'd/m/Y',
                $value
            )->format(
                'Y-m-d'
            );
        }


        /*
         * Nama bulan Indonesia
         */
        $bulanIndonesia = [

            'januari' =>
                '01',

            'februari' =>
                '02',

            'maret' =>
                '03',

            'april' =>
                '04',

            'mei' =>
                '05',

            'juni' =>
                '06',

            'juli' =>
                '07',

            'agustus' =>
                '08',

            'september' =>
                '09',

            'oktober' =>
                '10',

            'november' =>
                '11',

            'desember' =>
                '12',
        ];


        /*
         * Pisahkan:
         *
         * 14 Oktober 2026
         */
        $parts =
            preg_split(
                '/\s+/',
                $value
            );


        if (
            count($parts) === 3
        ) {

            $hari =
                str_pad(
                    $parts[0],
                    2,
                    '0',
                    STR_PAD_LEFT
                );


            $bulanText =
                strtolower(
                    $parts[1]
                );


            $tahun =
                $parts[2];


            if (
                isset(
                    $bulanIndonesia[
                        $bulanText
                    ]
                )
            ) {

                return Carbon::createFromFormat(
                    'Y-m-d',
                    $tahun .
                    '-' .
                    $bulanIndonesia[
                        $bulanText
                    ] .
                    '-' .
                    $hari
                )->format(
                    'Y-m-d'
                );
            }
        }


        /*
         * Fallback Carbon
         */
        return Carbon::parse(
            $value
        )->format(
            'Y-m-d'
        );
    }


    /**
     * =========================================================
     * PARSE JAM
     * =========================================================
     *
     * Contoh:
     *
     * 08.00 - 10.00
     *
     * menjadi:
     *
     * jam_mulai   = 08:00:00
     * jam_selesai = 10:00:00
     */
    private function parseJam($value)
    {
        /*
         * Jika object datetime
         */
        if (
            is_object($value) &&
            method_exists(
                $value,
                'format'
            )
        ) {

            $jam =
                $value->format(
                    'H:i:s'
                );


            return [
                $jam,
                $jam,
            ];
        }


        /*
         * Excel time serial
         */
        if (
            is_numeric($value) &&
            (float) $value >= 0 &&
            (float) $value < 1
        ) {

            $seconds =
                (int) round(
                    ((float) $value) *
                    86400
                );


            $jam =
                gmdate(
                    'H:i:s',
                    $seconds
                );


            return [
                $jam,
                $jam,
            ];
        }


        $value =
            trim(
                (string) $value
            );


        /*
         * Normalisasi dash
         */
        $value =
            str_replace(
                [
                    '–',
                    '—',
                    '−',
                ],
                '-',
                $value
            );


        /*
         * Normalisasi titik
         */
        $value =
            str_replace(
                '.',
                ':',
                $value
            );


        /*
         * Hapus spasi berlebihan
         */
        $value =
            preg_replace(
                '/\s+/u',
                ' ',
                $value
            );


        /*
         * Pisahkan jam
         */
        $parts =
            preg_split(
                '/\s*-\s*/',
                $value
            );


        if (
            count($parts) !== 2
        ) {

            throw new \Exception(
                "Format jam harus seperti 08.00 - 10.00"
            );
        }


        $jamMulai =
            $this->normalisasiJam(
                $parts[0]
            );


        $jamSelesai =
            $this->normalisasiJam(
                $parts[1]
            );


        return [
            $jamMulai,
            $jamSelesai,
        ];
    }


    /**
     * =========================================================
     * NORMALISASI JAM
     * =========================================================
     */
    private function normalisasiJam($jam)
    {
        $jam =
            trim($jam);


        /*
         * 08.00 -> 08:00
         */
        $jam =
            str_replace(
                '.',
                ':',
                $jam
            );


        /*
         * Hilangkan spasi
         */
        $jam =
            preg_replace(
                '/\s+/u',
                '',
                $jam
            );


        /*
         * HH:MM
         */
        if (
            preg_match(
                '/^(\d{1,2}):(\d{2})$/',
                $jam,
                $matches
            )
        ) {

            $hour =
                (int) $matches[1];

            $minute =
                (int) $matches[2];


            if (
                $hour > 23 ||
                $minute > 59
            ) {

                throw new \Exception(
                    "Jam tidak valid: {$jam}"
                );
            }


            return sprintf(
                '%02d:%02d:00',
                $hour,
                $minute
            );
        }


        /*
         * HH:MM:SS
         */
        if (
            preg_match(
                '/^(\d{1,2}):(\d{2}):(\d{2})$/',
                $jam,
                $matches
            )
        ) {

            $hour =
                (int) $matches[1];

            $minute =
                (int) $matches[2];

            $second =
                (int) $matches[3];


            if (
                $hour > 23 ||
                $minute > 59 ||
                $second > 59
            ) {

                throw new \Exception(
                    "Jam tidak valid: {$jam}"
                );
            }


            return sprintf(
                '%02d:%02d:%02d',
                $hour,
                $minute,
                $second
            );
        }


        throw new \Exception(
            "Format jam '{$jam}' tidak valid."
        );
    }


    /**
     * =========================================================
     * HAPUS SATU DATA
     * =========================================================
     */
    public function destroy($id)
    {
        $master =
            Master::findOrFail(
                $id
            );


        $master->delete();


        return redirect()
            ->route(
                'admin.master.index'
            )
            ->with(
                'success',
                'Data master berhasil dihapus.'
            );
    }


    /**
     * =========================================================
     * HAPUS SEMUA DATA
     * =========================================================
     */
    public function destroyAll()
{
    try {

        DB::beginTransaction();

        /*
        |--------------------------------------------------------------------------
        | 1. HAPUS SEMUA TIKET
        |--------------------------------------------------------------------------
        */

        Tiket::query()->delete();


        /*
        |--------------------------------------------------------------------------
        | 2. HAPUS SEMUA REGISTRASI
        |--------------------------------------------------------------------------
        */

        Registrasi::query()->delete();


        /*
        |--------------------------------------------------------------------------
        | 3. HAPUS SEMUA MASTER
        |--------------------------------------------------------------------------
        */

        Master::query()->delete();


        /*
        |--------------------------------------------------------------------------
        | COMMIT
        |--------------------------------------------------------------------------
        */

        DB::commit();

        return redirect()
            ->route('admin.master.index')
            ->with(
                'success',
                'Semua data master berhasil dihapus.'
            );

    } catch (\Throwable $e) {

        DB::rollBack();

        return redirect()
            ->route('admin.master.index')
            ->with(
                'error',
                'Gagal menghapus semua data master: ' .
                $e->getMessage()
            );
    }
}
}