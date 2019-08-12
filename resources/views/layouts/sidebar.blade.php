
    <div class="side-content-wrap">
        <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
            <ul class="navigation-left">
                <li class="nav-item {{ request()->is('prevision/*') ? 'active' : '' }}" data-item="prevision">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Bar-Chart"></i>
                        <span class="nav-text">Previsión</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item {{ request()->is('comercial/*') ? 'active' : '' }}" data-item="comercial">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Library"></i>
                        <span class="nav-text">Comercial</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item {{ request()->is('almacen/*') ? 'active' : '' }}" data-item="almacen">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Suitcase"></i>
                        <span class="nav-text">Almacén</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="dpto_tecnico">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Computer-Secure"></i>
                        <span class="nav-text">Dpto. Técnico</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                {{-- Costes --}}
                <li class="nav-item">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-File-Clipboard-File--Text"></i>
                        <span class="nav-text">Costes</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item {{ request()->is('maestros/*') ? 'active' : '' }}" data-item="maestros">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-File-Horizontal-Text"></i>
                        <span class="nav-text">Maestros</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="configuracion">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Administrator"></i>
                        <span class="nav-text">Configuración</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            </ul>
        </div>

        <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
            <!-- Submenu Dashboards -->
            <ul class="childNav" data-parent="prevision">
                <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='prevision' ? 'open' : '' }}" href="{{ url('prevision') }}">
                        <i class="nav-icon i-Clock-3"></i>
                        <span class="item-name">Panel de control</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Clock-4"></i>
                        <span class="item-name">Pedido Campo</span>
                    </a>    
                </li>
            </ul>
            <ul class="childNav" data-parent="comercial">
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                        <span class="item-name">Listado de Pedidos</span>
                    </a>
                </li>
                <li class="nav-item dropdown-sidemenu">
                    <a href="#">
                        <i class="nav-icon i-Receipt"></i>
                        <span class="item-name">Clientes</span>
                        <i class="dd-arrow i-Arrow-Down"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a class="{{ request()->is('comercial/clientes#datos-fiscales') ? 'open' : '' }}" href="{{ url('comercial/clientes#datos-fiscales') }}">
                                <i class="nav-icon i-Receipt"></i>
                                <span class="item-name">Datos Fiscales</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Datos Comerciales</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Datos Contactos</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Histórico de Pedidos</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Contactar por Email</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Documentación</span>
                            </a>
                        </li>
                        <li></li>
                    </ul>
                </li>
                <li class="nav-item dropdown-sidemenu">
                    <a href="#">
                        <i class="nav-icon i-Receipt"></i>
                        <span class="item-name">Proveedores</span>
                        <i class="dd-arrow i-Arrow-Down"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a class="{{ request()->is('comercial/proveedores#datos-fiscales') ? 'open' : '' }}" href="{{ url('comercial/proveedores#datos-fiscales') }}">
                                <i class="nav-icon i-Receipt"></i>
                                <span class="item-name">Datos Fiscales</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Datos Comerciales</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Datos Contactos</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Histórico de Entregas</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Contactar por Email</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Documentación</span>
                            </a>
                        </li>
                        <li></li>
                    </ul>
                </li>
                <li class="nav-item dropdown-sidemenu">
                    <a>
                        <i class="nav-icon i-Receipt"></i>
                        <span class="item-name">Transporte</span>
                        <i class="dd-arrow i-Arrow-Down"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt"></i>
                                <span class="item-name">Datos Fiscales</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Datos Contactos</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="#">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Contactos por Email</span>
                            </a>
                        </li>
                        <li></li>
                    </ul>
                </li>
            </ul>
            <ul class="childNav" data-parent="almacen">
                <li class="nav-item">
                    <a class="{{ Route::currentRouteName()=='listado-productos.index' ? 'open' : '' }}" href="{{ url('almacen/listado-productos') }}">
                        <i class="nav-icon i-Receipt-4"></i>
                        <span class="item-name">Listado de Inventario</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="{{ Route::currentRouteName()=='entrada-productos.index' ? 'open' : '' }}" href="{{ url('almacen/entrada-productos') }}">
                        <i class="nav-icon i-Arrow-Inside"></i>
                        <span class="item-name">Entrada de Productos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="{{ Route::currentRouteName()=='salida-productos.index' ? 'open' : '' }}" href="{{ url('almacen/salida-productos') }}">
                        <i class="nav-icon i-Arrow-Outside"></i>
                        <span class="item-name">Salida de Productos</span>
                    </a>
                </li>
            </ul>
            <ul class="childNav" data-parent="dpto_tecnico">
                <li class="nav-item">
                    <a href="#imageCroper">
                        <i class="nav-icon i-Crop-2"></i>
                        <span class="item-name">Informes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#loader">
                        <i class="nav-icon i-Loading-3"></i>
                        <span class="item-name">Panel de Control</span>
                    </a>
                </li>
            </ul>
            <ul class="childNav" data-parent="maestros">
                <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='materiales' ? 'open' : '' }}" href="{{ url('maestros/materiales') }}">
                        <i class="nav-icon i-Box-Full"></i>
                        <span class="item-name">Materiales</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="{{ Route::currentRouteName()=='familias-marcas' ? 'open' : '' }}" href="{{ url('maestros/familias-marcas') }}">
                        <i class="nav-icon i-Handshake"></i>
                        <span class="item-name">Familias y Marcas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="{{ Route::currentRouteName()=='fincas' ? 'open' : '' }}" href="{{ url('maestros/fincas') }}">
                        <i class="nav-icon i-Post-Office"></i>
                        <span class="item-name">Fincas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="{{ Route::currentRouteName()=='productos-compuestos' ? 'open' : '' }}" href="{{ url('maestros/productos-compuestos') }}">
                        <i class="nav-icon i-Split-Horizontal-2-Window"></i>
                        <span class="item-name">Productos Compuestos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="{{ Route::currentRouteName()=='trazabilidad' ? 'open' : '' }}" href="{{ url('maestros/trazabilidad') }}">
                        <i class="nav-icon i-Medal-2"></i>
                        <span class="item-name">Trazabilidad</span>
                    </a>
                </li>
            </ul>
            <ul class="childNav" data-parent="configuracion">
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Checked-User"></i>
                        <span class="item-name">Datos Fiscales Empresa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Add-User"></i>
                        <span class="item-name">Datos Comerciales</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Find-User"></i>
                        <span class="item-name">Usuarios de la Aplicación</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Find-User"></i>
                        <span class="item-name">Roles de Usuarios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Find-User"></i>
                        <span class="item-name">Configuración de Email</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Find-User"></i>
                        <span class="item-name">Campañas</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar-overlay"></div>
    </div>
    <!--=============== Left side End ================-->
