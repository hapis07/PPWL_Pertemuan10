<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    // Menampilkan daftar Gallery
    public function index()
    {
        $galleries = Gallery::with('buku')
            ->whereNotNull('foto')
            ->where('foto', '!=', '')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('gallery.index', compact('galleries'));
    }

    // Menampilkan form tambah Gallery
    public function create()
    {
        $bukus = Buku::orderBy('judul')->get();

        return view('gallery.create', compact('bukus'));
    }

    // Menyimpan Gallery
    public function store(Request $request)
    {
        $request->validate([
            'nama_galeri' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'buku_id' => 'required|exists:books,id',
            'foto' => 'required|array|min:1',
            'foto.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        foreach ($request->file('foto') as $file) {

            $fileName = uniqid() . '_' . time() . '.' .
                $file->getClientOriginalExtension();

            $filePath = $file->storeAs(
                'uploads',
                $fileName,
                'public'
            );

            $gallery = Gallery::create([
                'nama_galeri' => $request->nama_galeri,
                'galeri_seo' => Str::slug($request->nama_galeri),
                'keterangan' => $request->keterangan,
                'foto' => $fileName,
                'path' => $filePath,
                'buku_id' => $request->buku_id,
            ]);

            // Membuat SEO unik untuk setiap gambar
            $gallery->update([
                'galeri_seo' => Str::slug($request->nama_galeri)
                    . '-' . $gallery->id
            ]);
        }

        return redirect()
            ->route('gallery.index')
            ->with('success', 'Gallery berhasil ditambahkan.');
    }

    // Menampilkan form edit Gallery
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);

        $bukus = Buku::orderBy('judul')->get();

        return view('gallery.edit', compact('gallery', 'bukus'));
    }

    // Memperbarui Gallery
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $data = $request->validate([
            'nama_galeri' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'buku_id' => 'required|exists:books,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $fileName = uniqid() . '_' . time() . '.' .
                $file->getClientOriginalExtension();

            $filePath = $file->storeAs(
                'uploads',
                $fileName,
                'public'
            );

            // Menghapus foto lama
            if ($gallery->path) {
                Storage::disk('public')->delete($gallery->path);
            }

            $data['foto'] = $fileName;
            $data['path'] = $filePath;
        }

        $data['galeri_seo'] = Str::slug($request->nama_galeri)
            . '-' . $gallery->id;

        $gallery->update($data);

        return redirect()
            ->route('gallery.index')
            ->with('success', 'Gallery berhasil diperbarui.');
    }

    // Menghapus Gallery
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->path) {
            Storage::disk('public')->delete($gallery->path);
        }

        $gallery->delete();

        return redirect()
            ->route('gallery.index')
            ->with('success', 'Gallery berhasil dihapus.');
    }
}
