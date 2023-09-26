{{-- se inicializa el div para que la tabla pueda cargar una ves que se cargo la pagina --}}
<div wire:init='loadBrands'>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Marcas') }}
        </h2>

        {{ $readyToLoad }}
    </x-slot>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <div class=" py-6 px-4 bg-gray-100 flex">

                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select class="form-control" wire:model.live='list'>
                        @foreach ($entrada as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    <span>Entradas</span>
                </div>

                <x-input type="text" class="w-full ml-4" wire:model.live='form.search' />

                <x-button class="ml-4" wire:click="openModal">Nuevo</x-button>
            </div>
            @if (count($brands))


                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="w-24 px-4 py-2 cursor-pointer" wire:click="order('id')">
                                ID
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                            </th>

                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('name')">
                                Nombre
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('description')">
                                Descripción
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                            </th>

                            <th scope="col" class="w-40 px-3 py-3">
                                acciones
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($brands as $brand)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                wire:key='tr{{ $brand->id }}'>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $brand->id }}
                                </th>

                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $brand->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $brand->description }}

                                </td>

                                <td class="flex mt-2">
                                    <button class="btn btn-green mr-2 p-2" wire:click='edit({{ $brand }})'>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-red p-2"
                                        wire:click="$dispatch('deleteBrand',{{ $brand->id }})">


                                        <i class="fa-solid fa-trash"></i>

                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>


                @if ($brands->hasPages())
                    <div class="px-6 py-3 text-gray-500">
                        {{ $brands->links() }}
                    </div>
                @endif
            @else
                @if ($readyToLoad)
                    <h1 class="px-6 py-3 text-gray-500 ">No hay datos disponibles</h1>
                @else
                    <!-- Muestra un spinner mientras los datos se cargan -->
                    <div class="flex justify-center items-center h-40">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-500"></div>
                    </div>
                @endif
            @endif
        </div>

    </div>

    @if ($open)
        <x-dialog-modal wire:model="open">
            @slot('title')
                <h1> {{ $brandId ? 'EDITAR PRODUCTO' : 'AGREGAR PRODUCTO' }}</h1>
            @endslot
            @slot('content')
                <div class="py-3">
                    <x-label>Nombre</x-label>
                    <x-input type="text" class="w-full" placehorder="Nombre del producto" wire:model='form.name' />
                    <x-input-error for="form.name" />
                </div>
                <div class="py-3">
                    <x-label>Descripción</x-label>
                    <x-input type="text" class="w-full" placehorder="descripcion del producto"
                        wire:model='form.description' />
                    <x-input-error for="form.description" />

                </div>
            @endslot
            @slot('footer')
                <x-danger-button wire:click="{{ $brandId ? 'update' : 'save' }}">ACEPTAR</x-danger-button>

                <x-button class="ml-3" wire:click="closeModal">CANCELAR</x-button>
            @endslot
        </x-dialog-modal>
    @endif

    @push('js')
        <script>
            document.addEventListener('livewire:initialized', () => {
                
                //recibo desde el controlador
                Livewire.on('alert-marcas', function(message) {
                    Swal.fire({
                        // position: 'top-end',
                        icon: 'success',
                        title: message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                });


                //recibo desde el mismo componente
                @this.on('deleteBrand', (brandId) => {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this! " + brandId,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            @this.dispatch('delete-brand', {
                                brand: brandId
                            });

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    })
                });
            });
        </script>
    @endpush
</div>
