<?php

namespace App\Http\Controllers;

use App\Models\Keperluan;
use App\Models\Lokasi;
use App\Models\Pekerjaan;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }



    // ROUTE LOKASI
    public function lokasi()
    {
        $lokasis = Lokasi::all(); // Ambil data lokasi yang sama dengan supervisor
        return view('admin.lokasi', compact('lokasis'));
    }

    // Menampilkan form untuk mengedit lokasi
    public function edit($id)
    {
        $lokasi = Lokasi::findOrFail($id); // Ambil data lokasi berdasarkan ID
        return view('admin.lokasi-edit', compact('lokasi')); // Kirim data lokasi ke view
    }

     // Menyimpan perubahan lokasi
     public function update(Request $request, $id)
     {
         $lokasi = Lokasi::findOrFail($id); // Ambil data lokasi berdasarkan ID
 
         // Validasi input
         $validated = $request->validate([
             'nama_lokasi' => 'required|string|max:255',
             'deskripsi' => 'nullable|string',
         ]);
 
         // Update data lokasi
         $lokasi->update($validated);
 
         // Redirect kembali ke halaman lokasi
         return redirect()->route('admin.lokasi')->with('success', 'Lokasi berhasil diupdate.');
     }

    // Fungsi destroy pada controller
    public function destroy($id)
    {
        $lokasi = Lokasi::find($id);
        if ($lokasi) {
            $lokasi->delete();

            // Reset auto increment setelah delete
            DB::statement('ALTER TABLE lokasis AUTO_INCREMENT = 1');

            return redirect()->route('admin.lokasi')->with('success', 'Lokasi berhasil dihapus.');
        }

            return redirect()->route('admin.lokasi')->with('error', 'Lokasi tidak ditemukan.');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan lokasi ke database
        Lokasi::create($validated);

        // Redirect kembali ke halaman lokasi
        return redirect()->route('admin.lokasi')->with('success', 'Lokasi berhasil ditambahkan.');
    }


    // ROUTE PEKERJAAN
    // Menampilkan form untuk menambah pekerjaan
    public function createPekerjaan()
    {
        $lokasis = Lokasi::all(); // Mengambil semua data lokasi
        return view('admin.pekerjaan-create', compact('lokasis'));
    }

    public function pekerjaan()
    {
        $pekerjaans = Pekerjaan::with('lokasi')->get(); // Ambil pekerjaan beserta lokasi
        $lokasis = Lokasi::all(); // Ambil semua lokasi untuk dropdown
        return view('admin.pekerjaan', compact('pekerjaans', 'lokasis'));
    }

    public function storePekerjaan(Request $request)
    {
        $validated = $request->validate([
            'id_lokasi' => 'required|exists:lokasis,id',
            'nama_pekerjaan' => 'required|string|max:255',
            'nominal' => 'required|string', // Biarkan sementara sebagai string untuk proses filter
            'deskripsi' => 'nullable|string',
        ]);

         // Hilangkan format "Rp" dan titik sebelum menyimpan ke database
        $validated['nominal'] = (int) str_replace('.', '', $validated['nominal']);

        Pekerjaan::create($validated);

        return redirect()->route('admin.pekerjaan')->with('success', 'Pekerjaan berhasil ditambahkan.');
    }

    public function editPekerjaan($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $lokasis = Lokasi::all();
        return view('admin.pekerjaan-edit', compact('pekerjaan', 'lokasis'));
    }

    public function updatePekerjaan(Request $request, $id)
    {
        $validated = $request->validate([
            'id_lokasi' => 'required|exists:lokasis,id',
            'nama_pekerjaan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->update($validated);

        return redirect()->route('admin.pekerjaan')->with('success', 'Pekerjaan berhasil diperbarui.');
    }

    public function destroyPekerjaan($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->delete();

        // Reset auto increment setelah delete
        DB::statement('ALTER TABLE pekerjaans AUTO_INCREMENT = 1');

        return redirect()->route('admin.pekerjaan')->with('success', 'Pekerjaan berhasil dihapus.');
    }


    // KEPERLUAN
    // Menampilkan halaman KEPERLUAN
    public function keperluan()
    {
        // Mengambil semua data keperluan dari database
        $keperluans = Keperluan::all();
        
        // Mengirim data keperluan ke view
        return view('admin.keperluan', compact('keperluans'));
    }

     // Menampilkan form untuk menambah keperluan
     public function createKeperluan()
     {
         return view('admin.keperluan-create'); // Menampilkan halaman form input keperluan
     }

     // Menampilkan form untuk mengedit keperluan
    public function editKeperluan($id)
    {
        $keperluan = Keperluan::findOrFail($id); // Ambil data keperluan berdasarkan ID
        return view('admin.keperluan-edit', compact('keperluan')); // Kirim data keperluan ke view
    }

     // Menyimpan perubahan lokasi
     public function updateKeperluan(Request $request, $id)
     {
         $keperluan = Keperluan::findOrFail($id); // Ambil data keperluan berdasarkan ID
 
         // Validasi input
         $validated = $request->validate([
             'nama_keperluan' => 'required|string|max:255',
             'deskripsi' => 'nullable|string',
         ]);
 
         // Update data keperluan
         $keperluan->update($validated);
 
         // Redirect kembali ke halaman keperluan
         return redirect()->route('admin.keperluan')->with('success', 'Keperluan berhasil diupdate.');
     }

    // Fungsi destroy pada controller
    public function destroyKeperluan($id)
    {
        $keperluan = Keperluan::find($id);
        if ($keperluan) {
            $keperluan->delete();

            // Reset auto increment setelah delete
            DB::statement('ALTER TABLE keperluans AUTO_INCREMENT = 1');

            return redirect()->route('admin.keperluan')->with('success', 'keperluan berhasil dihapus.');
        }

            return redirect()->route('admin.keperluan')->with('error', 'keperluan tidak ditemukan.');
    }

    public function storeKeperluan(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_keperluan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan keperluan ke database
        Keperluan::create($validated);

        // Redirect kembali ke halaman keperluan
        return redirect()->route('admin.keperluan')->with('success', 'keperluan berhasil ditambahkan.');
    }



    // ROUTE TUGAS
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
        return view('admin.tugas', compact('tugas', 'users', 'pekerjaans'));
    }

    public function createTugas()
    {
        $user = Auth::user();

        // Pekerjaan yang belum dipilih pengguna lain
        $pekerjaan_tersedia = Pekerjaan::whereDoesntHave('tugas')->get();

        return view('admin.tugas-create', compact('user', 'pekerjaan_tersedia'));
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

        return redirect()->route('admin.tugas')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function editTugas($id)
    {
        $tugas = Tugas::findOrFail($id);

        // Cek jika tugas ini milik pengguna yang sedang login
        if ($tugas->id_user != Auth::id()) {
            return redirect()->route('admin.tugas.tugas')->with('error', 'Anda tidak memiliki izin untuk mengedit tugas ini.');
        }

        // Pekerjaan yang belum dipilih pengguna lain + pekerjaan yang sedang digunakan oleh tugas ini
        $pekerjaan_tersedia = Pekerjaan::whereDoesntHave('tugas', function ($query) use ($tugas) {
            $query->where('id', '!=', $tugas->id);
        })->orWhere('id', $tugas->id_pekerjaan)->get();

        return view('admin.tugas-edit', compact('tugas', 'pekerjaan_tersedia'));
    }

    public function updateTugas(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);

        // Cek jika tugas ini milik pengguna yang sedang login
        if ($tugas->id_user != Auth::id()) {
            return redirect()->route('admin.tugas.tugas')->with('error', 'Anda tidak memiliki izin untuk memperbarui tugas ini.');
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

        return redirect()->route('admin.tugas')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroyTugas($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();

        // Reset auto increment setelah delete
        DB::statement('ALTER TABLE pekerjaans AUTO_INCREMENT = 1');

        return redirect()->route('admin.tugas')->with('success', 'Tugas berhasil dihapus.');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
