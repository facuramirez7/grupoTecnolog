<?php

namespace App\Livewire\User;

use App\Models\Rol;
use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;


class ShowComponent extends Component
{
    use LivewireAlert;

    public $user;

    #[Rule('required', message: 'El campo Nombre es requerido')]
    #[Rule('string')]
    #[Rule('min:5', message: 'El campo nombre debe tener al menos 5 letras')]
    public $name = "";

    #[Rule('required', message: 'El campo Rol es requerido')]
    public $rol_id = "";

    public $updatedName = null;
    public $updatedRol = null;

    public function render()
    {
        $this->updatedName ? $this->name = $this->updatedName : $this->name =  $this->user->name;
        $roles = Rol::where('id', '!=', 1)->get();
        return view('livewire.user.show-component')->with('roles', $roles);
    }

    public function edit(User $user){
        $validated = $this->validate();
        $this->updatedName = $validated['name'];  
        $user->update($validated);
        $this->alert('success', 'Usuario editado con éxito!',[
            'position' =>  'top',
        ]);
        
    }
}
