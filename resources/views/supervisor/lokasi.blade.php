@extends('layouts.supervisor')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Lokasi</h4>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('supervisor.lokasi.create') }}'">Tambah Lokasi</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama Lokasi</th>
                                        <th>Deskripsi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lokasis as $lokasi)
                                        <tr>
                                            <td>{{ $lokasi->id }}</td>
                                            <td>{{ $lokasi->nama_lokasi }}</td>
                                            <td>{{ $lokasi->deskripsi }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('supervisor.lokasi.edit', $lokasi->id) }}" class="btn btn-primary shadow btn-xs sharp me-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                    
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('supervisor.lokasi.destroy', $lokasi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger shadow btn-xs sharp">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
