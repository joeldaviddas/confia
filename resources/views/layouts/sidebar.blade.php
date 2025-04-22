<!-- Sidebar Backdrop -->
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <!-- Header -->
    <div class="sidebar-header">
        <div class="logo-container">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="Logo" class="logo">
            <span class="logo-text">Confia App</span>
        </div>
    </div>

    <!-- Content -->
    <div class="sidebar-content">
        @auth
            <!-- User Info -->
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4F46E5&color=fff&bold=true" 
                     alt="{{ Auth::user()->name }}" 
                     class="user-avatar">
                <div class="user-details">
                    <h6 class="user-name">{{ Auth::user()->name }}</h6>
                    <span class="user-role">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav">
                <!-- Main Navigation -->
                <div class="nav-section">
                    <h6 class="nav-section-title">Principal</h6>
                    <ul class="nav-items">
                        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <h6 class="nav-section-title">Inventario</h6>
                    <ul class="nav-items">
                        <li class="nav-item {{ request()->routeIs('productos.*') ? 'active' : '' }}">
                            <a href="{{ route('productos.index') }}" class="nav-link">
                                <i class="fas fa-box"></i>
                                <span>Productos</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('familias.*') ? 'active' : '' }}">
                            <a href="{{ route('familias.index') }}" class="nav-link">
                                <i class="fas fa-tags"></i>
                                <span>Familias</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('movimientos.*') ? 'active' : '' }}">
                            <a href="{{ route('movimientos.index') }}" class="nav-link">
                                <i class="fas fa-exchange-alt"></i>
                                <span>Movimientos</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <h6 class="nav-section-title">Contactos</h6>
                    <ul class="nav-items">
                        <li class="nav-item {{ request()->routeIs('personas.*') ? 'active' : '' }}">
                            <a href="{{ route('personas.index') }}" class="nav-link">
                                <i class="fas fa-users"></i>
                                <span>Personas</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('empresas.*') ? 'active' : '' }}">
                            <a href="{{ route('empresas.index') }}" class="nav-link">
                                <i class="fas fa-building"></i>
                                <span>Empresas</span>
                            </a>
                        </li>
                    </ul>
                </div>

                @if(Auth::user()->role === 'admin')
                    <div class="nav-section">
                        <h6 class="nav-section-title">Administración</h6>
                        <ul class="nav-items">
                            <li class="nav-item {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                                <a href="{{ route('usuarios.index') }}" class="nav-link">
                                    <i class="fas fa-user-cog"></i>
                                    <span>Usuarios</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            </nav>
        @else
            <div class="guest-menu">
                <h6 class="nav-section-title">Menú</h6>
                <ul class="nav-items">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Iniciar Sesión</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">
                            <i class="fas fa-user-plus"></i>
                            <span>Registrarse</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
</nav>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        const toggleButton = document.getElementById('sidebarToggle');

        if (toggleButton) {
            toggleButton.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                backdrop.classList.toggle('show');
                document.body.classList.toggle('sidebar-open');
            });
        }

        backdrop.addEventListener('click', function() {
            sidebar.classList.remove('show');
            backdrop.classList.remove('show');
            document.body.classList.remove('sidebar-open');
        });

        // Cerrar sidebar al hacer clic en enlaces en móvil
        const navLinks = sidebar.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('show');
                    backdrop.classList.remove('show');
                    document.body.classList.remove('sidebar-open');
                }
            });
        });
    });
</script>
@endpush
