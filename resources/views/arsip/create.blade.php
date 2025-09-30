@extends('layouts.app')

@section('title', 'Arsipkan Surat')

@section('content')
    <div class="container my-4">
        <h3>Arsipkan Surat</h3>
        <p>
            Unggah surat yang telah terbit pada form ini untuk diarsipkan.<br>
            Catatan:
            <br>- Gunakan file berformat PDF
        </p>

        <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nomor_surat" class="form-label">Nomor Surat</label>
                <input type="text" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat') }}"
                    class="form-control @error('nomor_surat') is-invalid @enderror" required>
                @error('nomor_surat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror"
                    required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" @selected(old('kategori_id') == $k->id)>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                    class="form-control @error('judul') is-invalid @enderror" required>
                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="file_pdf" class="form-label">File (PDF)</label>
                <input type="file" name="file_pdf" id="file_pdf"
                    class="form-control @error('file_pdf') is-invalid @enderror" accept="application/pdf" required>
                @error('file_pdf') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <a href="{{ route('arsip.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection