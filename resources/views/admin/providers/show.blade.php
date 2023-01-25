@extends('adminlte::page')
@section('title', 'Lista Proveedores')

@section('content_header')
    <h1>Listado de stock por tienda de {{ $provider->name }}</h1>
@stop

@section('content')


    <div class="container-flex">
        <div class="card card-info card-outline" bis_skin_checked="1">
            <div class="card-body" bis_skin_checked="1">

                <div class="card-body box-profile" bis_skin_checked="1">

                    <div class="row">
                        <h4><a href="#">Tienda La yaguara - Caracas</a></h4>
                        <div class="table-responsive p-0" bis_skin_checked="1">

                            <table class="table table-striped table-valign-middle">

                                <thead>

                                    <tr>
                                        <th>Productos</th>
                                        <th>stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>
                                            Margarina mavesa
                                        </td>
                                        <td>
                                            50
                                        </td>
                                    <tr>

                                    {{-- @foreach ($provider->products as $product)
                                        <tr>

                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                50
                                            </td>
                                        <tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>


                    </div>
                    <div class="row">
                        <h4><a href="#">San Diego - Valencia</a></h4>
                        <div class="table-responsive p-0" bis_skin_checked="1">

                            <table class="table table-striped table-valign-middle">

                                <thead>

                                    <tr>
                                        <th>Productos</th>
                                        <th>stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>
                                            Margarina mavesa
                                        </td>
                                        <td>
                                            50
                                        </td>
                                    <tr>

                                    {{-- @foreach ($provider->products as $product)
                                        <tr>

                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                50
                                            </td>
                                        <tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>

        </div>

    @endsection
