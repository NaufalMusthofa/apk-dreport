@extends('layouts.teknisi')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tabel Tugas</h4>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('teknisi.tugas.createTugas') }}'">Tambah Tugas</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    {{-- <th>id_tugas</th> --}}
                                    <th>Nama User</th>
                                    <th>Pekerjaan</th>
                                    <th>Status</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tugas as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        {{-- <td>{{ $pekerjaan->id }}</td> ini id tugas --}}
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->pekerjaan->nama_pekerjaan }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($item->status == 'pending') badge-warning
                                                @elseif($item->status == 'in-progress') badge-info
                                                @elseif($item->status == 'completed') badge-success
                                                @endif">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $item->tanggal_mulai ? $item->tanggal_mulai->format('d-m-Y') : '-' }}</td>
                                        <td>{{ $item->tanggal_selesai ? $item->tanggal_selesai->format('d-m-Y') : '-' }}</td>

                                        <td>
                                            <div class="d-flex">
                                                @if ($item->id_user == Auth::id())
                                                    <!-- Tombol Edit hanya tampil jika tugas ini milik pengguna yang sedang login -->
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('teknisi.tugas.edit', $item->id) }}" class="btn btn-primary shadow btn-xs sharp me-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('teknisi.tugas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger shadow btn-xs sharp">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
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
