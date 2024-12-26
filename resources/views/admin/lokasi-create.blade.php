@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Lokasi</h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan error atau success message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('admin.lokasi.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_lokasi">Nama Lokasi</label>
                                <input type="text" name="nama_lokasi" id="nama_lokasi" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Lokasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
