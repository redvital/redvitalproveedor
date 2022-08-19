@extends('adminlte::page')
@section('title', 'Escritorio')

@section('content_header')
    <h1>Editar: {{$producto->nombre}}</h1>
@stop

@section('content')
    <p>---</p>
    <div class="container">
        
        <div class="mb-2 md:flex col-12 md:justify-center md:items-center ">
            <div class="p-5 bg-white rounded-lg shadow-lg col-12 md:flex">
                <form action="{{route('adminproducto.update',$producto->id)}}" method="post">
                    <div class="parent">
                        <div class="div1"><label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-">
                            Producto
                        </label><br>
                        <input type="text" class="col-12" value="{{$producto->nombre}}" placeholder="Nombre del producto">
                        <br><br></div>
                        <div class="div2"><label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-">
                            SKU redvital®
                        </label><br>
                        <input type="text" class="col-12" value="{{$producto->sku_redvital}}" placeholder="SKU redvital®">
                        <br><br></div>
                        <div class="div6"><label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-">
                            SKU Proveedor
                        </label><br>
                        <input type="text" class="col-12" value="{{$producto->sku_provee}}" placeholder="SKU Proveedor">
                        <br><br></div>
                        
                        <div class="div3"><img src="{{Storage::url($producto->imagen)}}" alt="Productos" width="250px" class="rounded-md"/></div>
                        <div class="div5"><label class="block px-2 mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase " for="grid-">
                            Categoria
                        </label><br>
                        <select class="block w-full px-4 py-3 pt-2 pr-8 leading-tight text-gray-700 bg-gray-400 border border-gray-200 rounded focus:outline-none focus:border-gray-500" style="
                        background-color: #eee;" id="grid-state" value="{{$producto->categoria}}">
                            <option value="{{$producto->categoria}}">{{$producto->categoria}}</option>
                            <option value="ALIMENTOS">ALIMENTOS</option>
                            <option value="BIODYNAMICS">BIODYNAMICS</option>
                            <option value="COSMETICOS Y BELLEZA">COSMETICOS Y BELLEZA</option>
                            <option value="CUIDADO E HIGIENE PERSONAL">CUIDADO E HIGIENE PERSONAL</option>
                            <option value="DERMATOLOGIA Y ESTETICA">DERMATOLOGIA Y ESTETICA</option>
                            <option value="EQUIPOS MEDICOS">EQUIPOS MEDICOS</option>
                            <option value="INSTRUMENTAL">INSTRUMENTAL</option>
                            <option value="INSUMOS MEDICO">INSUMOS MEDICO</option>
                            <option value="MEDICAMENTOS">MEDICAMENTOS</option>
                            <option value="MATERNITY, BABY & CHILD">MATERNITY, BABY & CHILD</option>
                            <option value="MISCELANEOS">MISCELANEOS</option>
                            <option value="ODONTOLOGIA">ODONTOLOGIA</option>
                            <option value="HOGAR">HOGAR</option>
                            <option value="SPA">SPA</option>
                            <option value="SPORT & FITNESS">SPORT & FITNESS</option>
                            <option value="VESTIMENTA">VESTIMENTA</option>
                            <option value="VETERINARIA">VETERINARIA</option>
                            <option value="VITAMINAS, MINERALES Y SUPLEMENTOS">VITAMINAS, MINERALES Y SUPLEMENTOS</option>
                          </select>
                        </div>
                        <div class="div4"><label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-">
                            Código de barra
                        </label><br>
                        <input type="text" class="col-12" value="{{$producto->barras}}" placeholder="Código de barra">
                        <br><br></div>
                        <div class="div7"><label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-">
                            Estatus
                        </label><br>
                        <select class="block w-full px-4 py-3 pt-2 pr-8 leading-tight text-gray-700 bg-gray-400 border border-gray-200 rounded focus:outline-none focus:border-gray-500" style="
                        background-color: #eee;" id="grid-state" value="{{$producto->categoria}}">
                            <option value="{{$producto->categoria}}">{{$producto->status}}</option>
                            <option value="ALIMENTOS">ALIMENTOS</option>
                          </select>
                        <br><br></div>
                        <div class="div8"><label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-">
                            Cantidad del empaque
                        </label><br>
                        <input type="text" class="col-12" value="{{$producto->cantidad_empaque}} unidades" placeholder="Cantidad del Empaque">
                        <br><br></div>
                        <div class="div9"><label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-">
                            Condición
                        </label><br>
                        <select class="block w-full px-4 py-3 pt-2 pr-8 leading-tight text-gray-700 bg-gray-400 border border-gray-200 rounded focus:outline-none focus:border-gray-500" style="
                        background-color: #eee;" id="grid-state" value="{{$producto->condicion}}">
                            <option value="{{$producto->categoria}}">{{$producto->condicion}}</option>
                            <option value="Excento">Excento</option>
                            <option value="Gravable">Gravable</option>
                          </select>
                        <br><br></div>

                        <div class="div10"><label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-">
                            Moneda
                        </label><br>
                        <input type="text" class="col-12" value="{{$producto->moneda}}" placeholder="Moneda">
                        <br><br></div>
                        <div class="div11"><label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-">
                            Costo por bulto
                        </label><br>
                        <input type="text" class="col-12" value="{{$producto->cbulto}} {{$producto->moneda}}" placeholder="Costo por Bulto">
                        <br><br></div>
                        <div class="div12"><label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-">
                            Costo por unidad
                        </label><br>
                        <input type="text" class="col-12" value="{{$producto->cunidad}} {{$producto->moneda}}" placeholder="Costo por unidad">
                        <br><br></div>
                        <div class="div13"><label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-">
                            Precio Sugerido
                        </label><br>
                        <input type="text" class="col-12" value="{{$producto->psugerido}} {{$producto->moneda}} " placeholder="Precio sugerido">
                        <br><br></div>
                        <div class="div14"><label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-">
                            Proveedores
                        </label><br>
                        <input type="text" class="col-12" value="{{$producto->team_id}}" placeholder="Proveedores">
                        <br><br></div>
                        <input type="button" value="Guardar">
                    </form>
            </div>
        </div>
        
    </div>
   
        
             
@stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/redvital.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


