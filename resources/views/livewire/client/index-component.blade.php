<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <button x-data x-on:click="$dispatch('open-modal',{name:'create'})"
        class="text-white m-4 px-3 py-1 bg-green-500 rounded text-l">Añadir cliente <i
            class="fa-solid fa-plus"></i></button>
    <input wire:model.live="search" placeholder="Buscar.."
        class="block m-4 p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">

                </th>
                <th scope="col" class="px-6 py-3">
                    <button wire:click="sort('name')">Nombre</button>
                    <x-sort-icon sortField="name" :sort-by="$sortBy" :asc="$asc" />
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    <button wire:click="sort('country')">País</button>
                    <x-sort-icon sortField="country" :sort-by="$sortBy" :asc="$asc" />
                </th>
                <th scope="col" class="px-6 py-3">
                    <button wire:click="sort('province')">Provincia</button>
                    <x-sort-icon sortField="province" :sort-by="$sortBy" :asc="$asc" />
                </th>
                <th scope="col" class="px-6 py-3">
                    <button wire:click="sort('active')">Activo</button>
                    <x-sort-icon sortField="active" :sort-by="$sortBy" :asc="$asc" />
                </th>
                <th scope="col" class="px-6 py-3">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $client->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $client->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $client->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $client->country }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $client->province }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($client->active == 1)
                            <i class="fa-solid fa-circle-check text-green-500"></i>
                        @else
                            <i class="fa-solid fa-circle-xmark text-red-500"></i>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="/cliente/{{ $client->id }}">
                            <x-primary-button>
                                <i class="fa-solid fa-pencil"></i>
                            </x-primary-button></a>

                        <x-danger-button wire:click="destroyClient( {{ $client->id }})" wire:loading.attr="disabled">
                            <i class="fa-solid fa-trash"></i>
                        </x-danger-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 mb-4 pr-4 pl-4">
        {{ $clients->links() }}
    </div>

    <x-modal-model title="Crear cliente" name="create">
        @slot('body')
            <form class="p-4">
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model='name' type="text" id="name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <x-input-error for="name" class="mt-2" />
                    <label for="name"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model='country' type="text" id="country"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <x-input-error for="country" class="mt-2" />
                    <label for="country"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">País</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model='province' type="text" id="province"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <x-input-error for="province" class="mt-2" />
                    <label for="province"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Provincia</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model='address' type="text" id="address"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <x-input-error for="address" class="mt-2" />
                    <label for="address"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dirección</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model='email' type="text" id="email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <x-input-error for="email" class="mt-2" />
                    <label for="email"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                </div>

                @slot('button')
                    <x-green-button type="submit" wire:click.prevent="createClient" wire:loading.attr="disabled">
                        Crear cliente <i class="fa-solid fa-plus"></i>
                    </x-green-button>
                @endslot
            </form>
        @endslot
    </x-modal-model>

</div>
