<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cliente: {{ $client->name }}
        </h2>
    </x-slot>
    <livewire:client.show-component :client="$client"/>
</x-app-layout>


