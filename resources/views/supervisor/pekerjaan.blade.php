@extends('layouts.supervisor')

@section('content')
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tabel Pekerjaan</h4>
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('supervisor.pekerjaan.createPekerjaan') }}'">Tambah Pekerjaan</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example4" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>No</th>
												<th>Nama Pekerjaan</th>
                                                <th>Nominal</th>
                                                <th>Deskripsi</th>
                                                <th>Lokasi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pekerjaans as $pekerjaan)
                                            <tr>
                                                <td>{{ $pekerjaan->id }}</td>
                                                <td>{{ $pekerjaan->nama_pekerjaan }}</td>
                                                <td>{{ number_format($pekerjaan->nominal, 2, ',', '.') }}</td>
                                                <td>{{ $pekerjaan->deskripsi }}</td>
                                                <td>{{ $pekerjaan->lokasi->nama_lokasi ?? 'Tidak ada lokasi' }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('supervisor.pekerjaan.edit', $pekerjaan->id) }}" class="btn btn-primary shadow btn-xs sharp me-1">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                        
                                                        <!-- Delete Button -->
                                                        <form action="{{ route('supervisor.pekerjaan.destroy', $pekerjaan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pekerjaan ini?');">
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
        <!--**********************************
            Content body end
        ***********************************-->

@endsection
