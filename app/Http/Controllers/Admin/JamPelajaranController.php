<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JamPelajaran;
use Illuminate\Http\Request;

class JamPelajaranController extends Controller
{
    public function index()
    {
        // Menampilkan data urut dari jam ke-1 dan seterusnya
        $jams = JamPelajaran::orderBy('jam_ke', 'asc')->get();
        return view('admin.jam-pelajaran.index', compact('jams'));
    }

    public function create()
    {
        return view('admin.jam-pelajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jam_ke' => 'required|integer|unique:jam_pelajarans,jam_ke',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        JamPelajaran::create($request->all());
        return redirect()->route('admin.jam-pelajaran.index')->with('success', 'Jam pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jam = JamPelajaran::findOrFail($id);
        return view('admin.jam-pelajaran.edit', compact('jam'));
    }

    public function update(Request $request, $id)
    {
        $jam = JamPelajaran::findOrFail($id);

        $request->validate([
            'jam_ke' => 'required|integer|unique:jam_pelajarans,jam_ke,' . $jam->id,
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        $jam->update($request->all());
        return redirect()->route('admin.jam-pelajaran.index')->with('success', 'Jam pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        JamPelajaran::findOrFail($id)->delete();
        return redirect()->route('admin.jam-pelajaran.index')->with('success', 'Jam pelajaran berhasil dihapus.');
    }
}