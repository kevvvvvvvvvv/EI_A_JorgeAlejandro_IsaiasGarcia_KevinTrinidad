<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imperial Hall</title>
    <link rel="stylesheet" href="{{ URL::asset('css/layaout.css'); }}">
    @yield('header')
</head>
<body>
    <nav class="navbar">
        <div class="logo-container">
            <img src="{{ URL::asset('images/logo.png'); }}" alt="Imperial Hall Logo">
            <span class="logo-text">Imperial Hall</span>
        </div>

        <div class="menu-toggle" id="menuToggle">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="nav-links" id="navLinks">

            @if (!Auth::check())

            <div class="auth-buttons">
                <a class="btn btn-primary" href="{{ route('login') }}">Iniciar sesión</a>
                <a class="btn btn-secondary" href="{{ route('register') }}">Registrarse</a>
            </div>

            @else

            <div class="dropdown">
                <button class="dropdown-btn">Salones</button>
                <div class="dropdown-content">
                    <a  href="{{ route('salons.index') }}">Salón Imperial</a>
                    <a href="#">Salón Real</a>
                    <a href="#">Salón Ejecutivo</a>
                    <a href="#">Salón de Fiestas</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">{{ auth()->user()->name }}</button>
                <div class="dropdown-content">
                    <a href="{{route('profile.edit')}}">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
        
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>

            @endif
        </div>
    </nav>

    @yield('content')

    <script src="{{ URL::asset('js/layout.js'); }}"></script>
    @yield('footer')
</body>
</html>