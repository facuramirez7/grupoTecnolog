<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Repuesto: {{ $part->serial_number }}
        </h2>
    </x-slot>
    <livewire:part.show-component :part="$part"/>
</x-app-layout>


