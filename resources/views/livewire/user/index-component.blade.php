<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <button x-data x-on:click="$dispatch('open-modal',{name:'create'})"
        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm m-4 px-3 py-1 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Añadir usuario <i
            class="fa-solid fa-plus"></i></button>
    <input wire:model.live="search" placeholder="Buscar.."
        class="block m-4 p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <button wire:click="sort('id')">ID</button>
                    <x-sort-icon sortField="id" :sort-by="$sortBy" :asc="$asc" />
                </th>
                <th scope="col" class="px-6 py-3">
                    <button wire:click="sort('name')">Nombre</button>
                    <x-sort-icon sortField="name" :sort-by="$sortBy" :asc="$asc" />
                </th>
                <th scope="col" class="px-6 py-3">
                    <button wire:click="sort('email')">Email</button>
                    <x-sort-icon sortField="email" :sort-by="$sortBy" :asc="$asc" />
                </th>
                <th scope="col" class="px-6 py-3">
                    <button wire:click="sort('rol_id')">Rol</button>
                    <x-sort-icon sortField="rol_id" :sort-by="$sortBy" :asc="$asc" />
                </th>
                <th scope="col" class="px-6 py-3">
                    <button wire:click="sort('created_at')">Fecha de creación</button>
                    <x-sort-icon sortField="created_at" :sort-by="$sortBy" :asc="$asc" />
                </th>
                <th scope="col" class="px-6 py-3">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->rol->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->created_at }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="/usuario/{{ $user->id }}">
                            <x-info-button>
                                <i class="fa-solid fa-info pl-1 pr-1"></i>
                            </x-info-button></a>

                        <x-danger-button wire:click="destroyUser( {{ $user->id }})" wire:loading.attr="disabled">
                            <i class="fa-solid fa-trash"></i>
                        </x-danger-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 mb-4 pr-4 pl-4">
        {{ $users->links() }}
    </div>

    <x-modal-model title="Crear usuario" name="create">
        @slot('body')
            <form class="p-4">
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model='name' type="text" id="name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                         required />
                    <x-input-error for="name" class="mt-2" />
                    <label for="name"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model='email' type="email" id="email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                         required />
                    <x-input-error for="email" class="mt-2" />
                    <label for="email"
                        class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                </div>

                @slot('button')
                    <x-green-button type="submit" wire:click.prevent="createUser" wire:loading.attr="disabled">
                        Crear usuario <i class="fa-solid fa-plus"></i>
                    </x-green-button>
                @endslot
            </form>
        @endslot
    </x-modal-model>

</div>
