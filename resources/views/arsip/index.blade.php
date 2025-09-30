@extends('layouts.app')

@section('title', 'Arsip Surat')

@section('content')
<div class="container my-4">
    <h3>Arsip Surat</h3>
    <p>
        Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.<br>
        Klik "Lihat" pada kolom aksi untuk menampilkan surat.
    </p>

    {{-- Search --}}
    <form class="row g-2 align-items-center mb-3 mt-4" method="GET" action="{{ route('arsip.index') }}">
        <div class="col-auto">
            <label for="search" class="col-form-label fw-semibold me-3">Cari surat:</label>
        </div>

        <div class="col-md-6 col-sm-8">
            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>
                <input id="search" name="q" class="form-control" type="search" placeholder="Search"
                       value="{{ $q ?? '' }}">
                @if(!empty($q))
                    <a href="{{ route('arsip.index') }}" class="btn btn-outline-secondary">✕</a>
                @endif
            </div>
        </div>

        <div class="col-auto">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel arsip --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nomor Surat</th>
                <th>Kategori</th>
                <th>Judul</th>
                <th>Waktu Arsip</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($arsips as $item)
                <tr>
                    <td>{{ $item->nomor_surat }}</td>
                    <td>{{ $item->kategori->nama_kategori }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="hapusKonfirmasi({{ $item->id }})">Hapus</button>
                        <a href="{{ route('arsip.download', $item->id) }}" class="btn btn-success btn-sm">Unduh</a>
                        <a href="{{ route('arsip.show', $item->id) }}" class="btn btn-info btn-sm">Lihat &raquo;</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada arsip</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('arsip.create') }}" class="btn btn-primary">Arsipkan Surat..</a>
</div>

{{-- Modal konfirmasi hapus --}}
<div class="modal fade" id="modalHapus" tabindex="-1">
    <div class="modal-dialog">
        <form id="formHapus" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                </div>
                <div class="modal-body">Apakah Anda yakin ingin menghapus arsip ini?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya!</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function hapusKonfirmasi(id) {
        let url = "{{ route('arsip.destroy', ':id') }}".replace(':id', id);
        document.getElementById('formHapus').action = url;
        let modal = new bootstrap.Modal(document.getElementById('modalHapus'));
        modal.show();
    }
</script>
@endsection