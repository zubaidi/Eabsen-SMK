<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BkKelas;
use App\Models\User;
use App\Models\Role;
use App\Models\Kelas;
use Illuminate\Http\Request;

class BkKelasController extends Controller
{
    public function index()
    {
        $penugasans = BkKelas::with(['bkUser', 'kelas'])->get();
        return view('admin.penugasan-bk.index', compact('penugasans'));
    }

    public function create()
    {
        // Ambil ID role BK
        $roleBk = Role::where('nama_role', 'bk')->first();
        
        // Ambil daftar user yang rolenya BK
        $guruBks = User::where('role_id', $roleBk->id)->get();
        $kelases = Kelas::all();

        return view('admin.penugasan-bk.create', compact('guruBks', 'kelases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bk_user_id' => 'required',
            'kelas_id' => 'required',
        ]);

        // Cek duplikasi: Jangan sampai 1 guru BK ditugaskan ke kelas yang sama 2 kali
        $cekDuplikat = BkKelas::where('bk_user_id', $request->bk_user_id)
            ->where('kelas_id', $request->kelas_id)
            ->first();

        if ($cekDuplikat) {
            return back()->withErrors(['Guru BK ini sudah ditugaskan ke kelas tersebut!'])->withInput();
        }

        BkKelas::create($request->all());
        return redirect()->route('admin.penugasan-bk.index')->with('success', 'Penugasan BK berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        BkKelas::findOrFail($id)->delete();
        return redirect()->route('admin.penugasan-bk.index')->with('success', 'Penugasan BK berhasil dicabut.');
    }
}