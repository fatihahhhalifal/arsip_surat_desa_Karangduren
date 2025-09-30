@extends('layouts.app')

@section('title', 'Edit Arsip')

@section('content')
<div class="container my-4">
  <h3>Edit Arsip</h3>

  <form action="{{ route('arsip.update', $arsip) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="nomor_surat" class="form-label">Nomor Surat</label>
      <input type="text" name="nomor_surat" id="nomor_surat"
             value="{{ old('nomor_surat', $arsip->nomor_surat) }}"
             class="form-control @error('nomor_surat') is-invalid @enderror" required>
      @error('nomor_surat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label for="kategori_id" class="form-label">Kategori</label>
      <select name="kategori_id" id="kategori_id"
              class="form-control @error('kategori_id') is-invalid @enderror" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategoris as $k)
          <option value="{{ $k->id }}" @selected(old('kategori_id', $arsip->kategori_id) == $k->id)>
            {{ $k->nama_kategori }}
          </option>
        @endforeach
      </select>
      @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label for="judul" class="form-label">Judul</label>
      <input type="text" name="judul" id="judul"
             value="{{ old('judul', $arsip->judul) }}"
             class="form-control @error('judul') is-invalid @enderror" required>
      @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- Informasi file saat ini --}}
    <div class="mb-3">
      <label class="form-label d-block">File Saat Ini</label>

      @php
        $exists = $arsip->file_pdf && Storage::disk('public')->exists($arsip->file_pdf);
        $url    = $exists ? Storage::url($arsip->file_pdf) : null;
      @endphp

      @if($exists)
        <div class="d-flex align-items-center gap-2 mb-2">
          <span class="badge bg-success">Ada</span>
          <a href="{{ $url }}" target="_blank" class="btn btn-sm btn-outline-secondary">Lihat</a>
        </div>
      @else
        <span class="badge bg-warning text-dark">Belum ada file</span>
      @endif
    </div>

    {{-- Upload file baru (opsional) --}}
    <div class="mb-3">
      <label for="file_pdf" class="form-label">Ganti File (PDF) — opsional</label>
      <input type="file" name="file_pdf" id="file_pdf"
             class="form-control @error('file_pdf') is-invalid @enderror"
             accept="application/pdf">
      <div class="form-text">Biarkan kosong jika tidak ingin mengganti file.</div>
      @error('file_pdf') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <a href="{{ route('arsip.index') }}" class="btn btn-secondary">Kembali</a>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
  </form>
</div>
@endsection
