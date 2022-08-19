<div>
    <x-jet-button wire:click="$set('open', true)">
      Crear nuevo producto
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
      
      <x-slot name="title">
          <h1>Crear nuevo producto</h1>
      </x-slot>
      
      <x-slot name="content">
        
        <div wire:loading wire:target="imagen" class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
          <strong class="font-bold">IMAGEN CARGANDO:</strong>
          <span class="block sm:inline">Espere un momento</span>
          
        </div>
          {{-- <form action="{{route('dashboard')}}" method="post" encrypted="multipart/form-data" class="w-full max-w-lg">
              @csrf --}}
              <div class="flex flex-wrap mb-6 -mx-3">
                @if ($imagen)
                  <img class='mb-4' src="{{$imagen->temporaryUrl()}}">
                @endif
                  <div class="w-1/2 px-3 mb-6 md:w-1/full md:mb-0">

                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-first-name">
                      SKU
                    </label>
                    <input class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border border-red-500 rounded appearance-none focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="SKU del Proveedor" wire:model="sku_provee">
                    {{-- {{$sku_provee}} --}}
                    <x-jet-input-error for="sku_provee"/>
                   
                  
                  </div>
                  <div class="w-1/2 px-3 md:w-1/full">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                      Codigo de Barra
                    </label>
                    <input class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Codigo de Barra" wire:model="barras">
                    {{-- {{$barras}} --}}
                    <x-jet-input-error for="barras"/>
                  </div>
                
                <div class="flex flex-wrap w-full mb-6 -mx-3">
                  <div class="w-full px-3">
                    <label class="block w-full mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                      Nombre del producto
                    </label>
                    <input class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Nombre del Producto" wire:model="nombre">
                    {{-- {{$nombre}} --}}
                    <x-jet-input-error for="nombre"/>
                  </div>
                </div>
                <div class="px-3 mb-6 w-1/full md:w-1/full md:mb-0">
                  <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-zip">
                    Categoria (*)
                  </label>
                  <select class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" wire:model="categoria">
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
              </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                  <div class="w-1/3 px-3 mb-6 md:w-1/3 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-city">
                      Cantidad del Empaque
                    </label>
                    <input class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" type="text" placeholder="Cantidad del Empaque" wire:model="cantidad_empaque">
                    {{-- {{$cantidad_empaque}} --}}
                    <x-jet-input-error for="cantidad_empaque"/>
                  </div>
                  <div class="w-1/3 px-3 mb-6 md:w-1/3 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-state">
                      Cantidades disponibles
                    </label>
                    <input class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" type="text" placeholder="Cantidades Disponibles" wire:model="cantidad">
                    {{-- {{$cantidad}} --}}
                    <x-jet-input-error for="cantidad"/>
                  </div>
                  <div class="w-1/5 px-3 mb-6 md:w-1/3 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-zip">
                      Condición
                    </label>
                    <select class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" wire:model="condicion">
                      <option value="se">Seleccione</option>
                      <option value="Excento">Excento</option>
                      <option value="Gravable">Gravable</option>
                    </select>
                    {{-- {{$condicion}} --}}
                    <x-jet-input-error for="condicion"/>
                  </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                  <div class="w-1/6 px-3 mb-6 md:w-1/3 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-zip">
                      Moneda
                    </label>
                    <select class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" wire:model="moneda">
                      <option value="se">Seleccione</option>
                      <option value="USD">USD</option>
                      <option value="VES">VES</option>
                    </select>
                    {{-- {{$moneda}} --}}
                    <x-jet-input-error for="moneda"/>
                  </div>
                  <div class="w-1/5 px-3 mb-6 md:w-1/4 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-state" wire:model.defer="cantidad_empaque">
                      Costo x Bulto
                    </label>
                    <input class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" type="text" placeholder="Sin IVA" wire:model="cbulto">
                    
                    <x-jet-input-error for="cbulto"/>
                  </div>
                  <div class="w-1/5 px-3 mb-6 md:w-1/4 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-state" wire:model.defer="cantidad_empaque">
                      Costo x Unidad
                    </label>
                    {{-- {{$cunidad}} --}}
                    <x-jet-input-error for="cunidad"/>
                    <input class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" type="text" placeholder="Sin IVA" wire:model="cunidad">
                  </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                  <div class="w-1/5 px-3 mb-6 md:w-1/4 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-state">
                      Precio Sugerido
                    </label>
                    <input class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" type="text" placeholder="Sugerido" wire:model="psugerido">
                    {{-- {{$psugerido}} --}}
                    <x-jet-input-error for="psugerido"/>
                  </div>
                <div>

              </div>
              <div class="flex flex-wrap">
                    <input type="file" class="block w-full px-6 py-6 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" wire:model="imagen" id="{{$identificador}}">
                    <x-jet-input-error for="imagen"/>
                  </div>
          {{-- </form> --}}
      </x-slot>

      <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('open', false)">
          Cancelar
        </x-jet-secondary-button>
        <x-jet-button  wire:click="save" wire:loading.remove wire:target="save, imagen">
          Crear nuevo producto
        </x-jet-button>
        <span wire:loading wire:target="save">Cargando...</span>
      </x-slot>

    </x-jet-dialog-modal>
</div>
