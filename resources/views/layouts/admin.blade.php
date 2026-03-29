<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'AgriVall - Admin')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Bootstrap para Backoffice -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/base.css', 'resources/css/admin.css'])
</head>

<body>
    @include('partials.header')

    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>Admin Panel</h2>
            <nav>
                <a href="{{ route('admin.products.index') }}"><i class="fa-solid fa-box"></i> Productos</a>
                <a href="{{ route('admin.orders.index') }}"><i class="fa-solid fa-shopping-cart"></i> Pedidos</a>
                <a href="{{ route('admin.weeks.index') }}"><i class="fa-solid fa-calendar-days"></i> Semanas</a>
            </nav>
        </aside>

        <main class="admin-content">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
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