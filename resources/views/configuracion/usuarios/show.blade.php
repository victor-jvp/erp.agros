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

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Datos del Usuario</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                        @csrf

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
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" placeholder="Contraseña"
                                       required=""
                                       name="password" minlength="4" maxlength="16">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirm_password">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="confirm_password"
                                       placeholder="Confirmar Contraseña" required="" minlength="4" maxlength="16">


                                <span class="invalid-feedback" role="alert" id="password_error">
                                <strong>La contraseñas ingresadas no coinciden</strong>
                            </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- end of col -->
    </div>
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>

    <script>
        $(function () {
            $("#password_error").hide();

            $("#password, #confirm_password").keypress(function () {
                if ($("#password_error").is(':visible') == true){
                    $("#password_error").hide();
                }
            });
        });

        $('form').submit(function (e) {
            var password = $("#password").val();
            var c_password = $("#confirm_password").val();

            if (password != c_password) {
                e.preventDefault();
                $("#password_error").show();
            }
        });
    </script>
@endsection
