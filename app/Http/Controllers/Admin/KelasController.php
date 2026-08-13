<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        // Mengambil semua data kelas
        $kelases = Kelas::all();
        return view('admin.kelas.index', compact('kelases'));
    }

    public function create()
    {
        // Ambil data jurusan dari database
        $jurusans = Jurusan::all();
        
        // Kirim data jurusan ke halaman form
        return view('admin.kelas.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        // Validasi agar nama kelas tidak boleh kosong dan tidak boleh dobel
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas'
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.unique' => 'Nama kelas ini sudah terdaftar.'
        ]);

        Kelas::create($request->all());
        
        return redirect()->route('admin.kelas.index')->with('success', 'Data Kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kelas)
    {
        $jurusans = Jurusan::all();
        return view('admin.kelas.edit', compact('kelas', 'jurusans'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        // Validasi update (mengecualikan ID kelas yang sedang diedit agar tidak terdeteksi dobel)
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas,' . $kelas->id
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.unique' => 'Nama kelas ini sudah terdaftar.'
        ]);

        $kelas->update($request->all());
        
        return redirect()->route('admin.kelas.index')->with('success', 'Data Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        
        return redirect()->route('admin.kelas.index')->with('success', 'Data Kelas berhasil dihapus.');
    }
}