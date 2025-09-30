@extends('layouts.app')

@section('title', 'Arsip Surat >> Lihat')

@section('content')
  <h3 class="ms-5">Arsip Surat >> Lihat</h3>

  <!-- Detail Arsip -->
  <div class="ms-5 mb-3">
    <div><strong>Nomor:</strong> {{ $arsip->nomor_surat }}</div>
    <div><strong>Kategori:</strong> {{ $arsip->kategori->nama_kategori ?? '-' }}</div>
    <div><strong>Judul:</strong> {{ $arsip->judul }}</div>
    <div><strong>Waktu Unggah:</strong> {{ $arsip->created_at->format('d-m-Y H:i') }}</div>
  </div>

  <!-- Kotak pratinjau PDF -->
  <div class="ms-5 mb-3 border rounded overflow-auto" style="height: 380px;">
    @php
      $fileUrl = $arsip->file_pdf ? Storage::url($arsip->file_pdf) : null;
    @endphp

    @if($fileUrl && Storage::disk('public')->exists($arsip->file_pdf))
      <iframe src="{{ $fileUrl }}" class="w-100 h-100" title="Pratinjau PDF"></iframe>
    @else
      <div class="p-3 text-danger">File tidak ditemukan atau belum diunggah.</div>
    @endif
  </div>

  <!-- Tombol aksi -->
  <div class="ms-5 mb-4 d-flex gap-2">
    <a href="{{ route('arsip.index') }}" class="btn btn-outline-secondary">&laquo; Kembali</a>
    <a href="{{ route('arsip.download', $arsip) }}" class="btn btn-warning">Unduh</a>
    <a href="{{ route('arsip.edit', $arsip) }}" class="btn btn-primary">Edit/Ganti File</a>
  </div>
@endsection