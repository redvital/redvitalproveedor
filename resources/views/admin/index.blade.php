@extends('adminlte::page')
@section('title', 'Escritorio')

@section('content_header')
    <h1>Inteligencia de Gestion Corporativa</h1>
@stop

@section('content')
    <p>Bienvenido al Panel de Administrador.</p>
    <div class="container">

        <div class="row">
            <div class="col">
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                      <h3>{{$teams->count()}}</h3>
                      <p>Proveedores Registrados</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="admin/proveedores" class="small-box-footer">
                        Más información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                  </div>
            </div>
            <div class="col">
                <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{$productos->count()}}</h3>
                      <p>Productos Registrados</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="admin/productos" class="small-box-footer">
                      Más información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                  </div>
              </div>
            </div>
            <div class="col">
                <div class="small-box bg-gradient-danger">
                    <div class="inner">
                      <h3>2</h3>
                      <p>Proveedores en Lista</p>
                    </div>
                    <div class="icon">
                      <i class="far fa-envelope"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Más información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                  </div>
            </div>
          </div>

        
          
    
      
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop