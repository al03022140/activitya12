<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'TECMILENIO')</title>
    
    <!-- CSS de Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        .header {
            padding: 20px 0;
            border-bottom: 1px solid black;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            border: 1px solid black;
        }
        
        .btn:hover {
            background: lightgray;
        }
        
        .card {
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid black;
        }
        
        .footer {
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
            border-top: 1px solid black;
        }
    </style>
</head>
<body>
    <!-- Navegación -->
    @include('layouts.navigation')
    
    <!-- Header Principal TECMILENIO -->
    <div class="header" style="text-align: center; padding: 30px 0; border-bottom: 2px solid black;">
        <div class="container">
            <h1 style="font-size: 2.5rem; font-weight: bold; margin: 0;">TECMILENIO</h1>
        </div>
    </div>
    
    <!-- Encabezado -->
    @hasSection('header')
    <div class="header">
        <div class="container">
            @yield('header')
        </div>
    </div>
    @endif
    
    <!-- Contenido Principal -->
    <div class="container">
        @yield('contenido')
    </div>
    
    <!-- Pie de página -->
    <div class="footer">
        <div class="container">
            <p>Universidad TECMILENIO</p>
        </div>
    </div>
</body>
</html>
    </div>
</body>
</html>