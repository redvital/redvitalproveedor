@extends('adminlte::page')
@section('title', 'Lista Proveedores')

@section('content_header')
    <h1>Listado de Proveedores</h1>
@stop

@section('content')
  
          
    
      
          <div class="container-flex">
              
          
            <table id="productos" class="table mt-4 shadow-lg table-striped" style="width:100%">
              <thead>
                  <tr>
                      <th>id</th>
                      <th>Empresa</th>
                      <th>Productos</th>
                      <th>Telefonos</th>
                      <th>Correo</th>
                      <th>Ciudad</th>
                      <th>Fecha Actualizacion</th>
                      <th>Acciones</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($teams as $team)
                  <tr>
                      <td>{{ $team->id }}</td>
                      
                      <td>{{ $team->name }}</td>
                      <td>5</td>
                      <td></td>
                      <td></td>
                      <td>Valencia</td>
                      <td>{{ $team->updated_at }}</td>
                      <th><button class="mx-1 shadow btn btn-xs btn-default text-primary" title="Editar">
                          <i class="fa fa-lg fa-fw fa-pen"></i>
                      </button><button class="mx-1 shadow btn btn-xs btn-default text-danger" title="Eliminar">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button><button class="mx-1 shadow btn btn-xs btn-default text-teal" title="Detalles">
                          <i class="fa fa-lg fa-fw fa-eye"></i>
                      </button></th> 
                  </tr>
                  @endforeach
              </tbody>
              <tfoot>
                  <tr>
                    <th>id</th>
                    <th>Empresa</th>
                    <th>Productos</th>
                    <th>Telefonos</th>
                    <th>Correo</th>
                    <th>Ciudad</th>
                    <th>Fecha Actualizacion</th>
                    <th>Acciones</th>
                  </tr>
              </tfoot>
          </table>
      </div>
  @stop
  
  @section('css')
      <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
  @stop
  
  @section('js')
  
      <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
      <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" ></script>
      <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js" ></script>
      <script> console.log('Hi!');
      $(document).ready(function () {
          $('#productos').DataTable({
              "language" : {
                  "search": "Buscar",
                  "lengthMenu": "Mostrar _MENU_ registros por página",
                  "info": "Mostrando página _PAGE_ de _PAGES_",
                  "paginate": {
                      "previus":"Anterior",
                      "next": "Siguiente",
                      "first": "Primero",
                        "last": "Último"
                  }
              }
          });
      });
  </script>
  @stop