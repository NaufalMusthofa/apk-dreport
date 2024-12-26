<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }


    // ROUTE USER
    // Menampilkan daftar user
    public function user()
    {
        $users = User::all(); // Mengambil semua data user
        return view('admin.user-management.user', compact('users'));
    }

    // Menampilkan form tambah user
    public function createUser()
    {
        return view('admin.user-management.user-create');
    }

    // Menyimpan user baru
    public function storeUser(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:teknisi,supervisor,admin',
        ]);

        try {
            // Simpan user ke database
            User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'role' => $validatedData['role'],
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('admin.user-management.user.user-create')->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Tangkap error dan tampilkan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Menampilkan form edit user
    public function editUser($id)
    {
        $user = User::findOrFail($id); // Mengambil user berdasarkan ID
        return view('admin.user-management.user-edit', compact('user'));
    }

    // Mengupdate data user
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:teknisi,supervisor,admin',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.user-management.user')->with('success', 'User berhasil diperbarui.');
    }

    // Menghapus user
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Reset auto increment setelah delete
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');

        return redirect()->route('admin.user-management.user')->with('success', 'User berhasil dihapus.');
    }
}

