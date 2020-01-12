@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Configuración</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Nuevo Usuario</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="card user-profile o-hidden mb-4">
        <div class="header-cover" style="background-image: url('/assets/images/photo-wide-4.jpg')"></div>
        <div class="user-info">
            <img class="profile-picture avatar-lg mb-2" src="/assets/images/faces/1.jpg" alt="">
            {{--            <p class="m-0 text-24">{{ $usuario->name }}</p>--}}
            {{--            <p class="text-muted m-0">{{ $usuario->cargo }}</p>--}}
        </div>
        <div class="card-body">

            <form action="{{ route('usuarios.store') }}" method="POST" id="form">
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
                                       required name="name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" required=""
                                       name="email">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cargo">Cargo</label>
                                <input type="text" class="form-control" id="cargo" placeholder="" name="cargo"
                                       value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="telefono1">Telefono 1</label>
                                <input type="text" class="form-control" id="telefono1" placeholder=""
                                       name="telefono1" value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="telefono2">Telefono 2</label>
                                <input type="text" class="form-control" id="telefono2" placeholder=""
                                       name="telefono2" value="">
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
                                       name="confirm_password" placeholder="Confirmar Contraseña">
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="roles" role="tabpanel" aria-labelledby="about-tab">
                        <h4>Personal Information</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, commodi quam! Provident
                            quis
                            voluptate asperiores ullam, quidem odio pariatur. Lorem ipsum, dolor sit amet consectetur
                            adipisicing elit. Voluptatem, nulla eos?
                            Cum non ex voluptate corporis id asperiores doloribus dignissimos blanditiis iusto qui
                            repellendus deleniti aliquam, vel quae eligendi explicabo.
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 col-6">
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Calendar text-16 mr-1"></i> Birth Date</p>
                                    <span>1 Jan, 1994</span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Birth Place</p>
                                    <span>Dhaka, DB</span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Globe text-16 mr-1"></i> Lives In</p>
                                    <span>Dhaka, DB</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Gender</p>
                                    <span>1 Jan, 1994</span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Email</p>
                                    <span>example@ui-lib.com</span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Cloud-Weather text-16 mr-1"></i> Website
                                    </p>
                                    <span>www.ui-lib.com</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> Profession
                                    </p>
                                    <span>Digital Marketer</span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> Experience</p>
                                    <span>8 Years</span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> School</p>
                                    <span>School of Digital Marketing</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Other Info</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum dolore labore
                            reiciendis ab quo ducimus reprehenderit natus debitis, provident ad iure sed aut animi dolor
                            incidunt voluptatem. Blanditiis, nobis aut.</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-6 text-center">
                                <i class="i-Plane text-32 text-primary"></i>
                                <p class="text-16 mt-1">Travelling</p>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6 text-center">
                                <i class="i-Camera text-32 text-primary"></i>
                                <p class="text-16 mt-1">Photography</p>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6 text-center">
                                <i class="i-Car-3 text-32 text-primary"></i>
                                <p class="text-16 mt-1">Driving</p>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6 text-center">
                                <i class="i-Gamepad-2 text-32 text-primary"></i>
                                <p class="text-16 mt-1">Gaming</p>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6 text-center">
                                <i class="i-Music-Note-2 text-32 text-primary"></i>
                                <p class="text-16 mt-1">Music</p>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6 text-center">
                                <i class="i-Shopping-Bag text-32 text-primary"></i>
                                <p class="text-16 mt-1">Shopping</p>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validation/messages_es.js') }}"></script>

    <script>
        $(document).ready(function () {
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
                        required: true,
                        minlength: 4,
                        maxlength: 16,
                    },
                    confirm_password: {
                        required: true,
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
        });
    </script>
@endsection
