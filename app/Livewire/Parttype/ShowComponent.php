<?php

namespace App\Livewire\Parttype;

use App\Models\PartType;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

class ShowComponent extends Component
{
    use LivewireAlert;

    public $type;

    #[Rule('min:5|string|required|max:40')]
    public $name = "";

    public $updatedName = null;

    public function render()
    {
        $this->updatedName ? $this->name = $this->updatedName : $this->name =  $this->type->name;
        return view('livewire.parttype.show-component');
    }

    public function edit(PartType $type)
    {
        $validated = $this->validate();
        $this->updatedName = $validated['name'];
        $type->update($validated);
        $this->alert('success', 'Tipo de repuesto editado con éxito!', [
            'position' =>  'top',
        ]);
    }
}
