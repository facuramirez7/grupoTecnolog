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
            <input type="text" wire:model='model'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder="" value="{{ $model }}" required />
            <x-input-error for="model" class="mt-2" />
            <label for="model"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Modelo</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" wire:model='serial_number'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $serial_number }}" required />
            <x-input-error for="serial_number" class="mt-2" />
            <label for="serial_number"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Número
                de serie</label>
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <input type="number" wire:model='hours_lastServ'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $hours_lastServ }}" required />
            <x-input-error for="hours_lastServ" class="mt-2" />
            <label for="hours_lastServ"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Horas
                último servicio</label>
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <input type="number" wire:model='actual_hours'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $actual_hours }}" required />
            <x-input-error for="actual_hours" class="mt-2" />
            <label for="actual_hours"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Horas
                actuales</label>
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <input type="date" wire:model='last_visit'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $last_visit }}" required />
            <x-input-error for="last_visit" class="mt-2" />
            <label for="last_visit"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Última
                visita (día/mes/año)</label>
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <input type="date" wire:model='update_actualHours'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $update_actualHours }}" required />
            <x-input-error for="update_actualHours" class="mt-2" />
            <label for="update_actualHours"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Actualización
                de horas (día/mes/año)</label>
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <label for="service_id"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Último
                servicio</label>
            <select wire:model='service_id'
                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="myInput2">
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" wire:key="service-{{ $service->id }}">{{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <label for="prox_service"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Próximo
                servicio</label>
            <select wire:model='prox_service'
                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="myInput2">
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" wire:key="service-{{ $service->id }}">{{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <label class="relative inline-flex items-center mr-5 cursor-pointer"><label for="active"
                    class=" inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Activo</label>
                <input type="checkbox" wire:model='active' value="1" class="input-field sr-only peer"
                    @if ($active == 1) checked @endif>
                <div
                    class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                </div>
            </label>
        </div>



        <x-primary-button id="myButton" type="submit" wire:click.prevent="edit({{ $device->id }})"
            wire:loading.attr="disabled">
            Editar equipo <i class="fa-solid fa-pencil"></i>
        </x-primary-button>
    </form>
</div>
