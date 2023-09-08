<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Usuario: {{ $user->name }}
        </h2>
    </x-slot>
    <livewire:user.user-show-component :user="$user"/>
</x-app-layout>


