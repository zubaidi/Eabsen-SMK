<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruMapelKelas;
use App\Models\User;
use App\Models\Role;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class GuruMapelKelasController extends Controller
{
    public function index()
    {
        // Mengambil data penugasan beserta nama guru, kelas, dan mapelnya
        $penugasans = GuruMapelKelas::with(['guru', 'kelas', 'mapel'])->get();
        return view('admin.penugasan.index', compact('penugasans'));
    }

    public function create()
    {
        // Ambil data untuk dropdown
        $roleGuru = Role::where('nama_role', 'guru')->first();
        $gurus = User::where('role_id', $roleGuru->id)->get();
        
        $kelases = Kelas::all();
        $mapels = MataPelajaran::all();

        return view('admin.penugasan.create', compact('gurus', 'kelases', 'mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
        ]);

        // Mencegah input data ganda (Duplikasi)
        $cekDuplikat = GuruMapelKelas::where('guru_id', $request->guru_id)
            ->where('kelas_id', $request->kelas_id)
            ->where('mapel_id', $request->mapel_id)
            ->first();

        if ($cekDuplikat) {
            return back()->withErrors(['Data penugasan ini sudah ada sebelumnya!'])->withInput();
        }

        GuruMapelKelas::create($request->all());
        return redirect()->route('admin.penugasan.index')->with('success', 'Penugasan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penugasan = GuruMapelKelas::findOrFail($id);
        
        // Ambil data untuk dropdown
        $roleGuru = Role::where('nama_role', 'guru')->first();
        $gurus = User::where('role_id', $roleGuru->id)->get();
        
        $kelases = Kelas::all();
        $mapels = MataPelajaran::all();

        return view('admin.penugasan.edit', compact('penugasan', 'gurus', 'kelases', 'mapels'));
    }

    public function update(Request $request, $id)
    {
        $penugasan = GuruMapelKelas::findOrFail($id);

        $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
        ]);

        // Mencegah duplikasi, TAPI mengecualikan ID penugasan yang sedang diedit
        $cekDuplikat = GuruMapelKelas::where('guru_id', $request->guru_id)
            ->where('kelas_id', $request->kelas_id)
            ->where('mapel_id', $request->mapel_id)
            ->where('id', '!=', $id) // Abaikan baris ini sendiri
            ->first();

        if ($cekDuplikat) {
            return back()->withErrors(['Data penugasan ini sudah ada sebelumnya!'])->withInput();
        }

        $penugasan->update($request->all());
        return redirect()->route('admin.penugasan.index')->with('success', 'Penugasan berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        GuruMapelKelas::findOrFail($id)->delete();
        return redirect()->route('admin.penugasan.index')->with('success', 'Penugasan berhasil dihapus.');
    }
}