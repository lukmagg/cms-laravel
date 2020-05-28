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
                    <i class="fas fa-boxes"></i>Productosss
                </h2>
            </div>
            <!-- Tabla  -->
            <div class="inside">
                <div class="btns">
                    <a href="{{ url('/admin/product/add') }}" class="btn btn-dark">
                        <i class="fas fa-plus"></i> Agregar producto
                    </a>
                </div>
                
                <table class="table">
                    
                    
                </table>
            </div>
        </div>
    </div>
@endsection

