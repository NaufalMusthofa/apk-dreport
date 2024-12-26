<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeknisiController extends Controller
{
    public function index()
    {
        return view('teknisi.dashboard');
    }


    // ROUTE TUGAS TEKNISI
    public function tugas()
    {
        $tugas = Tugas::with('user', 'pekerjaan')->get();
        // Pastikan bahwa tanggal disalin ke format Carbon jika diperlukan
        $tugas->each(function($item) {
            $item->tanggal_mulai = \Carbon\Carbon::parse($item->tanggal_mulai);
            $item->tanggal_selesai = \Carbon\Carbon::parse($item->tanggal_selesai);
        });

        $users = User::all(); // Ambil semua user untuk dropdown
        $pekerjaans = Pekerjaan::all(); // Ambil semua pekerjaan untuk dropdown
        return view('teknisi.tugas', compact('tugas', 'users', 'pekerjaans'));
    }

    public function createTugas()
    {
        $user = Auth::user();

        // Pekerjaan yang belum dipilih pengguna lain
        $pekerjaan_tersedia = Pekerjaan::whereDoesntHave('tugas')->get();

        return view('teknisi.tugas-create', compact('user', 'pekerjaan_tersedia'));
    }

    public function storeTugas(Request $request)
    {
        $request->validate([
            'id_pekerjaan' => 'required|exists:pekerjaans,id', // Sesuaikan dengan nama tabel
            'status' => 'required|in:pending,in-progress,completed',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
        ]);

        Tugas::create([
            'id_user' => Auth::id(),
            'id_pekerjaan' => $request->id_pekerjaan,
            'status' => $request->status,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('teknisi.tugas')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function editTugas($id)
    {
        $tugas = Tugas::findOrFail($id);

        // Cek jika tugas ini milik pengguna yang sedang login
        if ($tugas->id_user != Auth::id()) {
            return redirect()->route('teknisi.tugas.tugas')->with('error', 'Anda tidak memiliki izin untuk mengedit tugas ini.');
        }

        // Pekerjaan yang belum dipilih pengguna lain + pekerjaan yang sedang digunakan oleh tugas ini
        $pekerjaan_tersedia = Pekerjaan::whereDoesntHave('tugas', function ($query) use ($tugas) {
            $query->where('id', '!=', $tugas->id);
        })->orWhere('id', $tugas->id_pekerjaan)->get();

        return view('teknisi.tugas-edit', compact('tugas', 'pekerjaan_tersedia'));
    }

    public function updateTugas(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);

        // Cek jika tugas ini milik pengguna yang sedang login
        if ($tugas->id_user != Auth::id()) {
            return redirect()->route('teknisi.tugas.tugas')->with('error', 'Anda tidak memiliki izin untuk memperbarui tugas ini.');
        }

        $request->validate([
            'id_pekerjaan' => 'required|exists:pekerjaans,id',
            'status' => 'required|in:pending,in-progress,completed',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
        ]);

        $tugas->update([
            'id_pekerjaan' => $request->id_pekerjaan,
            'status' => $request->status,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('teknisi.tugas')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroyTugas($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();

        // Reset auto increment setelah delete
        DB::statement('ALTER TABLE pekerjaans AUTO_INCREMENT = 1');

        return redirect()->route('teknisi.tugas')->with('success', 'Tugas berhasil dihapus.');
    }
}
