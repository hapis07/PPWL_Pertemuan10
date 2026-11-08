<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') - Aplikasi Data Buku</title>

    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app.css') }}">

    <style>
        body {
            background-color: #f2f7ff;
            min-height: 100vh;
        }

        #auth {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
        }

        .auth-card {
            width: 100%;
            max-width: 460px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>

    <div id="auth">
        <div class="auth-card">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('mazer/assets/compiled/js/app.js') }}"></script>

</body>
</html>