<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <button x-data x-on:click="$dispatch('open-modal')" class="text-white mb-4 px-3 py-1 bg-blue-500 rounded text-xs">Añadir usuario <i class="fa-solid fa-plus"></i></button> 
            <input wire:model.live="search" placeholder="Buscar.." class="block mb-4 p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de creación
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">

                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->created_at }}
                            </td>
                            <td class="px-6 py-4">
                                <x-primary-button wire:click="editUser( {{ $user->id }})" wire:loading.attr="disabled">
                                    <i class="fa-solid fa-pencil"></i>
                                </x-primary-button>

                                <x-danger-button class="ml-3" wire:click="destroyUser( {{ $user->id }})" wire:loading.attr="disabled">
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
            <x-modal-model title="Crear usuario">
                @slot('body')
                    <input type="text" name="" id="">
                @endslot
            </x-modal-model>
            
        </div>
    </div>
</div>

