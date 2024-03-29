@extends('connect.master')

@section('title', 'Login')

@section('content')
    <div class="box box_login shadow">
    <div class="header">
        <a href="{{ url('/') }}">
            <img src="{{ url('/static/img/logoMars.jpg') }}">
        </a>
    </div>
        <!-- Formulario de Login -->
        <div class="inside">
            {!! Form::open(['url' => '/login']) !!}
            <label for="email">Correo electronico:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="far fa-envelope-open"></i>
                    </div>
                </div>
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>

            <label for="password" class="mtop16">Password:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('Ingresar', ['class' => 'btn btn-dark mtop16']) !!}
            
            {!! Form::close() !!}


            @if(Session::has('message'))
                <div class="container">
                    <div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display:none;">
                        {{ Session::get('message') }}
                        @if ($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <script>
                            $('.alert').slideDown();
                            setTimeout(function(){ $('.alert').slideUp(); }, 10000);
                        </script>
                    </div>
                </div>
            @endif

            <div class="mtop16 footer">
                <a href="{{ url('/register') }}">Registrarse</a>
                <a href="{{ url('/recover') }}">Recuperar contraseña</a>
            </div>
        </div>

    </div>
@stop