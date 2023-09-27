<?php

namespace App\Livewire\Devtype;

use App\Models\DeviceType;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

class ShowComponent extends Component
{
    use LivewireAlert;

    public $type;

    #[Rule('min:5|string|required|max:20')]
    public $name = "";

    public $updatedName = null;

    public function render()
    {
        $this->updatedName ? $this->name = $this->updatedName : $this->name =  $this->type->name;     
        return view('livewire.devtype.show-component');
    }

    public function edit(DeviceType $type)
    {
        $validated = $this->validate();
        $this->updatedName = $validated['name'];
        $type->update($validated);
        $this->alert('success', 'Tipo de equipo editado con éxito!', [
            'position' =>  'top',
        ]);
    }
}
