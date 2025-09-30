<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    // Halaman utama (daftar arsip)
    public function index(Request $request)
    {
        $q = $request->input('q');

        $arsips = Arsip::with('kategori')
            ->when($q, function ($query, $q) {
                return $query->where(function ($sub) use ($q) {
                    $sub->where('judul', 'like', "%{$q}%")
                        ->orWhere('nomor_surat', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('created_at')
            ->get();

        return view('arsip.index', compact('arsips', 'q'));
    }

    // Form tambah arsip
    public function create()
    {
        $kategoris = Kategori::all();
        return view('arsip.create', compact('kategoris'));
    }

    // Simpan arsip baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'file_pdf'    => 'required|mimes:pdf|max:2048',
        ]);

        // Simpan ke storage disk 'public' -> folder dokumen
        $path = $request->file('file_pdf')->store('dokumen', 'public');

        Arsip::create([
            'nomor_surat' => $request->nomor_surat,
            'kategori_id' => $request->kategori_id,
            'judul'       => $request->judul,
            'file_pdf'    => $path, // "dokumen/xxx.pdf"
        ]);

        return redirect()->route('arsip.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Detail arsip
    public function show(Arsip $arsip)
    {
        return view('arsip.show', compact('arsip'));
    }

    // Form edit arsip
    public function edit(Arsip $arsip)
    {
        $kategoris = Kategori::all();
        return view('arsip.edit', compact('arsip', 'kategoris'));
    }

    // Update arsip (ganti data + file opsional)
    public function update(Request $request, Arsip $arsip)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'judul'       => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'file_pdf'    => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only(['nomor_surat', 'judul', 'kategori_id']);

        // Jika upload file baru, hapus file lama lalu simpan yang baru
        if ($request->hasFile('file_pdf')) {
            if ($arsip->file_pdf && Storage::disk('public')->exists($arsip->file_pdf)) {
                Storage::disk('public')->delete($arsip->file_pdf);
            }
            $newPath = $request->file('file_pdf')->store('dokumen', 'public');
            $data['file_pdf'] = $newPath;
        }

        $arsip->update($data);

        return redirect()->route('arsip.index')->with('success', 'Data berhasil diupdate.');
    }

    // Hapus arsip
    public function destroy(Arsip $arsip)
    {
        if ($arsip->file_pdf && Storage::disk('public')->exists($arsip->file_pdf)) {
            Storage::disk('public')->delete($arsip->file_pdf);
        }

        $arsip->delete();
        return redirect()->route('arsip.index')->with('success', 'Data berhasil dihapus.');
    }

    // Unduh file PDF
    public function download(Arsip $arsip)
    {
        if (!$arsip->file_pdf || !Storage::disk('public')->exists($arsip->file_pdf)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($arsip->file_pdf, basename($arsip->file_pdf));
    }
}