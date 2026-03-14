<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Escolar</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f4f6f9; margin:0; }
        nav { background:#1f2937; color:white; padding:15px 25px; }
        nav a { color:white; text-decoration:none; margin-right:15px; }
        .container { width:90%; max-width:1000px; margin:30px auto; background:white; padding:20px; border-radius:10px; }
        .btn { display:inline-block; padding:8px 12px; background:#2563eb; color:white; text-decoration:none; border:none; border-radius:6px; cursor:pointer; }
        .btn-danger { background:#dc2626; }
        .btn-secondary { background:#6b7280; }
        input { width:100%; padding:10px; margin-top:5px; margin-bottom:15px; border:1px solid #ccc; border-radius:6px; box-sizing:border-box; }
        table { width:100%; border-collapse:collapse; margin-top:15px; }
        th, td { padding:10px; border:1px solid #ddd; text-align:left; }
        .alert-success { background:#dcfce7; color:#166534; padding:10px; border-radius:6px; margin-bottom:15px; }
        .alert-error { background:#fee2e2; color:#991b1b; padding:10px; border-radius:6px; margin-bottom:15px; }
        .inline { display:inline; }
    </style>
</head>
<body>

    @auth
    <nav>
        <a href="{{ route('home') }}">Inicio</a>
        <a href="{{ route('users.index') }}">Usuarios</a>
        <a href="{{ route('materias.index') }}">Materias</a>

        <form action="{{ route('logout') }}" method="POST" class="inline" style="float:right;">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar sesión</button>
        </form>
    </nav>
    @endauth

    <div class="container">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>