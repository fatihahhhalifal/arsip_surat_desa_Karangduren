@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="container my-4">
        <h3>Tambah Kategori</h3>
        <p>
            Tambahkan data kategori baru. Jika sudah selesai, jangan lupa untuk<br>
            mengklik tombol "Simpan".
        </p>

        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id" class="form-label">ID Kategori (otomatis)</label>
                <input type="text" id="id" class="form-control" value="{{ $nextId }}" readonly>
            </div>

            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
            </div>


            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
            </div>

            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection