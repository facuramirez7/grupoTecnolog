<form class="p-4">
    <div class="relative z-0 w-full mb-6 group">
        <label for="selectedDevice"
            class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Equipo</label>
        <select wire:model.live='selectedDevice'
            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="myInput2">
            <option value="" selected>Seleccione el equipo al que se le hizo mantenimiento/servicio</option>
            @foreach ($devices as $device)
                <option value="{{ $device->id }}" wire:key="device-{{ $device->id }}">{{ $device->model }} -
                    {{ $device->serial_number }}</option>
            @endforeach
        </select>
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <label for="client_id"
            class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Cliente</label>
        <select wire:model='client_id'
            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="myInput2" disabled>
            @if ($client)
                <option value="{{ $client->id }}" wire:key="client-{{ $client->id }}">{{ $client->name }}</option>
            @else
                <option value="0">-</option>
            @endif
        </select>
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <label for="selectedService"
            class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Servicio</label>
        <select wire:model='selectedService'
            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="myInput2">
            <option value="" selected>Seleccione el servicio realizado</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}" wire:key="service-{{ $service->id }}">{{ $service->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Descripcion</label>
        <textarea wire:model="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escriba aquí la descripción del servicio realizado..."></textarea>
        <x-input-error for="description" class="mt-2" />
    </div>

    <div class="relative z-0 w-full mb-6 group">
        <label for="observations" class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Observaciones</label>
        <textarea wire:model="observations" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Extras..."></textarea>
        <x-input-error for="observations" class="mt-2" />
    </div>

    <div class="relative z-0 w-full mb-6 group">
        <input wire:model='actual_hours' type="number" step="0.01" id="actual_hours"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            placeholder=" " required min="{{ $actual_hours }}" />
        <x-input-error for="actual_hours" class="mt-2" />
        <label for="actual_hours"
            class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Horas
            de funcionamiento</label>
    </div>
    <x-green-button type="submit" wire:click.prevent="create" wire:loading.attr="disabled">
        Crear servicio <i class="fa-solid fa-plus"></i>
    </x-green-button>

</form>
