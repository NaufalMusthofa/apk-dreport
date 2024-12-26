@extends('layouts.supervisor')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Pekerjaan</h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan error atau success message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <!-- Form Tambah Pekerjaan -->
                        <form action="{{ route('supervisor.pekerjaan.store') }}" method="POST">
                            @csrf

                            <!-- Pilih Lokasi -->
                            <div class="form-group">
                                <label for="id_lokasi">Lokasi</label>
                                <select name="id_lokasi" id="id_lokasi" class="form-control" required>
                                    <option value="" selected disabled>Pilih Lokasi</option>
                                    @foreach ($lokasis as $lokasi)
                                        <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nama Pekerjaan -->
                            <div class="form-group">
                                <label for="nama_pekerjaan">Nama Pekerjaan</label>
                                <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" class="form-control" placeholder="Masukkan nama pekerjaan" required>
                            </div>

                            <!-- Nominal -->
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                {{-- YANG LAMA --}}
                                {{-- <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Masukkan nominal" min="0" step="0.01" required> --}}

                                {{-- YANG BARU --}}
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" name="nominal" id="nominal" class="form-control" placeholder="Masukkan nominal" required oninput="formatRupiah(this)">
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Tambahkan deskripsi pekerjaan (opsional)"></textarea>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary">Simpan Pekerjaan</button>
                            <a href="{{ route('supervisor.pekerjaan') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function formatRupiah(input) {
        let value = input.value.replace(/[^,\d]/g, ''); // Hanya angka dan koma
        let rupiah = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Tambahkan titik ribuan
        input.value = rupiah; // Tetapkan kembali nilai tanpa desimal
    }
</script>


