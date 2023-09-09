<?php

namespace App\Livewire\Rol;

use App\Models\Rol;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

class IndexComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    #[Rule('required', message: 'El campo Nombre es requerido')]
    #[Rule('string')]
    #[Rule('min:5', message: 'El campo Nombre debe tener al menos 5 letras')]
    public $name = '';

    #[Rule('required', message: 'El campo Descripción es requerido')]
    #[Rule('string')]
    #[Rule('min:5', message: 'El campo Descripción debe tener al menos 5 letras')]
    public $description = '';

    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        $roles = Rol::all();
        return view('livewire.rol.index-component')->with('roles', $roles);
    }

    public function createRol()
    {
        $validated = $this->validate();
        Rol::create($validated);
        $this->reset('name', 'description');
        $this->alert('success', 'Rol creado con éxito!',[
            'position' =>  'top',
        ]);
    }

    public function destroyRol(Rol $rol)
    {
        $this->alert('question', "Estas seguro que quieres eliminar el rol $rol->name?", [
            'timer' => null,
            'showConfirmButton' => true,
            'showCancelButton' => True,
            'cancelButtonText' =>  'Cancelar',
            'position' => 'top',
            'confirmButtonColor' => 'red',
            'onConfirmed' => "confirmed",
            'data' => [
                'value' => $rol->id,
            ]
        ]);
    }

    public function confirmed($data){
        $rol = Rol::find($data['value']);
        $rol->delete();
        $this->alert('success', 'Rol eliminado con éxito', [
            'position' =>  'top',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }
}
