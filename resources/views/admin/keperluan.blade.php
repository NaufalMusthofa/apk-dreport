@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Keperluan</h4>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('admin.keperluan.createKeperluan') }}'">Tambah Keperluan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        {{-- <th>Id</th> --}}
                                        <th>Nama Keperluan</th>
                                        <th>Deskripsi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keperluans as $index => $keperluan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td> <!-- Nomor urut dinamis -->
                                            {{-- <td>{{ $keperluan->id }}</td> --}}
                                            <td>{{ $keperluan->nama_keperluan }}</td>
                                            <td>{{ $keperluan->deskripsi }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('admin.keperluan.edit', $keperluan->id) }}" class="btn btn-primary shadow btn-xs sharp me-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                    
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('admin.keperluan.destroy', $keperluan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus keperluan ini?');">
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
