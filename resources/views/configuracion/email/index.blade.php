@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Configuracion</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Email</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Datos de la configuración del Email</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    <form action="{{ route('email.store') }}" method="POST">

                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="mail_username">Email</label>
                                <input type="email" class="form-control" name="mail_username" required
                                       value="{{ $config->mail_username }}">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="mail_password">Contraseña</label>
                                <input type="password" class="form-control" name="mail_password">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="mail_host">Host</label>
                                <input type="text" class="form-control" name="mail_host" required
                                       value="{{ $config->mail_host }}">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="mail_port">Puerto</label>
                                <input type="number" class="form-control" name="mail_port" required placeholder="587"
                                       value="{{ $config->mail_port }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="mail_driver">Email Driver</label>
                                <select name="mail_driver" id="mail_driver" class="form-control" required>
                                    <option value="smtp">SMTP</option>
                                    <option value="pop3">POP3</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                @can('Configuracion - Email | Modificar')
                                    <button class="btn btn-primary" type="submit">Guardar</button>
                                @endcan
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- end of col -->
    </div>
@endsection
