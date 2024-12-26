<?php

namespace App\Http\Controllers;

use App\Models\Keperluan;
use Illuminate\Support\Facades\DB;
use App\Models\Lokasi;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index()
    {
        return view('supervisor.dashboard');
    }

    // LOKASI
    // Menampilkan halaman lokasi
    public function lokasi()
    {
        // Mengambil semua data lokasi dari database
        $lokasis = Lokasi::all();
        
        // Mengirim data lokasi ke view
        return view('supervisor.lokasi', compact('lokasis'));
    }

     // Menampilkan form untuk menambah lokasi
     public function create()
     {
         return view('supervisor.lokasi-create'); // Menampilkan halaman form input lokasi
     }

     // Menampilkan form untuk mengedit lokasi
    public function edit($id)
    {
        $lokasi = Lokasi::findOrFail($id); // Ambil data lokasi berdasarkan ID
        return view('supervisor.lokasi-edit', compact('lokasi')); // Kirim data lokasi ke view
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
         return redirect()->route('supervisor.lokasi')->with('success', 'Lokasi berhasil diupdate.');
     }

    // Fungsi destroy pada controller
    public function destroy($id)
    {
        $lokasi = Lokasi::find($id);
        if ($lokasi) {
            $lokasi->delete();

            // Reset auto increment setelah delete
            DB::statement('ALTER TABLE lokasis AUTO_INCREMENT = 1');

            return redirect()->route('supervisor.lokasi')->with('success', 'Lokasi berhasil dihapus.');
        }

            return redirect()->route('supervisor.lokasi')->with('error', 'Lokasi tidak ditemukan.');
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
        return redirect()->route('supervisor.lokasi')->with('success', 'Lokasi berhasil ditambahkan.');
    }


    // PEKERJAAN
    // Menampilkan form untuk menambah pekerjaan
    public function createPekerjaan()
    {
        $lokasis = Lokasi::all(); // Mengambil semua data lokasi
        return view('supervisor.pekerjaan-create', compact('lokasis'));
    }

    public function pekerjaan()
    {
        $pekerjaans = Pekerjaan::with('lokasi')->get(); // Ambil pekerjaan beserta lokasi
        $lokasis = Lokasi::all(); // Ambil semua lokasi untuk dropdown
        return view('supervisor.pekerjaan', compact('pekerjaans', 'lokasis'));
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

        return redirect()->route('supervisor.pekerjaan')->with('success', 'Pekerjaan berhasil ditambahkan.');
    }

    public function editPekerjaan($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $lokasis = Lokasi::all();
        return view('supervisor.pekerjaan-edit', compact('pekerjaan', 'lokasis'));
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

        return redirect()->route('supervisor.pekerjaan')->with('success', 'Pekerjaan berhasil diperbarui.');
    }

    public function destroyPekerjaan($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->delete();

        // Reset auto increment setelah delete
        DB::statement('ALTER TABLE pekerjaans AUTO_INCREMENT = 1');

        return redirect()->route('supervisor.pekerjaan')->with('success', 'Pekerjaan berhasil dihapus.');
    }


    // KEPERLUAN
    // Menampilkan halaman KEPERLUAN
    public function keperluan()
    {
        // Mengambil semua data lokasi dari database
        $keperluans = Keperluan::all();
        
        // Mengirim data keperluan ke view
        return view('supervisor.keperluan', compact('keperluans'));
    }

     // Menampilkan form untuk menambah keperluan
     public function createKeperluan()
     {
         return view('supervisor.keperluan-create'); // Menampilkan halaman form input keperluan
     }

     // Menampilkan form untuk mengedit keperluan
    public function editKeperluan($id)
    {
        $keperluan = Keperluan::findOrFail($id); // Ambil data keperluan berdasarkan ID
        return view('supervisor.keperluan-edit', compact('keperluan')); // Kirim data keperluan ke view
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
         return redirect()->route('supervisor.keperluan')->with('success', 'Keperluan berhasil diupdate.');
     }

    // Fungsi destroy pada controller
    public function destroyKeperluan($id)
    {
        $keperluan = Keperluan::find($id);
        if ($keperluan) {
            $keperluan->delete();

            // Reset auto increment setelah delete
            DB::statement('ALTER TABLE keperluans AUTO_INCREMENT = 1');

            return redirect()->route('supervisor.keperluan')->with('success', 'keperluan berhasil dihapus.');
        }

            return redirect()->route('supervisor.keperluan')->with('error', 'keperluan tidak ditemukan.');
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
        return redirect()->route('supervisor.keperluan')->with('success', 'keperluan berhasil ditambahkan.');
    }


}
