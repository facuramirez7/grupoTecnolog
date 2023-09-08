
@props(['title' , 'name'])
<div x-data="{ show : false, name : '{{ $name }}'}" 
    x-show="show"
    x-on:open-modal.window="show = ($event.detail.name === name)" 
    x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="show = false" 
    style="display:none; border-radius= 50px;" class="fixed z-50 inset-0" x-transition.duration>
    
    {{-- Gray Background --}}
    <div x-on:click="show = false" class="fixed inset-0 bg-gray-300 opacity-40"></div>

    {{-- Modal Body --}}
    <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl overflow-y-auto" style="max-height:500px">
       
        <div class="p-4 text-xl flex items-center justify-center">
           {{ $title ?? 'Grupo Tecnolog'}}
        </div>
        <div>
            {{ $body }}
        </div>
        <div class="p-4 flex items-center justify-center">
            {{ $button}}
         </div>
    </div>
</div>