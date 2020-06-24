@extends('admin.master')

@section('title', 'Categorias')

@section('breadcrumb')
    <!-- Breadcrumb - Icono y Titulo -->
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories') }}">
            <i class="fas fa-folder-open"></i>Categorias
        </a>
    </li>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <!-- Titulo de  -->
                    <div class="header">
                        <h2 class="title">
                            <i class="fas fa-plus"></i>Agregar Categoria
                        </h2>
                    </div>
                    
                    <div class="inside">
                        {!! Form::open(['url' => '/admin/category/add']) !!}
                            
                            <!-- Input para el nombre de la categoria -->
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basoc-addon1">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                </div>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                            
                            <!-- Selector de categorias -->
                            <label for="module" class="mtop16">Módulo:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basoc-addon1">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                </div>
                                {!! Form::select('module', getModulesArray(), 0, ['class' => 'custom-select']) !!}
                            </div>
                            <!-- Input para el icono de la categoria -->
                            <label for="icon" class="mtop16">Icono:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basoc-addon1">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                </div>
                                {!! Form::text('icon', null, ['class' => 'form-control']) !!}
                            </div>
                        {!! Form::submit('Guardar', ['class' => 'btn btn-dark mtop16']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel shadow">
                    <!-- Titulo de  -->
                    <div class="header">
                        <h2 class="title">
                            <i class="fas fa-folder-open"></i>Categorias
                        </h2>
                    </div>
                    
                    <div class="inside">
                        <nav class="nav nav-pills nav-fill">
                            @foreach(getModulesArray() as $m => $k)
                                <a href="{{ url('/admin/categories/'.$m) }}" class="nav-link">
                                    <i class="fas fa-list"></i> {{ $k }}
                                </a>
                            @endforeach
                        </nav>
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td width="32"></td>
                                    <td>Nombre</td>
                                    <td width="140"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cats as $cat)
                                    <tr>
                                        <!-- htmlspecialchars_decode decodifica y dibuja el icono -->
                                        <td>{!! htmlspecialchars_decode($cat->icon) !!}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td>
                                            <div class="opts">
                                                <a href="{{ url('/admin/category/'.$cat->id.'/edit') }}"
                                                data-toggle="tooltip" data-placement="top" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ url('/admin/category/'.$cat->id.'/delete') }}"
                                                data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
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
        </div>
    </div>

@endsection