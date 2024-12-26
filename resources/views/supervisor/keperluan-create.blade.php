@extends('layouts.supervisor')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Keperluan</h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan error atau success message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('supervisor.keperluan.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_keperluan">Nama Keperluan</label>
                                <input type="text" name="nama_keperluan" id="nama_keperluan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Keperluan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
