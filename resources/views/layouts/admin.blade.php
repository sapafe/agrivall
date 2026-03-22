<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'AgriVall - Admin')</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('estil.css') }}">
    <style>
        /* Basic admin dashboard styles */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 20px;
        }

        .admin-sidebar a {
            color: white;
            display: block;
            padding: 10px 0;
            text-decoration: none;
        }

        .admin-sidebar a:hover {
            color: #18bc9c;
        }

        .admin-content {
            flex: 1;
            padding: 30px;
            background: #f4f6f9;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }

        .admin-table th,
        .admin-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
    </style>
</head>

<body>
    @include('partials.header')

    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2 style="color:white; margin-bottom: 20px;">Admin Panel</h2>
            <nav>
                <a href="{{ route('admin.products.index') }}"><i class="fa-solid fa-box"></i> Productos</a>
                <a href="{{ route('admin.orders.index') }}"><i class="fa-solid fa-shopping-cart"></i> Pedidos</a>
                <a href="{{ route('admin.weeks.index') }}"><i class="fa-solid fa-calendar-days"></i> Semanas</a>
            </nav>
        </aside>

        <main class="admin-content">
            @if(session('success'))
            <div class="alert alert-success"
                style="background:#d4edda; color:#155724; padding:10px; margin-bottom:20px; border-radius: 4px;">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger"
                style="background:#f8d7da; color:#721c24; padding:10px; margin-bottom:20px; border-radius: 4px;">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>

</html>