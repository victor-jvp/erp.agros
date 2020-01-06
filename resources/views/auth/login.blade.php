<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de Sesión | ERP Agros</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/css/themes/lite-purple.min.css">
</head>

<body class="text-left">
<div class="auth-layout-wrap" style="background-image: url(./assets/images/photo-wide-4.jpg)">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4">
                            <img src="{{ asset('assets/images/LOGO-ERP-MORADO2.png') }}" alt="">
                        </div>
                        <h1 class="mb-3 text-18">Inicio de Sesión</h1>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                {{--                                <input id="email" class="form-control form-control-rounded" type="email">--}}
                                <input id="email" type="email"
                                       class="form-control form-control-rounded @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                {{--                                <input id="password" class="form-control form-control-rounded" type="password">--}}
                                <input id="password" type="password"
                                       class="form-control form-control-rounded @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-rounded btn-primary btn-block mt-2">Iniciar Sesión</button>

                        </form>

                        <div class="mt-3 text-center">
{{--                            <a href="forgot.html" class="text-muted"><u>Olvidé mi contraseña...</u></a>--}}
                            @if (Route::has('password.request'))
                                <a class="text-muted" href="{{ route('password.request') }}">
                                    <u>Olvidé mi contraseña...</u>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
<script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="assets/js/es5/script.min.js"></script>
</body>

</html>
