<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <style>
        .hidden2 {
            display: none;
        }

        .image-container:hover #fileInput {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .image-container {
            position: relative;
        }

        .image-container .hover-legend {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.398);
            color: white;
            text-align: center;
            padding: 8px 0;
            opacity: 0;
            transition: opacity 0.3s;
        }

        /* Mostrar la leyenda cuando se pasa el mouse */
        .image-container:hover .hover-legend {
            opacity: 1;
        }
    </style>
    <div class="flex items-center justify-center mt-5">
        <div class="image-container">
            @if (isset($updatedPhoto))
                <img src="{{ $updatedPhoto->temporaryUrl() }}" class="rounded w-32 max-h-32 block">
            @else
                @if (!is_null($photo))
                    <img src="{{ url("/storage/$photo") }}" class="rounded w-32 max-h-32 block">
                @else
                    <img src="{{ asset('img/some/default.jpg') }}" class="rounded w-32 max-h-32  block">
                @endif
            @endif
            <div class="hover-legend">Editar <i class="fa-solid fa-pencil"></i></div>
            <input type="file" id="fileInput" wire:model='updatedPhoto' class="input-field hidden2"
                wire:change="loadFoto" accept="image/png, image/jpeg">
        </div>
    </div>

    <form class="p-4">
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" wire:model='serial_number'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder="" value="{{ $serial_number }}" required />
            <x-input-error for="serial_number" class="mt-2" />
            <label for="serial_number"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="option_id"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Rol</label>
            <select wire:model='part_type_id'
                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="myInput2">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" wire:key="type-{{ $type->id }}" >{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="number" id="myInput2" wire:model='buy_prize'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $buy_prize }}" required />
            <x-input-error for="buy_prize" class="mt-2" />
            <label for="buy_prize"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Precio de compra</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="number" id="myInput2" wire:model='sell_prize'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $sell_prize }}" required />
            <x-input-error for="sell_prize" class="mt-2" />
            <label for="sell_prize"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Precio de venta</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="number" id="myInput2" wire:model='stock'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $stock }}" required />
            <x-input-error for="stock" class="mt-2" />
            <label for="stock"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Stock</label>
        </div>


        <x-primary-button id="myButton" type="submit" wire:click.prevent="edit({{ $part->id }})"
            wire:loading.attr="disabled">
            Editar repuesto <i class="fa-solid fa-pencil"></i>
        </x-primary-button>
    </form>
</div>
