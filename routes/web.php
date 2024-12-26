<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Halaman Welcome
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();  // Ini sudah mencakup rute reset password


// Admin routes
Route::group(['middleware' => function ($request, $next) {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return $next($request);
    }
    return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
}], function () {
    // Dashboard Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Admin melihat data lokasi
    Route::get('/admin/lokasi', [AdminController::class, 'lokasi'])->name('admin.lokasi');

    // Admin dashboard tambahan jika diperlukan
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    // // Admin pekerjaan tambahan jika diperlukan
    // Route::get('/admin/pekerjaan', function () {
    //     return view('admin.pekerjaan');
    // });


    // USER MANAGEMENTS
    // Route untuk form tambah pekerjaan
    Route::get('/admin/user-management/user/createUser', [UserController::class, 'createUser'])->name('admin.user-management.user.createUser');

    // Route melihat semua daftar pekerjaan
    Route::get('/admin/user-management/user', [UserController::class, 'user'])->name('admin.user-management.user');

    // Route menyimpan pekerjaan baru
    Route::post('/admin/user-management/user', [UserController::class, 'storeUser'])->name('admin.user-management.user.store');

    // Route mengedit data pekerjaan
    Route::get('/admin/user-management/user/{id}/edit', [UserController::class, 'editUser'])->name('admin.user-management.user.edit');

    // Route update data pekerjaan
    Route::put('/admin/user-management/user/{id}', [UserController::class, 'updateUser'])->name('admin.user-management.user.update');

    // Route mendelete data pekerjaan
    Route::delete('/admin/user-management/user/{id}', [UserController::class, 'destroyUser'])->name('admin.user-management.user.destroy');
    

    // LOKASI
    // Route untuk form tambah lokasi
    Route::get('/admin/lokasi/create', [AdminController::class, 'create'])->name('admin.lokasi.create');

    // Route untuk menyimpan lokasi
    Route::post('/admin/lokasi', [AdminController::class, 'store'])->name('admin.lokasi.store');

    // Route untuk form edit lokasi
    Route::get('/admin/lokasi/{id}/edit', [AdminController::class, 'edit'])->name('admin.lokasi.edit');

    // Route untuk update lokasi
    Route::put('/admin/lokasi/{id}', [AdminController::class, 'update'])->name('admin.lokasi.update');

    // Route untuk menghapus lokasi
    Route::delete('/admin/lokasi/{id}', [AdminController::class, 'destroy'])->name('admin.lokasi.destroy');


    // ROUTE PEKERJAAN
    // Route untuk form tambah pekerjaan
    Route::get('/admin/pekerjaan/createPekerjaan', [AdminController::class, 'createPekerjaan'])->name('admin.pekerjaan.createPekerjaan');

    // Route melihat semua daftar pekerjaan
    Route::get('/admin/pekerjaan', [AdminController::class, 'pekerjaan'])->name('admin.pekerjaan');

    // Route menyimpan pekerjaan baru
    Route::post('/admin/pekerjaan', [AdminController::class, 'storePekerjaan'])->name('admin.pekerjaan.store');

    // Route mengedit data pekerjaan
    Route::get('/admin/pekerjaan/{id}/edit', [AdminController::class, 'editPekerjaan'])->name('admin.pekerjaan.edit');

    // Route update data pekerjaan
    Route::put('/admin/pekerjaan/{id}', [AdminController::class, 'updatePekerjaan'])->name('admin.pekerjaan.update');

    // Route mendelete data pekerjaan
    Route::delete('/admin/pekerjaan/{id}', [AdminController::class, 'destroyPekerjaan'])->name('admin.pekerjaan.destroy');


    // ROUTE KEPERLUAN
    // Route untuk form tambah keperluan
    Route::get('/admin/keperluan/createKeperluan', [AdminController::class, 'createKeperluan'])->name('admin.keperluan.createKeperluan');

    // Route melihat semua daftar keperluan
    Route::get('/admin/keperluan', [AdminController::class, 'keperluan'])->name('admin.keperluan');

    // Route menyimpan keperluan baru
    Route::post('/admin/keperluan', [AdminController::class, 'storeKeperluan'])->name('admin.keperluan.store');

    // Route mengedit data keperluan
    Route::get('/admin/keperluan/{id}/edit', [AdminController::class, 'editKeperluan'])->name('admin.keperluan.edit');

    // Route update data keperluan
    Route::put('/admin/keperluan/{id}', [AdminController::class, 'updateKeperluan'])->name('admin.keperluan.update');

    // Route mendelete data keperluan
    Route::delete('/admin/keperluan/{id}', [AdminController::class, 'destroyKeperluan'])->name('admin.keperluan.destroy');


    // ROUTE TUGAS
    // Route untuk form tambah tugas
    Route::get('/admin/tugas/createTugas', [AdminController::class, 'createTugas'])->name('admin.tugas.createTugas');

    // Route melihat semua daftar tugas
    Route::get('/admin/tugas', [AdminController::class, 'tugas'])->name('admin.tugas');

    // Route menyimpan tugas baru
    Route::post('/admin/tugas', [AdminController::class, 'storeTugas'])->name('admin.tugas.store');

    // Route mengedit data tugas
    Route::get('/admin/tugas/{id}/edit', [AdminController::class, 'editTugas'])->name('admin.tugas.edit');

    // Route update data tugas
    Route::put('/admin/tugas/{id}', [AdminController::class, 'updateTugas'])->name('admin.tugas.update');

    // Route mendelete data tugas
    Route::delete('/admin/tugas/{id}', [AdminController::class, 'destroyTugas'])->name('admin.tugas.destroy');


});



// Pengawas routes // Supervisor
Route::group(['middleware' => function ($request, $next) {
    if (Auth::check() && Auth::user()->role === 'supervisor') {
        return $next($request);
    }
    return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
}], function () {
    Route::get('/supervisor', [SupervisorController::class, 'index'])->name('supervisor.dashboard');

    // Supervisor dashboard tambahan jika diperlukan
    Route::get('/supervisor/dashboard', function () {
        return view('supervisor.dashboard');
    });

    // Supervisor masterData lokasi
    Route::get('/supervisor/lokasi', [SupervisorController::class, 'lokasi'])->name('supervisor.lokasi');
    
    // Supervisor masterData pekerjaan
    Route::get('/supervisor/pekerjaan', function () {
        return view('supervisor.pekerjaan');
    });

    // ROUTE LOKASI
    // Route untuk form tambah lokasi
    Route::get('/supervisor/lokasi/create', [SupervisorController::class, 'create'])->name('supervisor.lokasi.create');

    // Route untuk menyimpan lokasi
    Route::post('/supervisor/lokasi', [SupervisorController::class, 'store'])->name('supervisor.lokasi.store');

    // Route untuk form edit lokasi
    Route::get('/supervisor/lokasi/{id}/edit', [SupervisorController::class, 'edit'])->name('supervisor.lokasi.edit');

    // Route untuk update lokasi
    Route::put('/supervisor/lokasi/{id}', [SupervisorController::class, 'update'])->name('supervisor.lokasi.update');

    // Route untuk menghapus lokasi
    Route::delete('/supervisor/lokasi/{id}', [SupervisorController::class, 'destroy'])->name('supervisor.lokasi.destroy');


    // ROUTE PEKERJAAN
    // Route untuk form tambah pekerjaan
    Route::get('/supervisor/pekerjaan/createPekerjaan', [SupervisorController::class, 'createPekerjaan'])->name('supervisor.pekerjaan.createPekerjaan');

    // Route melihat semua daftar pekerjaan
    Route::get('/supervisor/pekerjaan', [SupervisorController::class, 'pekerjaan'])->name('supervisor.pekerjaan');

    // Route menyimpan pekerjaan baru
    Route::post('/supervisor/pekerjaan', [SupervisorController::class, 'storePekerjaan'])->name('supervisor.pekerjaan.store');

    // Route mengedit data pekerjaan
    Route::get('/supervisor/pekerjaan/{id}/edit', [SupervisorController::class, 'editPekerjaan'])->name('supervisor.pekerjaan.edit');

    // Route update data pekerjaan
    Route::put('/supervisor/pekerjaan/{id}', [SupervisorController::class, 'updatePekerjaan'])->name('supervisor.pekerjaan.update');

    // Route mendelete data pekerjaan
    Route::delete('/supervisor/pekerjaan/{id}', [SupervisorController::class, 'destroyPekerjaan'])->name('supervisor.pekerjaan.destroy');

    
    // ROUTE KEPERLUAN
    // Route untuk form tambah keperluan
    Route::get('/supervisor/keperluan/createKeperluan', [SupervisorController::class, 'createKeperluan'])->name('supervisor.keperluan.createKeperluan');

    // Route melihat semua daftar keperluan
    Route::get('/supervisor/keperluan', [SupervisorController::class, 'keperluan'])->name('supervisor.keperluan');

    // Route menyimpan keperluan baru
    Route::post('/supervisor/keperluan', [SupervisorController::class, 'storeKeperluan'])->name('supervisor.keperluan.store');

    // Route mengedit data keperluan
    Route::get('/supervisor/keperluan/{id}/edit', [SupervisorController::class, 'editKeperluan'])->name('supervisor.keperluan.edit');

    // Route update data keperluan
    Route::put('/supervisor/keperluan/{id}', [SupervisorController::class, 'updateKeperluan'])->name('supervisor.keperluan.update');

    // Route mendelete data keperluan
    Route::delete('/supervisor/keperluan/{id}', [SupervisorController::class, 'destroyKeperluan'])->name('supervisor.keperluan.destroy');
});


// Petugas / teknisi routes
Route::group(['middleware' => function ($request, $next) {
    if (Auth::check() && Auth::user()->role === 'teknisi') {
        return $next($request);
    }
    return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
}], function () {
    Route::get('/teknisi', [TeknisiController::class, 'index'])->name('teknisi.dashboard');

    // teknisi dashboard
    Route::get('/teknisi/dashboard', function () {
        return view('teknisi.dashboard');
    });


    // ROUTE TUGAS
    // Route untuk form tambah tugas
    Route::get('/teknisi/tugas/createTugas', [TeknisiController::class, 'createTugas'])->name('teknisi.tugas.createTugas');

    // Route melihat semua daftar tugas
    Route::get('/teknisi/tugas', [TeknisiController::class, 'tugas'])->name('teknisi.tugas');

    // Route menyimpan tugas baru
    Route::post('/teknisi/tugas', [TeknisiController::class, 'storeTugas'])->name('teknisi.tugas.store');

    // Route mengedit data tugas
    Route::get('/teknisi/tugas/{id}/edit', [TeknisiController::class, 'editTugas'])->name('teknisi.tugas.edit');

    // Route update data tugas
    Route::put('/teknisi/tugas/{id}', [TeknisiController::class, 'updateTugas'])->name('teknisi.tugas.update');

    // Route mendelete data tugas
    Route::delete('/teknisi/tugas/{id}', [TeknisiController::class, 'destroyTugas'])->name('teknisi.tugas.destroy');

});



// Halaman Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Halaman Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Proses Login
Route::post('/login', function () {
    $credentials = request()->only('email', 'password');
    if (Auth::attempt($credentials)) {
        // Cek role pengguna dan redirect ke halaman yang sesuai
        $role = Auth::user()->role;
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'supervisor':
                return redirect()->route('supervisor.dashboard');
            case 'teknisi':
                return redirect()->route('teknisi.dashboard');
            default:
                return redirect()->route('login')->withErrors(['role' => 'Role tidak valid.']);
        }
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
})->name('login');

// Proses Register
Route::post('/register', function () {
    $data = request()->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:admin,supervisor,teknisi',
    ]);

    // Enkripsi password
    $data['password'] = bcrypt($data['password']);

    // Simpan user baru ke database
    \App\Models\User::create($data);

    // Redirect ke halaman login setelah registrasi
    return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
})->name('register');

// Route Logout
Route::post('/logout', function () {
    // Hapus session pengguna
    Auth::logout();
    session()->flush();

    // Redirect ke halaman login setelah logout
    return redirect()->route('login');
})->name('logout');
