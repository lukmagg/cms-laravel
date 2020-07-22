@extends('admin.master')

@section('title', 'Editar usuario')

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
        <div class="page_user">
            <div class="row">
                    <div class="col-md-4">
                        <div class="panel shadow">
                            <!-- Titulo de Tabla de usuarios -->
                            <div class="header">
                                <h2 class="title">
                                    <i class="fas fa-user"></i>Información
                                </h2>
                            </div>
                            <!-- Tabla de usuarios -->
                            <div class="inside">
                                <div class="mini_profile">
                                    @if(is_null($u->avatar))
                                        <img src="{{ url('/static/img/avatar.png') }}" class="avatar">
                                    @else
                                        <img src="{{ url('/uploads/users/'.$u->id.'/'.$user->avatar) }}" class="avatar">
                                    @endif
                                    <div class="info">
                                        <span class="title"><i class="far fa-address-card"></i> Nombre:</span>
                                        <span class="text">{{ $u->name }} {{ $u->lastname }}</span>
                                        <span class="title"><i class="fas fa-user-tie"></i> Estado del usuario:</span>
                                        <span class="text">{{ getUserStatusArrayKey($u -> status) }}</span>
                                        <span class="title"><i class="far fa-envelope"></i> Correo electrónico:</span>
                                        <span class="text">{{ $u->email }}</span>
                                        <span class="title"><i class="far fa-calendar-alt"></i> Fecha de registro:</span>
                                        <span class="text">{{ $u->created_at }}</span>
                                        <span class="title"><i class="fas fa-user-shield"></i> Rol de usuario:</span>
                                        <span class="text">{{ getRoleUserArrayKey($u -> role) }}</span>
                                        
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="panel shadow">
                            <!-- Titulo de Tabla de usuarios -->
                            <div class="header">
                                <h2 class="title">
                                    <i class="fas fa-user-edit"></i>Editar Información
                                </h2>
                            </div>
                            <!-- Tabla de usuarios -->
                            <div class="inside">
                                
                            </div>
                        </div>
                    </div>

            </div>
        </div>
        
        
    </div>
@endsection