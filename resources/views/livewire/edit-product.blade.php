<div>
    <a class="cursor-pointer" alt="Modificar" wire:click="$set('open',true)">
        <i class="fas fa-edit "></i>
    </a>


    <x-jet-dialog-modal wire:model="open" style="max-width: 100rem;" >

        <x-slot name="title">
            
            <h1>Editar el Producto {{$producto->nombre}}</h1>
        </x-slot>

        <x-slot name="content">
            <div wire:loading wire:target="imagen"class="flex p-4 mb-4 text-sm text-yellow-700 bg-red-600 border rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert" style="max-width: 100rem;">
                <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <div>
                  <span class="font-medium text-yellow-100">IMAGEN CARGANDO:</span> Espere un momento.
                </div>
            </div>

              <div class="flex px-8 py-12">
                <div class="relative flex shadow-md overflow-clip">
                    <div class="w-full">






                        {{-- <form action="{{route('dashboard')}}" method="post" encrypted="multipart/form-data" class="w-full max-w-lg">
                    @csrf --}}
                        
                            <div class="mb-4">
                                <x-jet-label value="Nombre del producto"/>
                                    <x-jet-input wire:model="producto.nombre" type="text" class="w-full over;"/>
                                    {{-- <x-jet-input value="{{ Auth::user()->id }}" type="text" class="w-full over;"/> --}}
                                    <x-jet-input wire:model="producto.sku_provee" value="producto.sku_provee" name="sku_provee" type="text" class="hidden"/>
                            </div>
                            <div class="mb-4">
                                <x-jet-label value="Codigo de Barra"/>
                                    <x-jet-input wire:model="producto.barras" type="text" class="w-full"/>
                            </div>
                            <div class="px-3 mb-6 w-1/full md:w-1/full md:mb-0">
                                <x-jet-label value="Categoria (*)"/>
                                
                                <select class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" wire:model="producto.categoria">
                                  <option value="se">Seleccione</option>
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
                                {{-- {{$condicion}} --}}
                                <x-jet-input-error for="categoria"/>
                              </div>
                            
                              <div class="flex w-full px-3 mt-8 mb-6 md:mb-0">
                                <div class="w-1/5 px-3 mb-6 md:mb-0">
                                    <x-jet-label value="Cantidad del Empaque"/>
                                    <x-jet-input wire:model="producto.cantidad_empaque" type="text" class="w-full"/>
                                  
                                  <x-jet-input-error for="cantidad_empaque"/>
                                </div>

                                <div class="w-1/5 px-3 mb-6 md:mb-0">
                                  
                                  <x-jet-label value="Cantidades disponibles"/>
                                    <x-jet-input wire:model="producto.cantidad" type="text" class="w-full"/>
                                  <x-jet-input-error for="cantidad"/>
                                </div>
                                <div class="px-3 mb-6 w-1/7 md:mb-0">
                                    <x-jet-label value="Condición"/>
                                  <select class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" wire:model="producto.condicion" name="condicion">
                                    <option value="se">Seleccione</option>
                                    <option value="Excento">Excento</option>
                                    <option value="Gravable">Gravable</option>
                                  </select>
                                  {{-- {{$condicion}} --}}
                                  <x-jet-input-error for="condicion"/>
                                </div>
                                <div class="w-1/6 px-3 mb-6 md:w-1/3 md:mb-0">
                                    <x-jet-label value="Moneda"/>
                                    <select class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" wire:model="producto.moneda" name="moneda">
                                      <option value="se">Seleccione</option>
                                      <option value="USD">USD</option>
                                      <option value="VES">VES</option>
                                    </select>
                                    {{-- {{$moneda}} --}}
                                    <x-jet-input-error for="moneda"/>
                                  </div>
                              </div>
                              
                              <div class="flex w-full px-3 mt-8 mb-6 md:mb-0"> 
                                <div class="w-1/5 px-3 mb-6 md:w-1/4 md:mb-0">
                                    <x-jet-label value="Costo x Bulto"/>
                                    <x-jet-input wire:model="producto.cbulto" type="text" class="w-full" name="cbulto"/>

                                    <x-jet-input-error for="cbulto"/>
                                </div>
                                <div class="px-3 mb-6 w-1/7 md:w-1/4 md:mb-0">
                                    <x-jet-label value="Costo x Unidad"/>
                                    <x-jet-input wire:model="producto.cunidad" type="text" class="w-full" name="cunidad"/>

                                  <x-jet-input-error for="cunidad"/>
                                  
                                </div>
                              
                             
                                <div class="w-2/5 px-3 mb-6">
                                  
                                    <x-jet-label value="Precio Sugerido"/>
                                    <x-jet-input wire:model="producto.psugerido" type="text" class="w-full" name="psugerido"/>

                                   
                                  <x-jet-input-error for="psugerido"/>
                                </div>
                            </div>
                              <div>
                    </div>
                    
                    <div class="w-1/7">
                        <div class="flex flex-wrap mb-6 -mx-3 w-1/7">
                            @if ($imagen)
                                <img class='mb-4' src="{{$imagen->temporaryUrl()}}">
                            @else
                                <img src="{{Storage::url($producto->imagen)}}" alt="producto"/>
                            @endif
                        </div>
                        <div class="flex flex-wrap">
                            <input type="file" class="block w-full px-6 py-6 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" wire:model="imagen" id="{{$identificador}}">
                            <x-jet-input-error for="imagen"/>
                          </div>
                    </div> 
                
                
              </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secundary-button>

            <x-jet-button wire:click="save">
                Actualizar Producto
            </x-jet-button>

        </x-slot>


    </x-jet-dialog-modal>



</div>
