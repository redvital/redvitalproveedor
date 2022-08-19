@extends('adminlte::page')
@section('title', 'Generador TXT')

@section('content_header')
    <h1>Generador de TXT</h1>
@stop

@section('content')
   
<div class="mb-2 md:flex col-8 md:justify-center md:items-center ">
  <div class="p-5 bg-white rounded-lg shadow-lg col-8">
      <form action="creatxt" method="post">
          @csrf
          <div class="mb-4">
              <label for="name" lass="control-label">Tipo de TXT</label>
              <select class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" wire:model="categoria">
                <option value="se">Seleccione</option>
                <option value="Proveedores">Proveedores</option>
                <option value="Productos">Productos</option>
                <option value="Proveedores-Productos">Proveedores + Productos</option>
              </select>
              @error('name')
                  <p class="p-2 my-2 text-sm text-center text-white rounded-lg bg-danger">Se requiere nombre del Contacto, minimo 8 caracteres</p>
              @enderror
          </div>
          <div class="mb-4 md:w-1/2">
              <label for="fechaini" class="control-label">Fecha de busqueda</label>
              <input type="text" name="daterange" value="06/01/2022 - 06/15/2022" />


        </div>
              @error('fechaini')
              <p class="p-2 my-2 text-sm text-center text-white rounded-lg bg-danger">Se requiere correo</p>
          @enderror
          
         
          <input type="submit" class="btn btn-primary" value="Generar TXTS">
      </form>
    </div>
  </div>
</div>
          
    
      
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
<script>
  $(function() {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left'
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  });
  </script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script> console.log('Hi!'); </script>
@stop