<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <div class=" py-6 px-4 bg-gray-100 flex">
                <x-input type="text" class="w-full" wire:model.live='form.search' />

                <x-button class="ml-4" wire:click="openModal">Nuevo</x-button>
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Descripción
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stock
                        </th>
                        <th scope="col" class="px-6 py-3">
                            marca
                        </th>
                        <th scope="col" class="px-6 py-3">
                            provedor
                        </th>
                        <th scope="col" class="px-6 py-3">
                            acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                            <td>
                                <button class="btn btn-green" wire:click='edit({{$product}})'>Actializar</button>
                                <button class="btn btn-red" wire:click='delete({{$product}})'>Eliminar</button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="px-6 py-3 text-gray-500">
                {{ $products->links() }}
            </div>
        </div>

    </div>

    @if ($open)
        <x-dialog-modal wire:model="open">
            @slot('title')
            <h1>  {{$productId?'EDITAR PRODUCTO':'AGREGAR PRODUCTO'}}</h1>

               
            @endslot
            @slot('content')
                <div class="py-3">
                    <x-label>Nombre</x-label>
                    <x-input type="text" class="w-full" placehorder="Nombre del producto" wire:model='form.name' />
                    <x-input-error for="form.name" />
                </div>
                <div class="py-3">
                    <x-label>Descripción</x-label>
                    <x-input type="text" class="w-full" placehorder="descripcion del producto" wire:model='form.description' />
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
                    <select name="" id="" class="form-control w-full" wire:model.live='form.brand_id'>
                        <option value="" selected disabled>Seleccione una marca</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.brand_id" />

                </div>
            @endslot
            @slot('footer')
                <x-danger-button wire:click="{{$productId?'update':'save'}}">ACEPTAR</x-danger-button>

                <x-button class="ml-3" wire:click="closeModal">CANCELAR</x-button>
            @endslot
        </x-dialog-modal>
    @endif

</div>