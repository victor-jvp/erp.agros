<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            @can('Prevision | Acceso')
                <li class="nav-item {{ request()->is('prevision/*') ? 'active' : '' }}" data-item="prevision">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Bar-Chart"></i>
                        <span class="nav-text">Previsión</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @can('Comercial | Acceso')
                <li class="nav-item {{ request()->is('comercial/*') ? 'active' : '' }}" data-item="comercial">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Library"></i>
                        <span class="nav-text">Comercial</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @can('Almacen | Acceso')
                <li class="nav-item {{ request()->is('almacen/*') ? 'active' : '' }}" data-item="almacen">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Suitcase"></i>
                        <span class="nav-text">Almacén</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @can('Departamento Tecnico | Acceso')
                <li class="nav-item" data-item="dpto_tecnico">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Computer-Secure"></i>
                        <span class="nav-text">Dpto. Técnico</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @can('Costes | Acceso')
                <li class="nav-item">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-File-Clipboard-File--Text"></i>
                        <span class="nav-text">Costes</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @can('Maestros | Acceso')
                <li class="nav-item {{ request()->is('maestros/*') ? 'active' : '' }}" data-item="maestros">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-File-Horizontal-Text"></i>
                        <span class="nav-text">Maestros</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @can('Configuracion | Acceso')
                <li class="nav-item" data-item="configuracion">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Administrator"></i>
                        <span class="nav-text">Configuración</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endcan
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->
        @can('Prevision | Acceso')
            <ul class="childNav" data-parent="prevision">
                @can('Prevision - Panel de Control | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='prevision.index' ? 'open' : '' }}"
                           href="{{ route('prevision.index') }}">
                            <i class="nav-icon i-Clock-3"></i>
                            <span class="item-name">Panel de control</span>
                        </a>
                    </li>
                @endcan
                @can('Prevision - Pedido Campo | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='pedidos-campo.index' ? 'open' : '' }}"
                           href="{{ route('pedidos-campo.index')  }}">
                            <i class="nav-icon i-Clock-4"></i>
                            <span class="item-name">Pedido Campo</span>
                        </a>
                    </li>
                @endcan
            </ul>
        @endcan
        @can('Comercial | Acceso')
            <ul class="childNav" data-parent="comercial">
                @can('Comercial - Dashboard | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='comercial.dashboard' ? 'open' : '' }}"
                           href="{{ route('comercial.dashboard') }}">
                            <i class="nav-icon i-Dashboard"></i>
                            <span class="item-name">Dashboard</span>
                        </a>
                    </li>
                @endcan
                @can('Comercial - Pedidos Comerciales | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='pedidos-comercial.index' ? 'open' : '' }}"
                           href="{{ route('pedidos-comercial.index') }}">
                            <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">Pedidos Comerciales</span>
                        </a>
                    </li>
                @endcan
                @can('Comercial - Clientes | Acceso')
                    <li class="nav-item">
                        <a class="{{ (Route::currentRouteName()=='clientes.index' || Request::is('comercial/clientes/*')) ? 'open' : '' }}"
                           href="{{ route('clientes.index') }}">
                            <i class="nav-icon i-Receipt"></i>
                            <span class="item-name">Clientes</span>
                        </a>
                    </li>
                @endcan
                @can('Comercial - Transportes | Acceso')
                    <li class="nav-item">
                        <a class="{{ (Route::currentRouteName()=='transportes.index' || Request::is('comercial/transportes/*')) ? 'open' : '' }}"
                           href="{{ route('transportes.index') }}">
                            <i class="nav-icon i-Receipt"></i>
                            <span class="item-name">Transportes</span>
                        </a>
                    </li>
                @endcan
            </ul>
        @endcan

        @can('Almacen | Acceso')
            <ul class="childNav" data-parent="almacen">
                @can('Almacen - Listado de Inventario | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='listado-inventario.index' ? 'open' : '' }}"
                           href="{{ url('almacen/listado-inventario') }}">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">Listado de Inventario</span>
                        </a>
                    </li>
                @endcan
                @can('Almacen - Entrada de Productos | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='entrada-productos.index' ? 'open' : '' }}"
                           href="{{ url('almacen/entrada-productos') }}">
                            <i class="nav-icon i-Arrow-Inside"></i>
                            <span class="item-name">Entrada de Productos</span>
                        </a>
                    </li>
                @endcan
                @can('Almacen - Salida de Productos | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='salida-productos.index' ? 'open' : '' }}"
                           href="{{ url('almacen/salida-productos') }}">
                            <i class="nav-icon i-Arrow-Outside"></i>
                            <span class="item-name">Salida de Productos</span>
                        </a>
                    </li>
                @endcan
                @can('Almacen - Histórico | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='historico_entradas.index' ? 'open' : '' }}"
                           href="{{ route('historico_entradas.index') }}">
                            <i class="nav-icon i-Folder-Archive"></i>
                            <span class="item-name">Histórico</span>
                        </a>
                    </li>
                @endcan
                @can('Almacen - Proveedores | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='proveedores.index' ? 'open' : '' }}"
                           href="{{ route('proveedores.index') }}">
                            <i class="nav-icon i-Receipt"></i>
                            <span class="item-name">Proveedores</span>
                        </a>
                    </li>
                @endcan
                @can('Almacen - Pedidos Producción | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='pedidos-produccion.index' ? 'open' : '' }}"
                           href="{{ route('pedidos-produccion.index') }}">
                            <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">Pedidos Producción</span>
                        </a>
                    </li>
                @endcan
                @can('Almacen - Traza de Pedidos | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='traza-pedidos.index' ? 'open' : '' }}"
                           href="{{ route('traza-pedidos.index') }}">
                            <i class="nav-icon i-Windows-2"></i>
                            <span class="item-name">Traza de Pedidos</span>
                        </a>
                    </li>
                @endcan
            </ul>
        @endcan

        @can('Departamento Tecnico | Acceso')
            <ul class="childNav" data-parent="dpto_tecnico">
                @can('Departamento Tecnico - Informes | Acceso')
                    <li class="nav-item">
                        <a href="#imageCroper">
                            <i class="nav-icon i-Crop-2"></i>
                            <span class="item-name">Informes</span>
                        </a>
                    </li>
                @endcan
                @can('Departamento Tecnico - Panel de Control | Acceso')
                    <li class="nav-item">
                        <a href="#loader">
                            <i class="nav-icon i-Loading-3"></i>
                            <span class="item-name">Panel de Control</span>
                        </a>
                    </li>
                @endcan
            </ul>
        @endcan

        @can('Maestros | Acceso')
            <ul class="childNav" data-parent="maestros">
                @can('Maestros - Materiales | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='materiales' ? 'open' : '' }}"
                           href="{{ url('maestros/materiales') }}">
                            <i class="nav-icon i-Box-Full"></i>
                            <span class="item-name">Materiales</span>
                        </a>
                    </li>
                @endcan
                @can('Maestros - Familias y Marcas | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='familias-marcas' ? 'open' : '' }}"
                           href="{{ url('maestros/familias-marcas') }}">
                            <i class="nav-icon i-Handshake"></i>
                            <span class="item-name">Familias y Marcas</span>
                        </a>
                    </li>
                @endcan
                @can('Maestros - Fincas | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='fincas' ? 'open' : '' }}"
                           href="{{ url('maestros/fincas') }}">
                            <i class="nav-icon i-Post-Office"></i>
                            <span class="item-name">Fincas</span>
                        </a>
                    </li>
                @endcan
                @can('Maestros - Productos Compuestos | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='productos-compuestos.index' ? 'open' : '' }}"
                           href="{{ route('productos-compuestos.index') }}">
                            <i class="nav-icon i-Split-Horizontal-2-Window"></i>
                            <span class="item-name">Productos Compuestos</span>
                        </a>
                    </li>
                @endcan
                @can('Maestros - Trazabilidad | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='trazabilidad' ? 'open' : '' }}"
                           href="{{ url('maestros/trazabilidad') }}">
                            <i class="nav-icon i-Medal-2"></i>
                            <span class="item-name">Trazabilidad</span>
                        </a>
                    </li>
                @endcan
            </ul>
        @endcan

        @can('Configuracion | Acceso')
            <ul class="childNav" data-parent="configuracion">
                @can('Configuracion - Datos Fiscales Empresa | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='datos-fiscales.show' ? 'open' : '' }}"
                           href="{{ route('datos-fiscales.show') }}">
                            <i class="nav-icon i-Checked-User"></i>
                            <span class="item-name">Datos Fiscales Empresa</span>
                        </a>
                    </li>
                @endcan
                @can('Configuracion - Usuarios | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='usuarios.index' ? 'open' : '' }}"
                           href="{{ route('usuarios.index') }}">
                            <i class="nav-icon i-Find-User"></i>
                            <span class="item-name">Usuarios</span>
                        </a>
                    </li>
                @endcan
                @can('Configuracion - Roles de Usuarios | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='roles.index' ? 'open' : '' }}"
                           href="{{ route('roles.index') }}">
                            <i class="nav-icon i-Find-User"></i>
                            <span class="item-name">Roles de Usuarios</span>
                        </a>
                    </li>
                @endcan
                @can('Configuracion - Email | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='email.index' ? 'open' : '' }}"
                           href="{{ route('email.index') }}">
                            <i class="nav-icon i-Email"></i>
                            <span class="item-name">Email</span>
                        </a>
                    </li>
                @endcan
                @can('Configuracion - Campañas | Acceso')
                    <li class="nav-item">
                        <a href="#">
                            <i class="nav-icon i-Find-User"></i>
                            <span class="item-name">Campañas</span>
                        </a>
                    </li>
                @endcan
                @can('Configuracion - Especiales | Acceso')
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='especiales.index' ? 'open' : '' }}"
                           href="{{ url('configuracion/especiales') }}">
                            <i class="nav-icon i-Settings-Window"></i>
                            <span class="item-name">Especiales</span>
                        </a>
                    </li>
                @endcan
            </ul>
        @endcan
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->
