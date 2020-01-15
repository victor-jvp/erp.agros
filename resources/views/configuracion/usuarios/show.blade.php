@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Configuración</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Modificar Usuario</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="card user-profile o-hidden mb-4">
        <div class="header-cover" style="background-image: url('/assets/images/photo-wide-4.jpg')"></div>
        <div class="user-info">
            <img class="profile-picture avatar-lg mb-2" src="/assets/images/faces/1.jpg" alt="">
            <p class="m-0 text-24">{{ $usuario->name }}</p>
            <p class="text-muted m-0">{{ $usuario->cargo }}</p>
        </div>
        <div class="card-body">

            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" id="form">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div id="full_invalids" class="text-right text-danger font-weight-bold"></div>
                    </div>
                </div>


                <ul class="nav nav-tabs profile-nav mb-4" id="profileTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="timeline-tab" data-toggle="tab" href="#personales"
                           role="tab"
                           aria-controls="personales" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="about-tab" data-toggle="tab" href="#roles" role="tab"
                           aria-controls="roles"
                           aria-selected="false">Asignar Roles</a>
                    </li>
                </ul>

                <div class="tab-content" id="profileTabContent">
                    <div class="tab-pane fade active show" id="personales" role="tabpanel"
                         aria-labelledby="timeline-tab">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Nombre y Apellido</label>
                                <input type="text" class="form-control" id="name" placeholder="Nombre y Apellido"
                                       required="" name="name" value="{{ $usuario->name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" required=""
                                       name="email" value="{{ $usuario->email }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cargo">Cargo</label>
                                <input type="text" class="form-control" id="cargo" name="cargo"
                                       value="{{ $usuario->cargo }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="telefono1">Telefono 1</label>
                                <input type="text" class="form-control" id="telefono1" name="telefono1"
                                       value="{{ $usuario->telefono1 }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="telefono2">Telefono 2</label>
                                <input type="text" class="form-control" id="telefono2" name="telefono2"
                                       value="{{ $usuario->telefono2 }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" placeholder="Contraseña"
                                       name="password">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirm_password">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="confirm_password"
                                       name="confirm_password"
                                       placeholder="Confirmar Contraseña">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-3 mb-3 ">
                                <label for="created_at">Fecha de Alta</label>
                                <h5>{{ date('d/m/Y h:i:s a', strtotime($usuario->created_at)) }}</h5>
                            </div>
                            <div class="col-md-3 mb-3 ">
                                <label for="created_at">Ultima Modif.</label>
                                <h5>{{ date('d/m/Y h:i:s a', strtotime($usuario->updated_at)) }}</h5>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="roles" role="tabpanel" aria-labelledby="about-tab">
                        <h4>Asignar Roles</h4>

                        <hr>

                        <div class="row">
                            <div class="col-md-6 offset-md-2 mb-3">
                                <label for="rol">Roles</label>
                                <select class="form-control chosen" id="rol" name="rol">
                                    <option value=""></option>
                                    @if(isset($roles))
                                        @foreach($roles as $rol)
                                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <br>
                                <button type="button" class="btn btn-outline-primary m-1" id="btnAddRol">Agregar
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 offset-md-2 table-responsive">
                                <table id="table_roles"
                                       class="table table-striped table-bordered table-sm table-condensed"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Permisos</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($usuario->roles as $rol)
                                        <tr>
                                            <td>{{ $rol->id }}</td>
                                            <td>{{ $rol->name }} <input type="hidden" name="roles[]"
                                                                        value="{{ $rol->name }}"></td>
                                            @php($permisos = "")
                                            @foreach ($rol->permissions as $permiso)
                                                @php($permisos .= $permiso->name."<br>")
                                            @endforeach
                                            <td>{!! $permisos !!}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-danger mr-2 delete"
                                                   data-toggle="tooltip" data-placement="top" title=""
                                                   data-original-title="Borrar">
                                                    <i class="nav-icon i-Close-Window font-weight-bold "></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>


@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/bootstrap-select.min.css')}}">
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validation/messages_es.js') }}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/i18n/defaults-es_ES.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(".chosen").selectpicker({
                liveSearch: true
            });

            $('#form').validate({
                ignore: "",
                rules: {
                    email: {
                        email: true,
                    },
                    telefono1: {
                        digits: true
                    },
                    telefono2: {
                        digits: true
                    },
                    password: {
                        minlength: 4,
                        maxlength: 16,
                    },
                    confirm_password: {
                        minlength: 4,
                        maxlength: 16,
                        equalTo: '#password',
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback ');
                    error.insertAfter(element);
                    $("#form").addClass('needs-validation was-validated');
                },
                showErrors: function (errorMap, errorList) {
                    var invalidos = this.numberOfInvalids();
                    var html = "";
                    if (invalidos > 0) {
                        html = "Existen " + this.numberOfInvalids() + " campos no validos";
                        this.defaultShowErrors();
                    }
                    $("#full_invalids").html(html);
                }
            });

            table_roles = $('#table_roles').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0],
                    visible: false
                },
                    {
                        targets: [3],
                        className: 'text-center'
                    },
                ],
                order: [
                    [0, 'desc']
                ],
                searching: false,
                ordering: false,
                paging: false,
                info: false,
            });

            //Agregar rol a tabla
            $("#btnAddRol").on('click', function (e) {
                var id = $("#rol").val();
                if (id != "") {
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('roles.details') }}",
                        dataType: 'JSON',
                        data: {
                            id: id
                        },
                        success: function (data) {
                            if (data == null) return;

                            var permisos = "";
                            var opciones =
                                '<a href="javascript:void(0);" class="text-danger mr-2"\n' +
                                'onclick="DeleteRow(' + data.id + ')" data-toggle="tooltip"\n' +
                                'data-placement="top" title="" data-original-title="Borrar">\n' +
                                ' <i class="nav-icon i-Close-Window font-weight-bold"></i>\n' +
                                '</a>';
                            for (var i = 0; i < data.permissions.length; i++) {
                                var permiso = data.permissions[i];

                                permisos = permisos + permiso.name + "<br>";
                            }

                            table_roles.row.add([
                                data.id,
                                data.name + '<input type="hidden" name="roles[]" value="' + data.name + '"/>',
                                permisos,
                                opciones,
                            ]).draw();
                        },
                        error: function (error) {
                            console.log(error);
                            alert('Error. Check Console Log');
                        },
                    });
                }
            });

            $('#table_roles .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_roles.row(tr).remove().draw();
            });
        });

    </script>
@endsection
