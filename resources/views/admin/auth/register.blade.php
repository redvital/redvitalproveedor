@extends('adminlte::page')
@section('title', 'Registro de Proveedores')

@section('content_header')
    <h1>Registro de Proveedores</h1>
@stop
@section('content')
<div class="mb-2 md:flex col-8 md:justify-center md:items-center ">
    <div class="p-5 bg-white rounded-lg shadow-lg col-8 md:flex">
        <form action="registro" method="post">
            @csrf
            <div class="mb-4 md:w-1/2">
                <label for="name" lass="control-label">Nombre de Contacto</label>
                <input type="text" class="form-control @error('name') border border-danger @enderror" name="name" placeholder="Nombre de Contacto" value={{old('name')}}>
                @error('name')
                    <p class="p-2 my-2 text-sm text-center text-white rounded-lg bg-danger">Se requiere nombre del Contacto, minimo 8 caracteres</p>
                @enderror
            </div>
            <div class="mb-4 md:w-1/2">
                <label for="email" class="control-label">Correo</label>
                <input type="email" class="form-control @error('email') border border-danger @enderror" name="email" placeholder="Correo" value={{old('email')}} >
                @error('email')
                <p class="p-2 my-2 text-sm text-center text-white rounded-lg bg-danger">Se requiere correo</p>
            @enderror
            </div>
            <div class="mb-4 sm:w-1/2">
                <label for="phone" class="control-label">Telefono</label>
                <input type="text" class="p-3 form-control" name="phone" placeholder="Telefono" value={{old('phone')}}>
            </div>
            <div class="mb-4 sm:w-1/2">
                <label for="empresa" class="control-label">Nombre de la Empresa</label>
                <input type="text" class="p-3 form-control @error('empresa') border border-danger @enderror" name="empresa" placeholder="Nombre de la Empresa" value={{old('empresa')}}>
                @error('empresa')
                <p class="p-2 my-2 text-sm text-center text-white rounded-lg bg-danger">Se requiere nombre de la empresa legal, minimo 8 caracteres</p>
            @enderror
            </div>
            <div class="mb-4 sm:w-1/2">
                <label for="rif" class="control-label">RIF de la Empresa</label>
                <input type="text" class="p-3 form-control @error('rif') border border-danger @enderror" name="rif" placeholder="RIF de la Empresa" value={{old('rif')}}>
                @error('rif')
                <p class="p-2 my-2 text-sm text-center text-white rounded-lg bg-danger">Se requiere RIF de la empresa, minimo 6 caracteres</p>
            @enderror
            </div>
            <div class="mb-4 sm:w-1/2">
                <label for="direccion" class="control-label">Dirección Fiscal</label>
                <input type="text" class="p-3 form-control @error('direccion') border border-danger @enderror" name="direccion" placeholder="Dirección Fiscal" value={{old('direccion')}} >
                @error('direccion')
                <p class="p-2 my-2 text-sm text-center text-white rounded-lg bg-danger">Se requiere direccion fiscal</p>
            @enderror
            </div>
            <input type="submit" class="btn btn-primary" value="Crear cuenta de proveedor">
        </form>
    </div>
</div>
@stop
