@extends('layouts.supervisor')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Keperluan</h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan error atau success message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('supervisor.keperluan.update', $keperluan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_keperluan">Nama Keperluan</label>
                                <input type="text" name="nama_keperluan" id="nama_keperluan" class="form-control" value="{{ $keperluan->nama_keperluan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $keperluan->deskripsi }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Keperluan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
