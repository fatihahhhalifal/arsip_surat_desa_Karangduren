@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Kategori</h2>
        <p>
            Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat.<br>
            Klik "Tambah" pada kolom aksi untuk menambahkan kategori baru.
        </p>

        {{-- Form Pencarian --}}
        <form class="row g-2 align-items-center mb-3 mt-4" role="search" method="GET"
            action="{{ route('kategori.index') }}">
            <div class="col-auto">
                <label for="searchKategori" class="col-form-label fw-semibold me-3">Cari kategori:</label>
            </div>
            <div class="col-md-6 col-sm-8">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input id="searchKategori" name="q" class="form-control" type="search" placeholder="search"
                        value="{{ $q ?? '' }}">
                    @if(!empty($q))
                        <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">✕</a>
                    @endif
                </div>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-primary" type="submit">Cari!</button>
            </div>
        </form>

        {{-- Alert Sukses --}}
        @if(session('success'))
            <div id="alertSukses" class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Tabel Daftar Kategori --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoris as $i => $kategori)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>{{ $kategori->keterangan }}</td>
                        <td>
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Tombol Tambah --}}
        <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>

    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus kategori ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="btnYaHapus" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Alert & Delete --}}
    <script>
        let formTarget = null;

        document.querySelectorAll('.btn-hapus').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                formTarget = this.closest('form');
                const modalEl = document.getElementById('modalHapus');
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            });
        });

        document.getElementById('btnYaHapus').addEventListener('click', () => {
            if (formTarget) {
                formTarget.submit();
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const alertBox = document.getElementById('alertSukses');
            if (alertBox) {
                setTimeout(() => {
                    alertBox.style.opacity = '0';
                    setTimeout(() => alertBox.remove(), 500);
                }, 3000);
            }
        });
    </script>
@endsection