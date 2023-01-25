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
                    <th>Correo electronico</th>
                    <th>Telefonos</th>
                    <th>Fecha Actualizacion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($providers as $provider)
                    <tr>
                        <td> <a href="{{ route('admin.providers.show', $provider) }}"> {{ $provider->id }}</a></td>

                        <td><a href="{{ route('admin.providers.show', $provider) }}">{{ $provider->name }}</a></td>
                        <td><a href="{{ route('admin.providers.show', $provider) }}">{{ $provider->email }}</a></td>
                        <td><a href="{{ route('admin.providers.show', $provider) }}">{{ $provider->phone_number }}</a></td>
                        
                        </td>
                        <td>{{ $provider->updated_at }}</td>
                        <th>
                            <a href="" class="mx-1 shadow btn btn-xs btn-default text-primary" title="Editar">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <button class="mx-1 shadow btn btn-xs btn-default text-danger" title="Eliminar">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button><button class="mx-1 shadow btn btn-xs btn-default text-teal" title="Detalles">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </button>
                        </th>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>id</th>
                    <th>Empresa</th>
                    <th>Correo electronico</th>
                    <th>Telefonos</th>
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

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        console.log('Hi!');
        $(document).ready(function() {
            $('#productos').DataTable({
                "language": {
                    "search": "Buscar",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "paginate": {
                        "previus": "Anterior",
                        "next": "Siguiente",
                        "first": "Primero",
                        "last": "Último"
                    }
                }
            });
        });
    </script>
@stop
