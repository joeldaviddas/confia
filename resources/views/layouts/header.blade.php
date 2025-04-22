<header class="header bg-white border-bottom py-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!-- Left side -->
            <div class="col-auto d-flex align-items-center">
                <!-- Mobile menu toggle -->
                <button id="sidebarToggle" class="btn btn-link text-dark d-lg-none me-3" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                
                <!-- Search form -->
                <form class="d-none d-md-flex">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="search" class="form-control form-control-sm bg-light border-0" placeholder="Buscar...">
                    </div>
                </form>
            </div>

            <!-- Right side -->
            <div class="col text-end">
                <ul class="nav align-items-center justify-content-end">
                    <!-- Notifications -->
                    <li class="nav-item dropdown me-3">
                        <button class="btn btn-link text-dark position-relative p-0" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                2
                                <span class="visually-hidden">notificaciones sin leer</span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end border-0 shadow-sm" style="width: 320px;">
                            <div class="p-3 border-bottom">
                                <h6 class="mb-0">Notificaciones</h6>
                            </div>
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-box text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="mb-0">Nuevo producto agregado</p>
                                            <small class="text-muted">Hace 5 minutos</small>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-user-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="mb-0">Nuevo cliente registrado</p>
                                            <small class="text-muted">Hace 10 minutos</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2 border-top text-center">
                                <a href="#" class="text-decoration-none">Ver todas las notificaciones</a>
                            </div>
                        </div>
                    </li>

                    <!-- User menu -->
                    <li class="nav-item dropdown">
                        <button class="btn btn-link text-dark p-0 d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                            <div class="position-relative me-2">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4F46E5&color=fff" class="rounded-circle" width="32" height="32" alt="{{ Auth::user()->name }}">
                                <span class="position-absolute bottom-0 end-0 transform translate-middle badge border-2 border-white rounded-circle bg-success p-1">
                                    <span class="visually-hidden">Online</span>
                                </span>
                            </div>
                            <span class="d-none d-lg-block me-1">Admin</span>
                            <i class="fas fa-chevron-down small"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="fas fa-user me-2 text-muted"></i>
                                    Mi Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="fas fa-cog me-2 text-muted"></i>
                                    Configuración
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="px-4 py-1">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger p-0 d-flex align-items-center w-100">
                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
