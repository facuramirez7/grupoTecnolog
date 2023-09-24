<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Máquina: {{ $device->model - $device->serial_number }}
        </h2>
    </x-slot>
    <livewire:device.show-component :device="$device"/>
</x-app-layout>


