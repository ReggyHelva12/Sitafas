<?php

namespace App\Exports;

use App\Models\Registrasi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RegistrasiExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithStyles
{
    protected Request $request;

    protected int $rowNumber = 0;


    /**
     * =========================================================
     * CONSTRUCTOR
     * =========================================================
     */

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * =========================================================
     * AMBIL DATA REGISTRASI
     * =========================================================
     *
     * Struktur terbaru:
     *
     * masters
     *     ↓
     * registrasis.id_master
     *     ↓
     * tikets.id_registrasi
     *
     */

    public function collection()
    {
        $query = Registrasi::with([
            'master',
            'tiket'
        ]);


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($this->request->filled('search')) {

            $search = trim(
                $this->request->input('search')
            );


            $query->whereHas(
                'master',
                function ($q) use ($search) {

                    $q->where(
                        'nama_pt',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhere(
                        'kode_pt',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhere(
                        'nama_faswil',
                        'like',
                        '%' . $search . '%'
                    );

                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER FASWIL
        |--------------------------------------------------------------------------
        |
        | Karena Faswil sekarang berada di masters,
        | filter dilakukan melalui relasi master.
        |
        */

        if ($this->request->filled('faswil')) {

            $faswil = $this->request->input(
                'faswil'
            );


            $query->whereHas(
                'master',
                function ($q) use ($faswil) {

                    /*
                    |--------------------------------------------------------------------------
                    | Jika yang dikirim ID
                    |--------------------------------------------------------------------------
                    */

                    if (is_numeric($faswil)) {

                        $q->where(
                            'id_master',
                            $faswil
                        );

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Jika yang dikirim nama Faswil
                    |--------------------------------------------------------------------------
                    */

                    else {

                        $q->where(
                            'nama_faswil',
                            'like',
                            '%' . $faswil . '%'
                        );

                    }

                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if ($this->request->filled('status')) {

            $query->where(
                'status',
                $this->request->input('status')
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL ANTRIAN
        |--------------------------------------------------------------------------
        |
        | Jika halaman Kelola Registrasi mengirim
        | tanggal_antrian, export akan mengikuti tanggal
        | tiket.
        |
        */

        if ($this->request->filled('tanggal')) {

            $tanggal = $this->request->input(
                'tanggal'
            );


            $query->whereHas(
                'tiket',
                function ($q) use ($tanggal) {

                    $q->whereDate(
                        'tanggal_antrian',
                        $tanggal
                    );

                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | URUTKAN DATA
        |--------------------------------------------------------------------------
        */

        return $query

            ->orderBy(
                'tgl_registrasi',
                'desc'
            )

            ->get();
    }


    /**
     * =========================================================
     * HEADER EXCEL
     * =========================================================
     */

    public function headings(): array
    {
        return [

            'No',

            'Perguruan Tinggi',

            'Kode PT',

            'Nomor Tiket',

            'Sesi',

            'Tanggal Jadwal',

            'Jam Jadwal',

            'Faswil',

            'Meja',

            'Tanggal Antrean',

            'Tanggal Registrasi',

            'Kebutuhan',

            'Status',

        ];
    }


    /**
     * =========================================================
     * MAPPING DATA
     * =========================================================
     */

    public function map($registrasi): array
    {
        /*
        |--------------------------------------------------------------------------
        | MASTER
        |--------------------------------------------------------------------------
        */

        $master =
            $registrasi->master;


        /*
        |--------------------------------------------------------------------------
        | TIKET
        |--------------------------------------------------------------------------
        */

        $tiket =
            $registrasi->tiket;


        /*
        |--------------------------------------------------------------------------
        | NOMOR URUT
        |--------------------------------------------------------------------------
        */

        $this->rowNumber++;


        /*
        |--------------------------------------------------------------------------
        | TANGGAL JADWAL
        |--------------------------------------------------------------------------
        */

        $tanggalJadwal = '-';

        if (
            $master &&
            !empty($master->tanggal)
        ) {

            try {

                $tanggalJadwal =
                    \Carbon\Carbon::parse(
                        $master->tanggal
                    )->format('d-m-Y');

            } catch (\Exception $e) {

                $tanggalJadwal =
                    $master->tanggal;

            }
        }


        /*
        |--------------------------------------------------------------------------
        | JAM JADWAL
        |--------------------------------------------------------------------------
        */

        $jamJadwal = '-';


        if (
            $master &&
            !empty($master->jam_mulai) &&
            !empty($master->jam_selesai)
        ) {

            try {

                $jamMulai =
                    \Carbon\Carbon::parse(
                        $master->jam_mulai
                    )->format('H:i');


                $jamSelesai =
                    \Carbon\Carbon::parse(
                        $master->jam_selesai
                    )->format('H:i');


                $jamJadwal =
                    $jamMulai .
                    ' - ' .
                    $jamSelesai .
                    ' WIB';

            } catch (\Exception $e) {

                $jamJadwal =
                    $master->jam_mulai .
                    ' - ' .
                    $master->jam_selesai;

            }
        }


        /*
        |--------------------------------------------------------------------------
        | TANGGAL ANTREAN
        |--------------------------------------------------------------------------
        */

        $tanggalAntrian = '-';


        if (
            $tiket &&
            !empty($tiket->tanggal_antrian)
        ) {

            try {

                $tanggalAntrian =
                    \Carbon\Carbon::parse(
                        $tiket->tanggal_antrian
                    )->format('d-m-Y');

            } catch (\Exception $e) {

                $tanggalAntrian =
                    $tiket->tanggal_antrian;

            }
        }


        /*
        |--------------------------------------------------------------------------
        | TANGGAL REGISTRASI
        |--------------------------------------------------------------------------
        */

        $tanggalRegistrasi = '-';


        if (
            !empty(
                $registrasi->tgl_registrasi
            )
        ) {

            try {

                $tanggalRegistrasi =
                    \Carbon\Carbon::parse(
                        $registrasi->tgl_registrasi
                    )->format('d-m-Y H:i');

            } catch (\Exception $e) {

                $tanggalRegistrasi =
                    $registrasi->tgl_registrasi;

            }
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN BARIS
        |--------------------------------------------------------------------------
        */

        return [

            /*
            | No
            */

            $this->rowNumber,


            /*
            | Perguruan Tinggi
            */

            $master?->nama_pt
                ?? '-',


            /*
            | Kode PT
            */

            $master?->kode_pt
                ?? '-',


            /*
            | Nomor Tiket
            */

            $tiket?->nomor_tiket
                ?? '-',


            /*
            | Sesi
            */

            $master?->sesi
                ?? '-',


            /*
            | Tanggal Jadwal
            */

            $tanggalJadwal,


            /*
            | Jam Jadwal
            */

            $jamJadwal,


            /*
            | Faswil
            */

            $master?->nama_faswil
                ?? '-',


            /*
            | Meja
            */

            $master?->no_meja
                ?? '-',


            /*
            | Tanggal Antrean
            */

            $tanggalAntrian,


            /*
            | Tanggal Registrasi
            */

            $tanggalRegistrasi,


            /*
            | Kebutuhan
            */

            $registrasi->kebutuhan
                ?? '-',


            /*
            | Status
            */

            ucfirst(
                $registrasi->status
                ?? '-'
            ),

        ];
    }


    /**
     * =========================================================
     * STYLE EXCEL
     * =========================================================
     */

    public function styles(
        Worksheet $sheet
    ) {

        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        $sheet->getStyle(
            'A1:M1'
        )->applyFromArray([

            'font' => [

                'bold' => true,

                'color' => [
                    'rgb' => 'FFFFFF'
                ],

            ],

            'fill' => [

                'fillType' =>
                    \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,

                'startColor' => [
                    'rgb' => '0F5B8D'
                ],

            ],

            'alignment' => [

                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,

            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | BORDER
        |--------------------------------------------------------------------------
        */

        $highestRow =
            $sheet->getHighestRow();


        $sheet->getStyle(
            'A1:M' . $highestRow
        )->applyFromArray([

            'borders' => [

                'allBorders' => [

                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,

                    'color' => [

                        'rgb' => 'D9E2E8'

                    ],

                ],

            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | ALIGNMENT
        |--------------------------------------------------------------------------
        */

        $sheet->getStyle(
            'A1:M' . $highestRow
        )->getAlignment()
            ->setVertical(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            );


        /*
        |--------------------------------------------------------------------------
        | CENTER KOLOM
        |--------------------------------------------------------------------------
        */

        $sheet->getStyle(
            'A1:A' . $highestRow
        )->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );


        $sheet->getStyle(
            'C1:C' . $highestRow
        )->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );


        $sheet->getStyle(
            'D1:D' . $highestRow
        )->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );


        $sheet->getStyle(
            'E1:E' . $highestRow
        )->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );


        $sheet->getStyle(
            'I1:I' . $highestRow
        )->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );


        $sheet->getStyle(
            'J1:J' . $highestRow
        )->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );


        $sheet->getStyle(
            'M1:M' . $highestRow
        )->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );


        /*
        |--------------------------------------------------------------------------
        | FREEZE HEADER
        |--------------------------------------------------------------------------
        */

        $sheet->freezePane('A2');


        /*
        |--------------------------------------------------------------------------
        | AUTO FILTER
        |--------------------------------------------------------------------------
        */

        $sheet->setAutoFilter(
            'A1:M' . $highestRow
        );


        return [];
    }
}