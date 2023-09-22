<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Servicio: {{ $service->name }}
        </h2>
    </x-slot>
    <livewire:service.show-component :service="$service"/>
</x-app-layout>


