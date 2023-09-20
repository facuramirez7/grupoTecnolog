<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Rol: {{ $rol->name }}
        </h2>
    </x-slot>
    <livewire:rol.show-component :rol="$rol"/>
</x-app-layout>


