@extends('admin.master')

@section('title', 'Usuarios')

@section('breadcrumb')
    <!-- Breadcrumb -->
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}">
            <i class="fas fa-user-friends"></i>Usuarios
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <!-- Titulo de Tabla de usuarios -->
            <div class="header">
                <h2 class="title">
                    <i class="fas fa-user-friends"></i>Usuarios
                </h2>
            </div>
            <!-- Tabla de usuarios -->
            <div class="inside">
                <table class="table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Apellido</td>
                            <td>Email</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Bucle para dibujar por pantalla los usuarios pasados como parametro en $users -->
                        <!-- $users es pasada como parametro desde UserController@getUsers -->
                        <!-- $users es un arreglo -->

                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="opts">
                                        <a href="{{ url('/admin/user/'.$user->id.'/edit') }}" data-toggler="tooltip" data-toggle="tooltip" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                       
                                    </div>  
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection