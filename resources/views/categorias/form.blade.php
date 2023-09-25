<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ !isset($category) ? 'Crear categoria' : 'Editar categoria' }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route(!isset($category) ? 'category.save' : 'category.update') }}" method="POST">
                    @csrf
                    @if (isset($category))
                        @method('PUT')
                    @endif

                    <input type="hidden" name="id" value="{{ isset($category) ? $category->id : '' }}">
                    <div class="my-4 mx-6">
                        <x-label for="">Categoria</x-label>
                        <x-input type="text" name="name" class="w-full"
                            value="{{ isset($category) ? $category->name : '' }}" />
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                    </div>

                    <div class="my-4 mx-6">

                        <x-button type="submit">Guardar</x-button>
                        <a href="{{ route('category') }}" class="btn btn-red">CANCELAR</a>

                    </div>
                </form>


            </div>
        </div>

</x-app-layout>
