<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role->nama_role; // Mengambil nama_role dari relasi

        // Melempar ke view dasbor masing-masing sesuai role
        switch ($role) {
            case 'admin':
                return view('admin.dashboard', compact('user'));
            case 'guru':
                return view('guru.dashboard', compact('user'));
            case 'bk':
                return view('bk.dashboard', compact('user'));
            case 'waka_kesiswaan':
                return view('waka.dashboard', compact('user'));
            case 'kepala_sekolah':
                return view('kepsek.dashboard', compact('user'));
                case 'bk':
                return view('bk.dashboard');
            case 'koordinator_bk': // <--- Tambahkan baris ini
                return view('koordinator-bk.dashboard'); // <--- Tambahkan baris ini
            default:
                abort(403, 'Role tidak dikenali.');
        }
    }
}
