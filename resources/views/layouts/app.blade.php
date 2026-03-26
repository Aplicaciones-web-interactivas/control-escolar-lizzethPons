<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Escolar</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .topbar {
            background: #1e3a8a;
            color: white;
            padding: 16px 24px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .topbar-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 8px;
            transition: 0.2s;
        }

        .nav-links a:hover {
            background: rgba(255,255,255,0.15);
        }

        .main-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 16px;
        }

        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.08);
            padding: 24px;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 28px;
        }

        h2 {
            margin-top: 0;
        }

        p {
            line-height: 1.5;
        }

        .actions-top {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            transition: 0.2s;
            background: #2563eb;
            color: white;
        }

        .btn:hover {
            opacity: 0.92;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-success {
            background: #16a34a;
            color: white;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            background: white;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .checkbox-group input {
            width: auto;
            margin: 0;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            min-width: 700px;
        }

        th {
            background: #eff6ff;
            color: #1e3a8a;
            text-align: left;
            padding: 12px;
            font-size: 14px;
        }

        td {
            padding: 12px;
            border-top: 1px solid #e5e7eb;
            vertical-align: middle;
            font-size: 14px;
        }

        tr:hover td {
            background: #f9fafb;
        }

        .inline {
            display: inline-block;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .info-box {
            background: #f8fafc;
            border-left: 5px solid #2563eb;
            padding: 18px;
            border-radius: 10px;
        }

        .auth-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 0 16px;
        }

        .auth-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .auth-subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 25px;
        }

        .footer-note {
            margin-top: 18px;
            color: #6b7280;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }

            .topbar-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-links {
                width: 100%;
            }

            .nav-links a {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    @auth
    <div class="topbar">
        <div class="topbar-content">
            <div class="brand">Control Escolar</div>

            <div class="nav-links">
                <a href="{{ route('home') }}">Inicio</a>
                <a href="{{ route('users.index') }}">Usuarios</a>
                <a href="{{ route('materias.index') }}">Materias</a>
                <a href="{{ route('horarios.index') }}">Horarios</a>
                <a href="{{ route('grupos.index') }}">Grupos</a>
                <a href="{{ route('inscripciones.index') }}">Inscripciones</a>
                <a href="{{ route('calificaciones.index') }}">Calificaciones</a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
    @endauth

    @guest
    <div class="topbar">
        <div class="topbar-content">
            <div class="brand">Control Escolar</div>
        </div>
    </div>
    @endguest

    <div class="@auth main-container @else auth-container @endauth">
        <div class="card">
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert-error">
                    <ul style="margin:0; padding-left:20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

</body>
</html>