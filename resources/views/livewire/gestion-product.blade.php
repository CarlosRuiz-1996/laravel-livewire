{{-- se inicializa el div para que la tabla pueda cargar una ves que se cargo la pagina --}}
<div wire:init='loadProducts'>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Productos') }}
        </h2>

        {{ $readyToLoad }}
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">


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
            @if (count($products))


                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="w-24 px-4 py-2 cursor-pointer" wire:click="order('id')">
                                ID
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                            </th>
                            <th scope="col" class="px-6 py-3">Imagenes</th>

                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('name')">
                                Nombre
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                            </th>
                            <th scope="col" class=" w-48 px-6 py-3 cursor-pointer" wire:click="order('description')">
                                Descripción
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                            </th>
                            <th scope="col" class="w-28 px-4 py-2 cursor-pointer" wire:click="order('price')">
                                Precio
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                            </th>
                            <th scope="col" class="w-28 px-4 py-2 cursor-pointer" wire:click="order('stock')">
                                Stock
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                            </th>
                            <th scope="col" class="w-40 px-6 py-3 cursor-pointer" wire:click="order('brand_id')">
                                marca
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                            </th>
                            <th scope="col" class="w-40 px-6 py-3 cursor-pointer" wire:click="order('provider_id')">
                                provedor
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                            </th>
                            <th scope="col" class="w-40 px-6 py-3 cursor-pointer" wire:click="order('provider_id')">
                                categoria
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                            </th>
                            <th scope="col" class="w-40 px-3 py-3">
                                acciones
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                wire:key='tr{{ $product->id }}'>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $product->id }}
                                </th>
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <livewire:image-product-admin wire:key='img{{ $product->id }}' :images="$product->images" />
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $product->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $product->description }}

                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->stock }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->brand->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->provider->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->category->name }}
                                </td>
                                <td class="flex mt-8">
                                    <button class="btn btn-green mr-2 p-2" wire:click='edit({{ $product }})'>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-red p-2" wire:click='delete({{ $product }})'>
                                        <i class="fa-solid fa-trash"></i>

                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                

                @if ($products->hasPages())
                <div class="px-6 py-3 text-gray-500">
                    {{ $products->links() }}
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
                <h1> {{ $productId ? 'EDITAR PRODUCTO' : 'AGREGAR PRODUCTO' }}</h1>
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
                <div class="py-3">
                    <x-label>Precio</x-label>
                    <x-input type="number" class="w-full" placehorder="precio del producto" wire:model='form.price' />
                    <x-input-error for="form.price" />

                </div>
                <div class="py-3">
                    <x-label>Stock</x-label>
                    <x-input type="number" class="w-full" placehorder="stock del producto" wire:model='form.stock' />
                    <x-input-error for="form.stock" />

                </div>
                <div class="py-3">
                    <x-label>Provedor</x-label>
                    <select name="" id="" class="form-control w-full" wire:model='form.provider_id'>
                        <option value="" selected disabled>Seleccione una marca</option>
                        @foreach ($providers as $provider)
                            <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.provider_id" />

                </div>
                <div class="py-3">
                    <x-label>Marca</x-label>
                    <select name="" id="" class="form-control w-full" wire:model='form.brand_id'>
                        <option value="" selected disabled>Seleccione una marca</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.brand_id" />

                </div>
                <div class="py-3">
                    <x-label>Categoria</x-label>
                    <select name="" id="" class="form-control w-full" wire:model='form.category_id'>
                        <option value="" selected disabled>Seleccione una categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.category_id" />

                </div>
            @endslot
            @slot('footer')
                <x-danger-button wire:click="{{ $productId ? 'update' : 'save' }}">ACEPTAR</x-danger-button>

                <x-button class="ml-3" wire:click="closeModal">CANCELAR</x-button>
            @endslot
        </x-dialog-modal>
    @endif

</div>
