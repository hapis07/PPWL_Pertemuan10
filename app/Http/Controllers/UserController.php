<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    // Menampilkan seluruh data user
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('users.index', compact('users'));
    }

    // Menampilkan form tambah user
    public function create()
    {
        return view('users.create');
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'level' => 'required|in:admin,user',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'Data user berhasil ditambahkan.');
    }

    // Menampilkan detail user
    public function show(string $id)
    {
        abort(404);
    }

    // Menampilkan form edit user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Memperbarui data user
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'level' => 'required|in:admin,user',
        ]);

        if ($user->id == auth()->id() && $validated['level'] !== 'admin') {
            return back()->withErrors([
                'level' => 'Level akun admin yang sedang digunakan tidak dapat diubah.'
            ])->withInput();
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }
    // Menghapus data user
    public function destroy(User $user)
    {
        // Mencegah penghapusan akun sendiri
        if ($user->id == auth()->id()) {
            return back()->withErrors([
                'user' => 'Akun yang sedang digunakan tidak dapat dihapus.'
            ]);
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Data user berhasil dihapus.');
    }
}