<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <form class="p-4">
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" wire:model='name'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder="" value="{{ $name }}" required />
            <x-input-error for="name" class="mt-2" />
            <label for="name"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" wire:model='description'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $service->description }}" required />
                <x-input-error for="description" class="mt-2" />
                <label for="description"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Descripción</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" wire:model='prize'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $service->prize }}" required />
                <x-input-error for="prize" class="mt-2" />
                <label for="prize"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Descripción</label>
        </div>

        <x-primary-button id="myButton" type="submit" wire:click.prevent="edit({{ $service->id }})"
            wire:loading.attr="disabled" disabled>
            Editar servicio <i class="fa-solid fa-pencil"></i>
        </x-primary-button>
    </form>
    <script>
        // Select all input fields and the button

        var inputs = document.querySelectorAll('.input-field');
        var button = document.querySelector('#myButton');

        inputs.forEach(function(input) {
            input.addEventListener('input', function() {
                button.disabled = false;
            });
        });
    </script>
</div>
