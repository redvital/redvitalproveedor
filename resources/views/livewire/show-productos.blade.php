<div>
    <x-slot name="header">
        <h2 class='text-xl font-semibold leading-tight text-gray-800'>
            {{ __('Productos') }}
        </h2>
    </x-slot>
    <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
           
                
                <div class="flex items-center p-6 py4 ">
                
<input type="text" id="table-search" class= "w-1/3 mr-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="search" placeholder="Buscar..." >
                    @livewire('create-product')</div>
        </div>
                    
                    
                </div>
                
              {{-- @php $productos= Producto::where('team_id',1)->get();
              @endphp   --}}
            @if($productos->count())
            <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('nombre')">
                            Nombre del Producto
                            
                            @if ($sort == 'nombre')
                                @if ($direction == 'asc')
                                    <i class="float-right mt-1 fa fa-sort-alpha-up-alt"></i>
                                @else
                                    <i class="float-right mt-1 fa fa-sort-alpha-down-alt"></i>
                                @endif
                            @else
                                <i class="float-right mt-1 fa fa-sort"></i>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('sku_provee')">
                            SKU Proveedor
                            @if ($sort == 'sku_provee')
                                @if ($direction == 'asc')
                                    <i class="float-right mt-1 fa fa-sort-alpha-up-alt"></i>
                                @else
                                    <i class="float-right mt-1 fa fa-sort-alpha-down-alt"></i>
                                @endif
                            @else
                                <i class="float-right mt-1 fa fa-sort"></i>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer">
                            Categoria
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Costo unitario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha Modificación
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Editar</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($productos as $producto)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <img class="flex-shrink-0 object-cover w-8 h-8 mx-1 rounded-full" src="{{Storage::url($producto->imagen)}}" alt="Productos" />
                            <p class="mx-2 text-sm text-gray-600 dark:text-white"><span class="font-bold" href="#"> {{$producto->nombre}}
                        </th>
                        <td class="px-6 py-4">
                            {{$producto->sku_provee}}
                        </td>
                        <td class="px-6 py-4">
                            {{$producto->categoria}}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold">{{$producto->moneda}}</span> {{$producto->cunidad}}
                        </td>
                        <td class="px-6 py-4">
                             {{$producto->updated_at}}
                        </td>
                        <td class="px-6 py-4" btn-green btn-green>
                            @livewire('edit-product',['producto' => $producto], key($producto->id))
                        </td>
                    </tr>
                    @endforeach
                  
                </tbody>
            </table>
            </div>
           
        </div> 
        

        {{-- {{$productos}} --}}
        {{-- <h1>Hola Mundo</h1> --}}
    </div>
    @else
    <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            No se consiguio ningun resultado por la busqueda
        </div>
            @endif

            @if ($productos->hasPages())
                <div class="px-6 py-3">
                    {{$productos->links()}}
                </div>
            @endif
</div>
