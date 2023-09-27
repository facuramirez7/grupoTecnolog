<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <form class="p-4">
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" id="myInput" wire:model='name'
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder="" value="{{ $name }}" required />
            <x-input-error for="name" class="mt-2" />
            <label for="name"
                class="inputs peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
        </div>

        <x-primary-button id="myButton" type="submit" wire:click.prevent="edit({{ $type->id }})"
            wire:loading.attr="disabled" disabled>
            Editar tipo <i class="fa-solid fa-pencil"></i>
        </x-primary-button>
    </form>
    <script>
        // Select the input fields and the button
        var myInput = document.getElementById("myInput");
        var button = document.getElementById("myButton");

        // Function to enable the button if either of the fields changes
        function enableButton() {
            // Check if either of the input fields is not empty
            if (myInput.value.trim() !== "" || myInput2.value.trim() !== "") {
                // Enable the button if at least one of the fields is not empty
                button.removeAttribute("disabled");
            } else {
                // Disable the button if both fields are empty
                button.setAttribute("disabled", "disabled");
            }
        }

        // Listen for the input event on both input fields
        myInput.addEventListener("input", enableButton);
    </script>
</div>
