<?php

namespace App\Http\Controllers;

use App\Models\PengaturanAntrian;
use App\Models\PengaturanNotifikasi;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PENGATURAN ANTREAN
    |--------------------------------------------------------------------------
    */

    public function antrian()
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL PENGATURAN
        |--------------------------------------------------------------------------
        */

        $pengaturan = PengaturanAntrian::first();


        /*
        |--------------------------------------------------------------------------
        | JIKA BELUM ADA
        |--------------------------------------------------------------------------
        */

        if (!$pengaturan) {

            $pengaturan = PengaturanAntrian::create([

                /*
                 * Prefix tidak lagi menjadi sumber
                 * nomor tiket.
                 *
                 * Prefix otomatis berasal dari Faswil.
                 */
                'prefix_tiket'   => 'FAS',

                'panjang_nomor'  => 3,

                'reset_harian'   => 1,

                'durasi_layanan' => 15,

            ]);
        }


        return view(
            'pages.Pengaturan.antrian',
            compact('pengaturan')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENGATURAN ANTREAN
    |--------------------------------------------------------------------------
    */

    public function updateAntrian(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        |
        | PREFIX TIDAK LAGI DIMINTA.
        |
        | Karena prefix nomor tiket berasal dari Faswil.
        |
        */

        $request->validate(

            [

                'panjang_nomor' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:6',
                ],

                'durasi_layanan' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:120',
                ],

                'reset_harian' => [
                    'nullable',
                    'boolean',
                ],

            ],

            [

                'panjang_nomor.required' =>
                    'Panjang nomor wajib diisi.',

                'panjang_nomor.integer' =>
                    'Panjang nomor harus berupa angka.',

                'panjang_nomor.min' =>
                    'Panjang nomor minimal 1.',

                'panjang_nomor.max' =>
                    'Panjang nomor maksimal 6.',


                'durasi_layanan.required' =>
                    'Durasi layanan wajib diisi.',

                'durasi_layanan.integer' =>
                    'Durasi layanan harus berupa angka.',

                'durasi_layanan.min' =>
                    'Durasi layanan minimal 1 menit.',

                'durasi_layanan.max' =>
                    'Durasi layanan maksimal 120 menit.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | AMBIL PENGATURAN
        |--------------------------------------------------------------------------
        */

        $pengaturan =
            PengaturanAntrian::first();


        /*
        |--------------------------------------------------------------------------
        | JIKA BELUM ADA
        |--------------------------------------------------------------------------
        */

        if (!$pengaturan) {

            $pengaturan =
                new PengaturanAntrian();

        }


        /*
        |--------------------------------------------------------------------------
        | PREFIX DEFAULT
        |--------------------------------------------------------------------------
        |
        | Tetap disimpan agar kompatibel dengan database lama.
        |
        | Tetapi NILAI INI TIDAK DIGUNAKAN untuk membuat nomor tiket.
        |
        */

        if (
            empty($pengaturan->prefix_tiket)
        ) {

            $pengaturan->prefix_tiket = 'FAS';

        }


        /*
        |--------------------------------------------------------------------------
        | PANJANG NOMOR
        |--------------------------------------------------------------------------
        */

        $pengaturan->panjang_nomor =
            (int) $request->panjang_nomor;


        /*
        |--------------------------------------------------------------------------
        | DURASI LAYANAN
        |--------------------------------------------------------------------------
        */

        $pengaturan->durasi_layanan =
            (int) $request->durasi_layanan;


        /*
        |--------------------------------------------------------------------------
        | RESET HARIAN
        |--------------------------------------------------------------------------
        */

        $pengaturan->reset_harian =
            $request->boolean(
                'reset_harian'
            );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        $pengaturan->save();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'admin.pengaturan.antrian'
            )
            ->with(
                'success',
                'Pengaturan antrean berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | PENGATURAN NOTIFIKASI
    |--------------------------------------------------------------------------
    */

    public function notifikasi()
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL PENGATURAN
        |--------------------------------------------------------------------------
        */

        $pengaturan =
            PengaturanNotifikasi::first();


        /*
        |--------------------------------------------------------------------------
        | DEFAULT
        |--------------------------------------------------------------------------
        */

        if (!$pengaturan) {

            $pengaturan =
                PengaturanNotifikasi::create([

                    'notifikasi_tiket_baru' =>
                        1,

                    'perubahan_status_tiket' =>
                        1,

                    'panggilan_antrean' =>
                        1,

                    'antrean_selesai' =>
                        1,

                    'notifikasi_sistem' =>
                        1,

                    'suara_panggilan' =>
                        0,

                    'email' =>
                        0,

                ]);
        }


        return view(
            'pages.Pengaturan.notifikasi',
            compact('pengaturan')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENGATURAN NOTIFIKASI
    |--------------------------------------------------------------------------
    */

    public function updateNotifikasi(
        Request $request
    ) {

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'notifikasi_tiket_baru' =>
                'nullable|boolean',

            'perubahan_status_tiket' =>
                'nullable|boolean',

            'panggilan_antrean' =>
                'nullable|boolean',

            'antrean_selesai' =>
                'nullable|boolean',

            'notifikasi_sistem' =>
                'nullable|boolean',

            'suara_panggilan' =>
                'nullable|boolean',

            'email' =>
                'nullable|boolean',

        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL
        |--------------------------------------------------------------------------
        */

        $pengaturan =
            PengaturanNotifikasi::first();


        /*
        |--------------------------------------------------------------------------
        | JIKA BELUM ADA
        |--------------------------------------------------------------------------
        */

        if (!$pengaturan) {

            $pengaturan =
                new PengaturanNotifikasi();

        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        $pengaturan->notifikasi_tiket_baru =
            $request->boolean(
                'notifikasi_tiket_baru'
            );


        $pengaturan->perubahan_status_tiket =
            $request->boolean(
                'perubahan_status_tiket'
            );


        $pengaturan->panggilan_antrean =
            $request->boolean(
                'panggilan_antrean'
            );


        $pengaturan->antrean_selesai =
            $request->boolean(
                'antrean_selesai'
            );


        $pengaturan->notifikasi_sistem =
            $request->boolean(
                'notifikasi_sistem'
            );


        $pengaturan->suara_panggilan =
            $request->boolean(
                'suara_panggilan'
            );


        $pengaturan->email =
            $request->boolean(
                'email'
            );


        /*
        |--------------------------------------------------------------------------
        | DATABASE
        |--------------------------------------------------------------------------
        */

        $pengaturan->save();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'admin.pengaturan.notifikasi'
            )
            ->with(
                'success',
                'Pengaturan notifikasi berhasil disimpan.'
            );
    }
}