<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CursoTec') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @hasSection('header')
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-grow">
                @yield('contenido')
            </main>

            <!-- Footer -->
            <footer class="bg-gray-800 text-white py-8 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">CursoTec</h3>
                            <p class="text-gray-300">
                                Plataforma educativa para la gestión de cursos y kits de robótica.
                            </p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Enlaces Rápidos</h3>
                            <ul class="space-y-2">
                                <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white">Dashboard</a></li>
                                <li><a href="{{ route('courses.index') }}" class="text-gray-300 hover:text-white">Cursos</a></li>
                                <li><a href="{{ route('robotics.index') }}" class="text-gray-300 hover:text-white">Kits de Robótica</a></li>
                                <li><a href="{{ route('users.index') }}" class="text-gray-300 hover:text-white">Usuarios</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Contacto</h3>
                            <p class="text-gray-300">
                                Email: info@cursotec.com<br>
                                Teléfono: +1 (555) 123-4567
                            </p>
                        </div>
                    </div>
                    <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                        <p class="text-gray-300">
                            &copy; {{ date('Y') }} CursoTec. Todos los derechos reservados.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>