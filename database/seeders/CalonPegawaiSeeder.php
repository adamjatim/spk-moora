<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CalonPegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CalonPegawaiSeeder extends Seeder
{
    public function run()
    {
        // Data calon pegawai
        $calonPegawais = [
            [
                'filter' => 'true',
                'nama' => 'Farel Azka',
                'pendidikan' => 'S1',
                'pengalaman' => 1,
                'usia' => 26,
                'kesehatan' => 5,
                'nilai_test' => 80,
                'tahun_daftar' => 2024,
            ],
            [
                'filter' => 'true',
                'nama' => 'Adrian Dewanto',
                'pendidikan' => 'S1',
                'pengalaman' => 2,
                'usia' => 28,
                'kesehatan' => 5,
                'nilai_test' => 64,
                'tahun_daftar' => 2024,
            ],
            [
                'filter' => 'true',
                'nama' => 'Basudewa K',
                'pendidikan' => 'S1',
                'pengalaman' => 3,
                'usia' => 24,
                'kesehatan' => 5,
                'nilai_test' => 57,
                'tahun_daftar' => 2024,
            ],
            [
                'filter' => 'true',
                'nama' => 'Dereel Zaidan',
                'pendidikan' => 'S1',
                'pengalaman' => 4,
                'usia' => 30,
                'kesehatan' => 5,
                'nilai_test' => 50,
                'tahun_daftar' => 2024,
            ],
            [
                'filter' => 'true',
                'nama' => 'Dito Alfareza',
                'pendidikan' => 'S1',
                'pengalaman' => 5,
                'usia' => 26,
                'kesehatan' => 5,
                'nilai_test' => 70,
                'tahun_daftar' => 2024,
            ],
            [
                'filter' => 'true',
                'nama' => 'Fadel Surya',
                'pendidikan' => 'S1',
                'pengalaman' => 2,
                'usia' => 24,
                'kesehatan' => 5,
                'nilai_test' => 72,
                'tahun_daftar' => 2024,
            ],
            [
                'filter' => 'true',
                'nama' => 'Farid',
                'pendidikan' => 'S1',
                'pengalaman' => 1,
                'usia' => 23,
                'kesehatan' => 5,
                'nilai_test' => 79,
                'tahun_daftar' => 2024,
            ],
            [
                'filter' => 'true',
                'nama' => 'Hafiz Aji',
                'pendidikan' => 'S1',
                'pengalaman' => 4,
                'usia' => 25,
                'kesehatan' => 5,
                'nilai_test' => 71,
                'tahun_daftar' => 2024,
            ],
            [
                'filter' => 'true',
                'nama' => 'M. Isnan',
                'pendidikan' => 'SMA',
                'pengalaman' => 3,
                'usia' => 25,
                'kesehatan' => 5,
                'nilai_test' => 63,
                'tahun_daftar' => 2024,
            ],
            [
                'filter' => 'true',
                'nama' => 'M. Akbar',
                'pendidikan' => 'SMK',
                'pengalaman' => 2,
                'usia' => 27,
                'kesehatan' => 5,
                'nilai_test' => 75,
                'tahun_daftar' => 2024,
            ],
        ];

        // Insert data ke tabel calon pegawai
        foreach ($calonPegawais as $pegawai) {
            CalonPegawai::create($pegawai);
        }
    }
}

