<style>
#map {
    height: 500px;
    width: 100%;
}
#output {
    margin-top: 10px;
}


.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    background-color: white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    position: sticky;
    top: 0;
    width: 100%;
    z-index: 1000;
    height: 85px;
}

.logo-container {
    display: flex;
    align-items: center;
}

.logo-container img {
    height: 40px;
    margin-right: 20px;
    margin-left: 20px;
}

.logo-text {
    font-size: 1.5rem;
    font-weight: bold;
    color: #000;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.dropdown {
    position: relative;
    display: inline-block;
    margin-right:50px;
}

.dropdown-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1rem;
    color: #000;
    padding: 0.5rem 0;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    z-index: 1;
    border-radius: 4px;
    min-width: 100%; /* Hace que el ancho sea igual al del botón */
    width: auto;
    box-sizing: border-box; /* Incluye padding y border en el ancho */
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.auth-buttons {
    display: flex;
    gap: 1rem;
}

.btn {
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #000;
    color: white;
    border: none;
    text-decoration: none
}

.btn-secondary {
    background-color: transparent;
    color: #000;
    border: none;
    text-decoration: none;
}

.btn:hover {
    opacity: 0.8;
}

.menu-toggle {
    display: none;
    flex-direction: column;
    justify-content: space-between;
    width: 30px;
    height: 21px;
    cursor: pointer;
}

.menu-toggle span {
    height: 3px;
    width: 100%;
    background-color: #000;
    border-radius: 10px;
    
}

@media (max-width: 768px) {
    .menu-toggle {
        display: flex;
    }

    .nav-links {
        position: absolute;
        top: 70px;
        left: 0;
        flex-direction: column;
        width: 100%;
        background-color: white;
        box-shadow: 0 5px 5px rgba(0,0,0,0.1);
        padding: 1rem 0;
        gap: 0;
        display: none;
        z-index: 2;
    }

    .nav-links.active {
        display: flex;
    }

    .dropdown {
        width: 100%;
        text-align: center;
    }

    .dropdown-btn {
        width: 100%;
        padding: 1rem 0;
    }

    .dropdown-content {
        position: relative;
        width: 100%;
        box-shadow: none;
    }

    .auth-buttons {
        width: 100%;
        flex-direction: column;
        gap: 0.5rem;
        padding: 1rem 2rem;
    }

    .btn {
        width: 100%;
        text-align: center;
    }
}
</style>

<nav class="navbar">
    <div class="logo-container">
        <a href="/">
            <img src="{{ URL::asset('images/logo.png'); }}" alt="Imperial Hall Logo">
        </a>
        <span class="logo-text">Imperial Hall</span>
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

<script src="{{ URL::asset('js/layout.js'); }}"></script>