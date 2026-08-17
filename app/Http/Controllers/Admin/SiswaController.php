<?php

namespace App\Http\Controllers\Admin;

use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all();
        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        // Ambil data kelas untuk dropdown
        $kelases = Kelas::all();
        return view('admin.siswa.create', compact('kelases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis',
            'nama' => 'required',
            'kelas_id' => 'required',
            'jenis_kelamin' => 'required'
        ]);

        Siswa::create($request->all());
        return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        $kelases = Kelas::all();
        return view('admin.siswa.edit', compact('siswa', 'kelases'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
            'nama' => 'required',
            'kelas_id' => 'required',
            'jenis_kelamin' => 'required'
        ]);

        $siswa->update($request->all());
        return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa berhasil diperbarui.');
    }
    public function import(Request $request)
    {
     $request->validate([
         'file' => 'required|mimes:xlsx,xls,csv|max:2048'
     ]);

     try {
         $file = $request->file('file');

         // Membaca file secara otomatis pakai Spatie
         $rows = SimpleExcelReader::create($file->getRealPath(), $file->getClientOriginalExtension())->getRows();

         $rows->each(function(array $row) {
             // Cari kelas berdasarkan nama kelas di kolom Excel (misal: "X RPL 1")
             $kelas = Kelas::where('nama_kelas', trim($row['kelas']))->first();

             if ($kelas) {
                 // updateOrCreate: Kalau NIS sudah ada, data diperbarui. Kalau belum, buat siswa baru.
                 Siswa::updateOrCreate(
                     ['nis' => $row['nis']], 
                     [
                         'kelas_id'      => $kelas->id,
                         'nisn'          => $row['nisn'] ?? null,
                         'nama'          => $row['nama'],
                         'jenis_kelamin' => strtoupper(trim($row['jenis_kelamin'])),
                         'status'        => 'aktif',
                     ]
                 );
             }
         });

         return redirect()->route('admin.siswa.index')->with('success', 'Mantap! Data Siswa berhasil di-import.');
     } catch (\Exception $e) {
         return back()->with('error', 'Gagal membaca file: ' . $e->getMessage());
     }
    }
    public function downloadTemplate()
    {
        // Langsung bikin file beneran .xlsx biar rapi di Excel
        $writer = SimpleExcelWriter::streamDownload('Template_Import_Siswa.xlsx');

        // Bikin header (judul kolom)
        $writer->addRow([
            'nis' => 'nis',
            'nisn' => 'nisn',
            'nama' => 'nama',
            'kelas' => 'kelas',
            'jenis_kelamin' => 'jenis_kelamin'
        ]);

        // Kasih baris contoh isian
        $writer->addRow([
            'nis' => '12345',
            'nisn' => '0012345678',
            'nama' => 'Budi Santoso',
            'kelas' => 'X RPL 1', // Pastikan nama kelas sama persis dengan yang ada di database
            'jenis_kelamin' => 'L'
        ]);

        return $writer->toBrowser();
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa berhasil dihapus.');
    }

}