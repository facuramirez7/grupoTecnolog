<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tipos de repuesto') }}
        </h2>
    </x-slot>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <livewire:parttype.index-component />
    </div>
</x-app-layout>
