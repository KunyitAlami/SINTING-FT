<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'nama' => 'Admin Komisi Pemilihan Umum FT ULM',
                'NIM' => 'adminkpu',
                'password' => Hash::make('adminkpu123'),
                'role' => 'admin_kpu',
            ],
            [
                'nama' => 'Ghani Mudzakir',
                'NIM' => '2310817110011',
                'password' => Hash::make('2310817110011'),
                'role' => 'mahasiswa',
            ],
            [
                'nama' => 'Noviana Nur Aisyah',
                'NIM' => '2310817120005',
                'password' => Hash::make('2310817120005'),
                'role' => 'mahasiswa',
            ],
            [
                'nama' => 'Randy Febrian',
                'NIM' => '2310817110013',
                'password' => Hash::make('2310817110013'),
                'role' => 'mahasiswa',
            ],
            [
                'nama' => 'Siti Ratna Dwinta Sari',
                'NIM' => '2310817120002',
                'password' => Hash::make('2310817120002'),
                'role' => 'mahasiswa',
            ],
        ]);
    }
}