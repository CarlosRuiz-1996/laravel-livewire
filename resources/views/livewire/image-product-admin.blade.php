<div>

    <div>
        @if ($images && count($images) > 0)
            <img src="{{ route('image.file', ['filename' => $images[0]->path]) }}" alt="Imagen"
                class="w-16 h-16 m-3 rounded-full shadow-lg" wire:click="openModalImage()" />
        @else
            <img src="{{ asset('images/product_empty.png') }}" alt="Imagen" class="w-16 h-16 m-3 rounded-full shadow-lg">
        @endif
    </div>

    <x-dialog-modal wire:model="openImg">
        @slot('title')
            <h1>DETALLE DE IMÁGENES</h1>
        @endslot
        @slot('content')
            <div x-data="{ slide: 0 }" x-init="slide = 0">
                <div x-ref="carousel" class="carousel relative w-full">
                    @foreach ($images as $index => $image)
                        <div x-show="slide === {{ $index }}" class="carousel-slide">
                            <img src="{{ route('image.file', ['filename' => $image->path]) }}" alt="Imagen"
                                {{-- class="p-8 rounded-t-lg"  absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 --}} class=" rounded-t-lg -translate-x -translate-y top-1/2 left-1/2">
                        </div>
                    @endforeach
                </div>

                @if ($images && count($images) >1)
                    <div class="carousel-controls">
                        <button
                            class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            @click="slide = (slide - 1) < 0 ? {{ count($images) - 1 }} : (slide - 1)">
                            <span
                                class="ml-5 inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 1 1 5l4 4" />
                                </svg>
                                <span class="sr-only">Anterior</span>
                            </span>
                        </button>
                        <button
                            class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            @click="slide = (slide + 1) % {{ count($images) }}">
                            <span
                                class="mr-5 inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="sr-only">Siguiente</span>
                            </span>
                        </button>
                    </div>
                @endif

            </div>
        @endslot
        @slot('footer')

                <x-button class=" mr-64" wire:click="closeModalImage">CERRAR</x-button>
        @endslot
    </x-dialog-modal>


</div>




{{-- <div>
    <!-- Botón de imagen pequeña -->
    @if ($images && count($images) > 0)
        <img src="{{ route('image.file', ['filename' => $images[0]->path]) }}" alt="Imagen"
            class="w-16 h-16 m-3 rounded-full shadow-lg" wire:click="openModalImage()" />
        {{ $openImg }}
    @else
        <img src="{{ asset('images/product_empty.png') }}" alt="Imagen" class="w-16 h-16 m-3 rounded-full shadow-lg">
    @endif


    @if ($openImg)
        
    <x-dialog-modal wire:model="openImg">
        <x-slot name='title'>
            <h1>DETALLE DE IMÁGENES</h1>
        </x-slot>
        <x-slot name="content">
            <div x-data="{ slide: 0 }" x-init="slide = 0">
                <div x-ref="carousel" class="carousel relative w-full">
                    @foreach ($images as $index => $image)
                        <div x-show="slide === {{ $index }}" class="carousel-slide">
                            <img src="{{ route('image.file', ['filename' => $image->path]) }}" alt="Imagen"
                                {{-- class="p-8 rounded-t-lg"  absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 --} } class=" rounded-t-lg -translate-x -translate-y top-1/2 left-1/2">
                        </div>
                    @endforeach
                </div>

                @if ($images && count($images) > 0)
                    <div class="carousel-controls">
                        <button
                            class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            @click="slide = (slide - 1) < 0 ? {{ count($images) - 1 }} : (slide - 1)">
                            <span
                                class="ml-5 inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 1 1 5l4 4" />
                                </svg>
                                <span class="sr-only">Anterior</span>
                            </span>
                        </button>
                        <button
                            class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            @click="slide = (slide + 1) % {{ count($images) }}">
                            <span
                                class="mr-5 inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="sr-only">Siguiente</span>
                            </span>
                        </button>
                    </div>
                @endif

            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-button class="ml-3" wire:click="closeModalImage">CERRAR</x-button>
        </x-slot>
    </x-dialog-modal>
    @endif

</div> --}}
