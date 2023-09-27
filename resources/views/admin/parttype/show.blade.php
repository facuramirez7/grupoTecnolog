<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tipo de repuesto: {{ $type->name }}
        </h2>
    </x-slot>
    <livewire:parttype.show-component :type="$type"/>
</x-app-layout>


