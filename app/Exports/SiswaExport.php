<?php

namespace App\Exports;

use App\Models\Siswa;

class SiswaExport
{
    public static function getData()
    {
        return Siswa::with('kelas')
            ->get()
            ->map(function ($siswa) {
                return [
                    'NIK' => $siswa->nik,
                    'Nama' => $siswa->nama,
                    'Tempat Lahir' => $siswa->tempat_lahir,
                    'Tanggal Lahir' => $siswa->tanggal_lahir,
                    'Jenis Kelamin' => $siswa->jenis_kelamin,
                    'Agama' => ucfirst($siswa->agama),
                    'No Telepon' => $siswa->no_telp,
                    'Nama Ortu' => $siswa->nama_ortu,
                    'Pekerjaan Ortu' => $siswa->pekerjaan_ortu,
                    'Alamat' => $siswa->alamat,
                    'Angkatan' => 'Batch ' . $siswa->angkatan,
                    'Status' => ucfirst($siswa->status),
                    'Kelas' => optional($siswa->kelas)->nama_kelas ?? '-',
                ];
            })->toArray();
    }
}