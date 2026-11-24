<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang</title>
</head>
<body>
    <h2>Selamat Datang, {{ $user->name }}!</h2>

    <p>
        Terima kasih telah mendaftar di
        {{ config('app.name') }}.
    </p>

    <p>
        Akun kamu berhasil dibuat menggunakan Google.
    </p>

    <p>
        Email: {{ $user->email }}
    </p>

    <a href="{{ url('/buku') }}">
        Lihat Daftar Buku
    </a>

    <p>
        Terima kasih.
    </p>
</body>
</html>
