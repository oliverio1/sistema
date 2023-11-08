<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>Recepción <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        @can('Leer ordenes')
            <li class="nav-item">
                <a href="{{ route('orders.index') }}"
                class="nav-link {{ Request::is('orders*') ? 'active' : '' }}">
                    <p>Registro</p>
                </a>
            </li>
        @endcan
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>Laboratorio <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        @can('Leer areas')
            <li class="nav-item">
                <a href="{{ route('areas.index') }}"
                class="nav-link {{ Request::is('areas*') ? 'active' : '' }}">
                    <p>Áreas</p>
                </a>
            </li>
        @endcan
        @can('Leer contenedores')
            <li class="nav-item">
                <a href="{{ route('containers.index') }}"
                class="nav-link {{ Request::is('containers*') ? 'active' : '' }}">
                    <p>Contenedores</p>
                </a>
            </li>
        @endcan
        @can('Leer tipos de muestra')
            <li class="nav-item">
                <a href="{{ route('specimens.index') }}"
                class="nav-link {{ Request::is('specimens*') ? 'active' : '' }}">
                    <p>Tipos de muestra</p>
                </a>
            </li>
        @endcan
        @can('Leer indicaciones')
            <li class="nav-item">
                <a href="{{ route('indications.index') }}"
                class="nav-link {{ Request::is('indications*') ? 'active' : '' }}">
                    <p>Indicaciones</p>
                </a>
            </li>
        @endcan
        @can('Leer estudios')
            <li class="nav-item">
                <a href="{{ route('studies.index') }}"
                class="nav-link {{ Request::is('studies*') ? 'active' : '' }}">
                    <p>Estudios</p>
                </a>
            </li>
        @endcan
        @can('Leer equipos')
            <li class="nav-item">
                <a href="{{ route('equipments.index') }}"
                class="nav-link {{ Request::is('equipments*') ? 'active' : '' }}">
                    <p>Equipos</p>
                </a>
            </li>
        @endcan
        @can('Leer termometros')
            <li class="nav-item">
                <a href="{{ route('thermometers.index') }}"
                class="nav-link {{ Request::is('thermometers*') ? 'active' : '' }}">
                    <p>Termómetros</p>
                </a>
            </li>
        @endcan
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>Calidad <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        @can('Leer calidad')
            <li class="nav-item">
                <a href="{{ route('qualities.index') }}"
                class="nav-link {{ Request::is('qualities*') ? 'active' : '' }}">
                    <p>SGC</p>
                </a>
            </li>
        @endcan
        @can('Leer incidencias')
            <li class="nav-item">
                <a href="{{ route('incidents.index') }}"
                class="nav-link {{ Request::is('incidents.index') ? 'active' : '' }}">
                    <p>Incidencias</p>
                </a>
            </li>
        @endcan
        @can('Leer incidencias')
            <li class="nav-item">
                <a href="{{ route('incidents.contact') }}"
                class="nav-link {{ Request::is('incidents.contact') ? 'active' : '' }}">
                    <p>Mensajes externos</p>
                </a>
            </li>
        @endcan
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>Inventario <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        @can('Leer reactivos')
            <li class="nav-item">
                <a href="{{ route('reagents.inventory') }}"
                class="nav-link {{ Request::is('reagents.inventory') ? 'active' : '' }}">
                    <p>Inventario</p>
                </a>
            </li>
        @endcan
        @can('Leer reactivos')
            <li class="nav-item">
                <a href="{{ route('reagents.index') }}"
                class="nav-link {{ Request::is('reagents.index') ? 'active' : '' }}">
                    <p>Reactivos</p>
                </a>
            </li>
        @endcan
        @can('Leer compras')
            <li class="nav-item">
                <a href="{{ route('purchases.index') }}"
                class="nav-link {{ Request::is('purchases*') ? 'active' : '' }}">
                    <p>Compras</p>
                </a>
            </li>
        @endcan
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>Administración <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        @can('Leer usuarios')
            <li class="nav-item">
                <a href="{{ route('users.index') }}"
                class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                    <p>Usuarios</p>
                </a>
            </li>
        @endcan
        @can('Leer roles')
            <li class="nav-item">
                <a href="{{ route('roles.index') }}"
                class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                    <p>Roles y permisos</p>
                </a>
            </li>
        @endcan
        @can('Leer proveedores')
            <li class="nav-item">
                <a href="{{ route('providers.index') }}"
                class="nav-link {{ Request::is('providers*') ? 'active' : '' }}">
                    <p>Proveedores</p>
                </a>
            </li>
        @endcan
        @can('Leer clientes')
            <li class="nav-item">
                <a href="{{ route('clients.index') }}"
                class="nav-link {{ Request::is('clients*') ? 'active' : '' }}">
                    <p>Clientes</p>
                </a>
            </li>
        @endcan
        @can('Leer medicos')
            <li class="nav-item">
                <a href="{{ route('medics.index') }}"
                class="nav-link {{ Request::is('medics*') ? 'active' : '' }}">
                    <p>Médicos</p>
                </a>
            </li>
        @endcan
    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('meetings.index') }}"
    class="nav-link {{ Request::is('meetings*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-circle"></i>
        <p>
            Agenda
            <span class="badge badge-info right">{{ $meetingsCount }}</span>
        </p>
    </a>
</li>