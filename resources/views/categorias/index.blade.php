<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categorias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="m-5 ">
                    <a class="btn btn-green" href="{{ route('category.create') }}">
                        Nuevo
                    </a>
                </div>
                @if (count($categories))
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="w-24 px-4 py-2">
                                    ID
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Nombre
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                                </th>
                                <th scope="col" class=" w-48 px-6 py-3">
                                    Fecha
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                                </th>

                                <th scope="col" class="px-3 py-3">
                                    acciones
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $item->id }}
                                    </td>

                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $item->name }}
                                    </td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $item->created_at }}</td>
                                    <td class="flex mt-1">
                                        <a href="{{ route('category.edit', $item->id) }}"
                                            class="btn btn-green mr-3 p-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('category.delete', $item) }}" class="btn btn-red p-2">
                                            <i class="fa-solid fa-trash"></i>

                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="px-6 py-4">
                        {{ $categories->links() }}
                    </div>
                @else
                    <div class="px-6 py-4">
                        <h2>No hay categorias</h2>
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
