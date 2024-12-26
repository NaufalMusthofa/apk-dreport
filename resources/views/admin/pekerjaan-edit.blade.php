@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit pekerjaan</h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan error atau success message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('admin.pekerjaan.update', $pekerjaan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="id_lokasi">Lokasi</label>
                                <select name="id_lokasi" id="id_lokasi" class="form-control" required>
                                    <option value="" selected disabled>Pilih Lokasi</option>
                                    @foreach ($lokasis as $lokasi)
                                        <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_pekerjaan">Nama Pekerjaan</label>
                                <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" class="form-control" value="{{ $pekerjaan->nama_pekerjaan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="text" name="nominal" id="nominal" class="form-control" value="{{ $pekerjaan->nominal }}" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $pekerjaan->deskripsi }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Pekerjaan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
