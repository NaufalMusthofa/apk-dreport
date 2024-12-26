@extends('layouts.supervisor')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Lokasi</h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan error atau success message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('supervisor.lokasi.update', $lokasi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_lokasi">Nama Lokasi</label>
                                <input type="text" name="nama_lokasi" id="nama_lokasi" class="form-control" value="{{ $lokasi->nama_lokasi }}" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $lokasi->deskripsi }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Lokasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
