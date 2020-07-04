@extends('admin.master')

@section('title', 'Productos')

@section('breadcrumb')
    <!-- Breadcrumb - Icono y Titulo -->
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}">
            <i class="fas fa-boxes"></i>Productos
        </a>
    </li>
@endsection



@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <!-- Titulo de  -->
            <div class="header">
                <h2 class="title">
                    <i class="fas fa-boxes"></i>Productosss!!!
                </h2>
            </div>
            <!-- Tabla  -->
            <div class="inside">
                <div class="btns">
                    <a href="{{ url('/admin/product/add') }}" class="btn btn-dark">
                        <i class="fas fa-plus"></i> Agregar producto
                    </a>
                </div>
                
                <table class="table table-striped mtop16">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td></td>
                            <td>Nombre</td>
                            <td>Categoria</td>
                            <td>Precio</td>
                            <td></td>
                        </tr>
                        <tbody>
                            @foreach($products as $p)
                                <tr>
                                    <td width="70">{{ $p->id }}</td>
                                    
                                    <td width="120">
                                        <a href="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}" data-fancybox="gallery">
                                            <img src="{{ url('/uploads/'.$p->file_path.'/t_'.$p->image) }}">
                                        </a>
                                    </td>
                                    
                                    <td>
                                        {{$p->name}}
                                    </td>
                                        
                                    <td width="150">
                                        {{ $p->cat->name }}
                                    </td>
                                    
                                    <td width="50">
                                        {{$p->price}}
                                    </td>
                                    
                                    <td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </theade>                    
                    
                </table>
            </div>
        </div>
    </div>
@endsection









