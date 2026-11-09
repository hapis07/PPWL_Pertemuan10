<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    // READ: menampilkan daftar buku dengan pagination dan statistik.
    public function __construct()
    {
    $this->middleware('auth');
    }

    public function index()
    {
        $batas = 5;

        $data_buku = Buku::orderByDesc('id')->paginate($batas);
        $total_buku = Buku::count();
        $total_harga = Buku::sum('harga');
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('buku.index', compact(
            'data_buku',
            'total_buku',
            'total_harga',
            'no'
        ));
    }

    // CREATE: menampilkan form tambah buku.
    public function create()
    {
        return view('buku.create');
    }

    // CREATE: menyimpan buku baru.
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|integer|min:0',
            'tgl_terbit' => 'required|date',
            'cover' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $coverPath = null;

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store(
                'covers',
                'public'
            );
        }   

        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
            'cover' => $coverPath,
        ]);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    // UPDATE: menampilkan form edit.
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);

        return view('buku.edit', compact('buku'));
    }

    // UPDATE: menyimpan perubahan buku.
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $data = $request->validate(
            [
                'judul' => 'required|string|max:255',
                'penulis' => 'required|string|max:30',
                'harga' => 'required|integer|min:0',
                'tgl_terbit' => 'required|date',
                'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ],
            [
                'judul.required' => 'Judul buku wajib diisi.',
                'judul.string' => 'Judul buku harus berupa teks.',
                'judul.max' => 'Judul buku maksimal 255 karakter.',
                'penulis.required' => 'Nama penulis wajib diisi.',
                'penulis.string' => 'Nama penulis harus berupa teks.',
                'penulis.max' => 'Nama penulis maksimal 30 karakter.',
                'harga.required' => 'Harga buku wajib diisi.',
                'harga.integer' => 'Harga buku harus berupa bilangan bulat.',
                'harga.min' => 'Harga buku tidak boleh kurang dari 0.',
                'tgl_terbit.required' => 'Tanggal terbit wajib diisi.',
                'tgl_terbit.date' => 'Tanggal terbit tidak valid.',
                'cover.image' => 'Cover harus berupa gambar.',
                'cover.mimes' => 'Format cover harus jpg, jpeg, atau png.',
                'cover.max' => 'Ukuran cover maksimal 2 MB.',
            ]
        );
        if ($request->hasFile('cover')){
            if ($buku->cover){
                storage::disk('public')->delete($buku->cover);
            }
            $coverPath = $request->file('cover')->store(
                'covers',
                'public'
            );
            $data['cover'] =$coverPath;
        } else {
            unset($data['cover']);
        }

        $buku->update($data);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    // DELETE: menghapus buku.
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()
            ->route('buku.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }

    // SEARCH: mencari berdasarkan judul atau penulis.
    public function search(Request $request)
    {
        $cari = trim((string) $request->query('cari', ''));

        if ($cari === '') {
            return redirect()
                ->route('buku.index')
                ->with(
                    'success',
                    'Masukkan kata kunci pencarian terlebih dahulu.'
                );
        }

        $batas = 5;

        $data_buku = Buku::where(function ($query) use ($cari) {
            $query->where('judul', 'like', '%' . $cari . '%')
                ->orWhere('penulis', 'like', '%' . $cari . '%');
        })
            ->orderByDesc('id')
            ->paginate($batas)
            ->appends($request->query());

        $jumlah_hasil = $data_buku->total();
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('buku.search', compact(
            'data_buku',
            'jumlah_hasil',
            'no',
            'cari'
        ));
    }
}