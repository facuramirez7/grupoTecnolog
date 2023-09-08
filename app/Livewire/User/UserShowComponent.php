<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;


class UserShowComponent extends Component
{
    use LivewireAlert;

    public $user;

    #[Rule('required', message: 'El campo Nombre es requerido')]
    #[Rule('string')]
    #[Rule('min:5', message: 'El campo nombre debe tener al menos 5 letras')]
    public $name = "";

    public function render()
    {
        $this->name = $this->user->name;    
        $user = User::find(15);
        return view('livewire.user.user-show-component')->with('user', $user);
    }

    public function edit(User $user){
        $validated = $this->validate();
        $this->name = $validated['name'];  
        $user->update($validated);
        $this->alert('success', 'Usuario editado con éxito!',[
            'position' =>  'top',
        ]);
        
    }
}
