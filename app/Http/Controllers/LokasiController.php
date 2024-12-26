<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::all();
        return view('supervisor.lokasi', compact('lokasi'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Lokasi::create($validatedData);

        return redirect()->route('supervisor.lokasi')->with('success', 'Lokasi berhasil ditambahkan!');
    }
}
