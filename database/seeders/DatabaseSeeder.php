<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Data Role
        $roles = [
            ['nama_role' => 'admin', 'deskripsi' => 'Administrator Sistem'],
            ['nama_role' => 'guru', 'deskripsi' => 'Guru Mata Pelajaran / Wali Kelas'],
            ['nama_role' => 'bk', 'deskripsi' => 'Guru Bimbingan Konseling'],
            ['nama_role' => 'waka_kesiswaan', 'deskripsi' => 'Wakil Kepala Sekolah Bidang Kesiswaan'],
            ['nama_role' => 'kepala_sekolah', 'deskripsi' => 'Kepala Sekolah'],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }

        // 2. Buat Data Jurusan[cite: 8]
        $jurusans = [
            ['kode_jurusan' => 'RPL', 'nama_jurusan' => 'Rekayasa Perangkat Lunak'],
            ['kode_jurusan' => 'TKJ', 'nama_jurusan' => 'Teknik Komputer dan Jaringan'],
            ['kode_jurusan' => 'TKR', 'nama_jurusan' => 'Teknik Kendaraan Ringan'],
            ['kode_jurusan' => 'TSM', 'nama_jurusan' => 'Teknik Sepeda Motor'],
            ['kode_jurusan' => 'BUS', 'nama_jurusan' => 'Tata Busana'],
        ];
        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }

        // 3. Buat Akun Pengguna (Dummy) untuk Testing Login[cite: 8]
        $password = Hash::make('password123'); // Password default untuk semua akun

        User::insert([
            [
                'role_id' => 1, // Admin
                'nip_nik' => '111111',
                'nama' => 'Admin Sekolah',
                'email' => 'admin@smksa.com',
                'password' => $password,
                'jurusan_id' => null,
                'is_koordinator_bk' => false,
                'status_aktif' => true,
            ],
            [
                'role_id' => 2, // Guru
                'nip_nik' => '222222',
                'nama' => 'Bapak Bachtiar, S.Kom',
                'email' => 'guru@smksa.com',
                'password' => $password,
                'jurusan_id' => 1, // RPL
                'is_koordinator_bk' => false,
                'status_aktif' => true,
            ],
            [
                'role_id' => 3, // BK
                'nip_nik' => '333333',
                'nama' => 'Ibu Siti, S.Pd',
                'email' => 'bk@smksa.com',
                'password' => $password,
                'jurusan_id' => null,
                'is_koordinator_bk' => true, // Menjabat sebagai Koordinator BK[cite: 8]
                'status_aktif' => true,
            ],
            [
                'role_id' => 4, // Waka Kesiswaan
                'nip_nik' => '444444',
                'nama' => 'Drs. Sudirman',
                'email' => 'waka@smksa.com',
                'password' => $password,
                'jurusan_id' => null,
                'is_koordinator_bk' => false,
                'status_aktif' => true,
            ],
            [
                'role_id' => 5, // Kepala Sekolah
                'nip_nik' => '555555',
                'nama' => 'Bapak Kepala Sekolah, M.Pd',
                'email' => 'kepsek@smksa.com',
                'password' => $password,
                'jurusan_id' => null,
                'is_koordinator_bk' => false,
                'status_aktif' => true,
            ],
        ]);
    }
}       