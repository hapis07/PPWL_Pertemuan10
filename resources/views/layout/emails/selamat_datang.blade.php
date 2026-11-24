<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Selamat Datang</title>
</head>

<body style="font-family: Arial, sans-serif; color: #333;">

    <h2>Halo {{ $user->name }},</h2>

    <p>
        Terima kasih telah mendaftar di
        <b>{{ config('app.name') }}</b>
        menggunakan akun Google
        (<b>{{ $user->email }}</b>).
    </p>

    <p>
        Mulai sekarang Anda dapat login menggunakan akun Google
        tanpa perlu membuat atau mengingat password baru.
    </p>

    <p>
        Anda sekarang dapat mengakses aplikasi pengelolaan buku
        dan menggunakan fitur-fitur yang tersedia.
    </p>

    <p>
        <a href="{{ route('home') }}"
           style="background:#435ebe;
                  color:#fff;
                  padding:10px 18px;
                  border-radius:6px;
                  text-decoration:none;">
            Buka Dashboard
        </a>
    </p>

    <br>

    <p>Salam,</p>
    <p><b>Tim {{ config('app.name') }}</b></p>

</body>
</html>
