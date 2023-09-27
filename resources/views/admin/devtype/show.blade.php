<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tipo de equipo: {{ $type->name }}
        </h2>
    </x-slot>
    <livewire:devtype.show-component :type="$type"/>
</x-app-layout>


