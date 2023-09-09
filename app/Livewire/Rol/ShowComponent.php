<?php

namespace App\Livewire\Rol;

use App\Models\Rol;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

class ShowComponent extends Component
{
    use LivewireAlert;

    public $rol;

    #[Rule('required', message: 'El campo Nombre es requerido')]
    #[Rule('string')]
    #[Rule('min:5', message: 'El campo Nombre debe tener al menos 5 letras')]
    public $name = "";

    #[Rule('required', message: 'El campo Descripción es requerido')]
    #[Rule('string')]
    #[Rule('min:5', message: 'El campo Descripción debe tener al menos 5 letras')]
    public $description = "";

    public $updatedName = null;
    public $updatedDesc = null;

    public function render()
    {
        $this->updatedName ? $this->name = $this->updatedName : $this->name =  $this->rol->name;
        $this->updatedDesc ? $this->description = $this->updatedDesc : $this->description =  $this->rol->description;
        //$this->name = $this->user->name;    
        $rol = Rol::find(15);
        return view('livewire.rol.show-component')->with('rol', $rol);
    }

    public function edit(Rol $rol)
    {
        $validated = $this->validate();
        $this->updatedName = $validated['name'];
        $this->updatedDesc = $validated['description'];
        $rol->update($validated);
        $this->alert('success', 'Rol editado con éxito!', [
            'position' =>  'top',
        ]);
    }
}
