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
                            <i class="fas fa-edit"></i> Editar Categoria
                        </h2>
                    </div>
                    
                    <div class="inside">
                        {!! Form::open(['url' => '/admin/category/'.$cat->id.'/edit']) !!}
                            
                            <!-- Input para el nombre de la categoria -->
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basoc-addon1">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                </div>
                                {!! Form::text('name', $cat->name, ['class' => 'form-control']) !!}
                            </div>
                            
                            <!-- Selector de categorias -->
                            <label for="module" class="mtop16">Módulo:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basoc-addon1">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                </div>
                                {!! Form::select('module', getModulesArray(), $cat->module, ['class' => 'custom-select']) !!}
                            </div>
                            <!-- Input para el icono de la categoria -->
                            <label for="icon" class="mtop16">Icono:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basoc-addon1">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                </div>
                                {!! Form::text('icon', $cat->icon, ['class' => 'form-control']) !!}
                            </div>
                        {!! Form::submit('Guardar', ['class' => 'btn btn-dark mtop16']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            
        </div>
    </div>

    
@endsection