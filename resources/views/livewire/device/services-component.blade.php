<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    {{-- <a href="/realizar-servicio"><button
        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm m-4 px-3 py-1 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Añadir
        servicio <i class="fa-solid fa-plus"></i></button></a> --}}
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Fecha
                </th>
                <th scope="col" class="px-6 py-3">
                    Técnico
                </th>
                <th scope="col" class="px-6 py-3">
                    Servicio
                </th>
                <th scope="col" class="px-6 py-3">
                    Actualización de horas
                </th>
                <th scope="col" class="px-6 py-3">
                    Estado
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($performeds as $service)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $service->created_at }}
                    </th></button>
                    <td class="px-6 py-4">
                        {{ $service->user->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $service->service->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $service->actual_hours }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($service->viewed == 0)
                            <button x-data x-on:click="$dispatch('open-modal',{name:'approve-{{ $service->id }}'})">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        @elseif($service->viewed == 1)
                            @if ($service->approved == 1)
                                <i class="fa-solid fa-check text-green-500"></i>
                            @else
                                <i class="fa-solid fa-xmark text-red-500"></i>
                            @endif
                        @endif
                    </td>
                </tr>

                <x-modal-model name="approve-{{ $service->id }}">
                    @slot('body')
                        <div class="m-4 p-4 border-solid border-2 border-gray-300 rounded-lg">
                            <div class="grid md:grid-cols-2 md:gap-6 border-b-2">
                                <div class="relative z-0 w-full group my-2">
                                    <b>Fecha</b>
                                </div>
                                <div class="relative z-0 w-full group my-2">
                                    <p>{{ $service->created_at }}</p>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6 border-b-2">
                                <div class="relative z-0 w-full group my-2">
                                    <b>Técnico</b>
                                </div>
                                <div class="relative z-0 w-full group my-2">
                                    <p>{{ $service->user->name }}</p>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6 border-b-2">
                                <div class="relative z-0 w-full group my-2">
                                    <b>Tipo de servicio realizado</b>
                                </div>
                                <div class="relative z-0 w-full group my-2">
                                    <p>{{ $service->service->name }}</p>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6 border-b-2">
                                <div class="relative z-0 w-full group my-2">
                                    <b>Descripción</b>
                                </div>
                                <div class="relative z-0 w-full group my-2">
                                    <p>{{ $service->description }}</p>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6 border-b-2">
                                <div class="relative z-0 w-full group my-2">
                                    <b>Observaciones</b>
                                </div>
                                <div class="relative z-0 w-full group my-2">
                                    <p>{{ $service->observations }}</p>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6 border-b-2">
                                <div class="relative z-0 w-full group my-2">
                                    <b>Horas</b>
                                </div>
                                <div class="relative z-0 w-full group my-2">
                                    <p>{{ $service->actual_hours }}</p>
                                </div>
                            </div>

                            <div class="text-center m-4">
                                <x-green-full-button wire:click="approveService({{ $service->id }})" wire:loading.attr="disabled">
                                    <i class="fa-solid fa-check"></i>
                                </x-green-full-button>

                                <x-danger-button wire:click="rejectService({{ $service->id }})" wire:loading.attr="disabled">
                                    <i class="fa-solid fa-xmark"></i>
                                </x-danger-button>
                            </div>



                        </div>

                        @slot('button')
                        @endslot
                        </form>
                    @endslot
                </x-modal-model>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 mb-4 pr-4 pl-4">

    </div>


    <style>
        .over {
            overflow: hidden;
            white-space: nowrap;
        }
    </style>
</div>
