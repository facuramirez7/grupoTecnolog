@props(['title', 'name'])
<div x-data="{ show: false, name: '{{ $name }}' }" x-show="show" x-on:open-modal.window="show = ($event.detail.name === name)"
    x-on:close-modal.window="show = false" x-on:keydown.escape.window="show = false"
    style="display:none; border-radius= 50px;" class="fixed z-50 inset-0"
    x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-500"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

    {{-- Gray Background --}}
    <div x-on:click="show = false" class="fixed inset-0 bg-gray-300 opacity-40"></div>

    {{-- Modal Body --}}
    <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl overflow-y-auto" style="max-height:500px">

        @if (isset($title))
            <div class="p-4 text-xl flex items-center justify-center">
                <b>{{ $title }}</b>
            </div>
        @endif
        <div>
            {{ $body }}
        </div>
        <div class="p-4 flex items-center justify-center">
            {{ $button }}
        </div>
    </div>
</div>
