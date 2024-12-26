@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah User</h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan error atau success message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('admin.user-management.user.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama User</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" id="email" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" id="password" class="form-control" placeholder="Masukan Minimal 8 Huruf/Angka"></input>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="teknisi">Teknisi</option>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan User</button>
                            <a href="{{ route('admin.user-management.user') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
