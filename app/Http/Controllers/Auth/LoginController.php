<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Tujuan halaman setelah berhasil login.
     *
     * @var string
     */
    protected $redirectTo = '/buku';

    /**
     * Tujuan halaman setelah logout.
     */
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}