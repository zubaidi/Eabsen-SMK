<?php

namespace App\Http\Controllers\Admin;

use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        // Mencari ID untuk role 'guru' dari tabel roles
        $roleGuru = Role::where('nama_role', 'guru')->first();
        
        // Menampilkan data users yang role-nya adalah guru
        $gurus = User::where('role_id', $roleGuru->id)->get();
        
        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip_nik' => 'required|unique:users,nip_nik',
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $roleGuru = Role::where('nama_role', 'guru')->first();

        // Menyimpan data ke tabel users
        User::create([
            'role_id' => $roleGuru->id,
            'nip_nik' => $request->nip_nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'status_aktif' => 1 // Status default aktif
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Data Akun Guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $guru = User::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = User::findOrFail($id);

        $request->validate([
            'nip_nik' => 'required|unique:users,nip_nik,' . $guru->id,
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $guru->id,
            'password' => 'nullable|min:6' // Boleh kosong jika tidak ingin ganti password
        ]);

        $data = [
            'nip_nik' => $request->nip_nik,
            'nama' => $request->nama,
            'email' => $request->email,
        ];

        // Jika form password diisi, maka enkripsi dan masukkan ke data update
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data Akun Guru berhasil diperbarui.');
    }
    public function downloadTemplate()
    {
        $filePath = public_path('template/Template_Import_Guru.xlsx');
        
        // Cek apakah file fisik ada (biar tidak error kalau lupa ditaruh)
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return back()->with('error', 'File template belum tersedia di server.');
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            $file = $request->file('file');
            $rows = SimpleExcelReader::create($file->getRealPath(), $file->getClientOriginalExtension())->getRows();
            
            // Cari ID untuk role 'guru' supaya otomatis ditugaskan
            $roleGuru = Role::where('nama_role', 'guru')->first();

            if (!$roleGuru) {
                return back()->with('error', 'Role Guru belum ada di Master Data Role!');
            }

            $rows->each(function(array $row) use ($roleGuru) {
                if (!empty($row['email'])) {
                    // Cek email, kalau sudah ada diupdate, kalau belum dibuat baru
                    \App\Models\User::updateOrCreate(
                        ['email' => $row['email']],
                        [
                            'nip_nik' => $row['nip_nik'],
                            'nama' => $row['nama'],
                            'password' => Hash::make($row['password']),
                            'role_id' => $roleGuru->id
                        ]
                    );
                }
            });

            return redirect()->route('admin.guru.index')->with('success', 'Ratusan data Guru sukses mendarat!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membaca file: ' . $e->getMessage());
        }
    }
    public function destroy(User $guru)
    {
        $guru->delete();
        return redirect()->route('admin.guru.index')->with('success', 'Data Akun Guru berhasil dihapus.');
    }
}