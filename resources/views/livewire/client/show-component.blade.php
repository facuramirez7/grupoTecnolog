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
            <input type="text" wire:model='name'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder="" value="{{ $name }}" required />
            <x-input-error for="name" class="mt-2" />
            <label for="name"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" id="myInput2" wire:model='country'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $country }}" required />
            <x-input-error for="country" class="mt-2" />
            <label for="country"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">País</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" id="myInput2" wire:model='province'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $province }}" required />
            <x-input-error for="province" class="mt-2" />
            <label for="province"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Provincia</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" id="myInput2" wire:model='address'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $address }}" required />
            <x-input-error for="address" class="mt-2" />
            <label for="address"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dirección</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" id="myInput2" wire:model='email'
                class="input-field block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $email }}" required />
            <x-input-error for="email" class="mt-2" />
            <label for="email"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
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
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" id="myInput2" disabled
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $client->created_at }}" required />
            <label for="created_at"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Descripción</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" id="myInput2" disabled
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="{{ $client->updated_at }}" required />
            <label for="updated_at"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Descripción</label>
        </div>


        <x-primary-button id="myButton" type="submit" wire:click.prevent="edit({{ $client->id }})"
            wire:loading.attr="disabled">
            Editar cliente <i class="fa-solid fa-pencil"></i>
        </x-primary-button>
    </form>
    <script>
        // Select all input fields and the button

        var fileInput = document.querySelector('#fileInput');
        var inputs = document.querySelectorAll('.input-field');
        var button = document.querySelector('#myButton');

        inputs.forEach(function(input) {
            input.addEventListener('input', function() {
                button.disabled = false;
            });
        });
        fileInput.addEventListener('change', function() {
            // Habilita el botón si se seleccionó un archivo, de lo contrario, deshabilita el botón
            button.disabled = !fileInput.files.length;
        });
    </script>

</div>
