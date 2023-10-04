@php
    use App\Models\ServicePerformed;
@endphp
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <button x-data x-on:click="$dispatch('open-modal',{name:'create'})"
        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm m-4 px-3 py-1 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Añadir
        equipo <i class="fa-solid fa-plus"></i></button>
    <div>
        <input wire:model.live="search" placeholder="Buscar.."
            class="inline-block ml-4 p-4  text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <select wire:model.live="searchType"
            class="inline-block ml-4 p-4 pr-8 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="" selected>Todos los tipos de equipo</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}" wire:key="type-{{ $type->id }}">
                    {{ $type->name }}</option>
            @endforeach
        </select>
        <select wire:model.live="searchClient"
            class="inline-block ml-4 p-4 pr-8 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="" selected>Todos los clientes</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}" wire:key="client-{{ $client->id }}">
                    {{ $client->name }}</option>
            @endforeach
        </select>

        <select wire:model.live="searchService"
            class="inline-block ml-4 p-4 pr-8 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="" selected>Próximo servicio</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}" wire:key="service-{{ $service->id }}">
                    {{ $service->name }}</option>
            @endforeach
        </select>
        <div class="ml-4 mt-4">
            <label class="relative inline-flex items-center mr-5 cursor-pointer">
                <input type="checkbox" wire:model.live='active' class="sr-only peer" checked>
                <div
                    class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                </div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $textActive }}</span>
            </label>
        </div>
    </div>
    <div class="container mb-6 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            @foreach ($devices as $device)
                <!-- Column -->
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                    <!-- Article -->
                    <article class="overflow-hidden rounded-lg shadow-lg p-2 custom-article">

                        <a href="/equipo/{{ $device->id }}">
                            @if (!is_null($device->photo))
                                <img src="{{ url("/storage/$device->photo") }}" class="block rounded h-64 w-full">
                            @else
                                <img src="{{ asset('img/some/default.jpg') }}" class="block rounded h-64 w-full">
                            @endif
                        </a>
                        @php
                            $notifications = ServicePerformed::where('device_id', $device->id)->where('viewed', 0)->get('device_id');
                        @endphp
                        @if (count($notifications) > 0)
                             <a href=""><div class="number-badge"><i class="fa-solid fa-wrench"></i></div>   </a> 
                        @endif

                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">
                                <a class="no-underline text-black over" href="/equipo/{{ $device->id }}">
                                    <b style="color: #009DD7">{{ $device->model }}</b> |
                                    <b>{{ $device->serial_number }}</b>
                                </a>
                            </h1>
                        </header>
                        @php
                            $client = $clients->find($device->client_id);
                        @endphp
                        <div class="flex items-center justify-between leading-none">
                            <div class="inline-block leading-none p-2 md:p-4">
                                @if (isset($client) || $device->client_id != 0)
                                    <a class="flex items-center hover:underline text-black text-sm"
                                        href="cliente/{{ $client->id }}">
                                        @if (!is_null($client->photo))
                                            <img src="{{ url("/storage/$client->photo") }}"
                                                class="block rounded-full h-6 w-6 mr-2">
                                        @else
                                            <img src="{{ asset('img/some/default.jpg') }}"
                                                class="block rounded-full h-6 w-6 mr-2">
                                        @endif

                                        <b class="over text-gray-500">{{ $client->name }}</b>
                                    </a>
                                @else
                                    <b class="flex items-center hover:underline text-black text-sm">
                                        <img src="{{ asset('img/some/default.jpg') }}"
                                            class="block rounded-full h-6 w-6 mr-2">
                                        <b class="over text-gray-500">Sin cliente</b>
                                    </b>
                                @endif
                            </div>
                            <p class="text-grey-darker text-xs">
                                {{ $device->type->name }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between leading-none text-xs md:p-4">
                            @switch($device->next_service->id)
                                @case(1)
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 rounded-full text-xs font-medium bg-green-500 text-white">
                                    @break

                                    @case(2)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 rounded-full text-xs font-medium bg-yellow-500 text-white">
                                        @break

                                        @case(3)
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 rounded-full text-xs font-medium bg-blue-500 text-white">
                                            @break

                                            @case(4)
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-3 rounded-full text-xs font-medium bg-purple-500 text-white">
                                                @break

                                                @default
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-3 rounded-full text-xs font-medium bg-gray-500 text-white">
                                                @endswitch
                                                {{ $device->next_service->name }}</span>

                                            @if ($device->active == 1)
                                                <i class="fa-solid fa-circle text-green-600 text-sm"></i>
                                            @else
                                                <i class="fa-solid fa-circle text-red-600 text-sm"></i>
                                            @endif

                        </div>

                    </article>
                    <!-- END Article -->
                </div>
                <!-- END Column -->
            @endforeach
        </div>
    </div>


    <div class="mt-4 mb-4 pr-4 pl-4">
        {{ $devices->links() }}
    </div>
    <style>
        .over {
            overflow: hidden;
            white-space: nowrap;
        }

        .custom-article {
            position: relative;
        }

        .custom-article .number-badge {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #0098CC;
            /* Color de fondo del número */
            color: white;
            /* Color del texto del número */
            width: 24px;
            /* Ancho del número */
            height: 24px;
            /* Altura del número */
            border-radius: 50%;
            /* Para hacer un círculo */
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            /* Tamaño del texto del número */
            font-weight: bold;
        }
    </style>
    <x-modal-model title="Crear equipo" name="create">
        @slot('body')
            <form class="p-4">
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model='model' type="text" id="model"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <x-input-error for="model" class="mt-2" />
                    <label for="model"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Modelo</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model='serial_number' type="text" id="serial_number"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <x-input-error for="serial_number" class="mt-2" />
                    <label for="serial_number"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Número
                        de serie</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="client_id"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Cliente</label>
                    <select wire:model.live='client_id'
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="myInput2">
                        <option value="" selected>-</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" wire:key="client-{{ $client->id }}">
                                {{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="deviceType_id"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tipo
                        de equipo</label>
                    <select wire:model.live='deviceType_id'
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="myInput2">
                        <option value="" selected>-</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" wire:key="type-{{ $type->id }}">
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model='hours_lastServ' type="number" id="hours_lastServ"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <x-input-error for="hours_lastServ" class="mt-2" />
                    <label for="hours_lastServ"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Horas
                        último servicio</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model='actual_hours' type="number" id="actual_hours"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <x-input-error for="actual_hours" class="mt-2" />
                    <label for="actual_hours"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Horas
                        actuales</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model='photo' type="file" id="photo" accept="image/png, image/jpeg"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <x-input-error for="photo" class="mt-2" />
                    <label for="photo"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Imagen
                        (preferentemente cuadrada de 10x10)</label>
                </div>

                @if ($photo)
                    <div class="flex items-center justify-center">
                        <img src="{{ $photo->temporaryUrl() }}" class="rounded w-20 h-20 mt-2 block">
                    </div>
                @endif

                @slot('button')
                    <x-green-button type="submit" wire:click.prevent="createDevice" wire:loading.attr="disabled">
                        Crear equipo <i class="fa-solid fa-plus"></i>
                    </x-green-button>
                @endslot
            </form>
        @endslot
    </x-modal-model>

</div>
