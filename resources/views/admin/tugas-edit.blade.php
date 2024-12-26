@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Tugas</h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan error atau success message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('admin.tugas.update', $tugas->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="id_pekerjaan">Pekerjaan</label>
                                <select class="form-control @error('id_pekerjaan') is-invalid @enderror" name="id_pekerjaan" id="id_pekerjaan">
                                    <option value="" disabled>Pilih Pekerjaan</option>
                                    @foreach($pekerjaan_tersedia as $pekerjaan)
                                        <option value="{{ $pekerjaan->id }}" {{ $pekerjaan->id == $tugas->id_pekerjaan ? 'selected' : '' }}>
                                            {{ $pekerjaan->nama_pekerjaan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value="pending" {{ $tugas->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in-progress" {{ $tugas->status == 'in-progress' ? 'selected' : '' }}>in-progress</option>
                                    <option value="completed" {{ $tugas->status == 'completed' ? 'selected' : '' }}>completed</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="form-group">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai" id="tanggal_mulai" value="{{ $tugas->tanggal_mulai ? \Carbon\Carbon::parse($tugas->tanggal_mulai)->format('Y-m-d') : '' }}">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                    
                            <div class="form-group">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" name="tanggal_selesai" id="tanggal_selesai" value="{{ $tugas->tanggal_selesai ? \Carbon\Carbon::parse($tugas->tanggal_selesai)->format('Y-m-d') : '' }}">
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Pekerjaan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
