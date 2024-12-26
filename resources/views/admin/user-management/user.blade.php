@extends('layouts.admin')

@section('content')
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tabel Lokasi</h4>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('admin.user-management.user.createUser') }}'">Tambah User</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example4" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            {{-- <th>Id</th> --}}
                                            <th>Nama User</th>
                                            <th>Email</th>
                                            {{-- <th>Password</th> --}}
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td> <!-- Nomor urut dinamis -->
                                                {{-- <td>{{ $user->id }}</td> --}}
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                {{-- <td>{{ $user->password }}</td> --}}
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('admin.user-management.user.edit', $user->id) }}" class="btn btn-primary shadow btn-xs sharp me-1">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                        
                                                        <!-- Delete Button -->
                                                        <form action="{{ route('admin.user-management.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
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
