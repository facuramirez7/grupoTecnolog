<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

class UserIndexComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    #[Rule('required', message: 'El campo Nombre es requerido')]
    #[Rule('string')]
    #[Rule('min:5', message: 'El campo nombre debe tener al menos 5 letras')]
    public $name = '';

    #[Rule('required', message: 'El campo Email es requerido')]
    #[Rule('email', message: 'El campo Email debe ser de tipo email. Ejemplo: example@example.com')]
    #[Rule('unique:users', message: 'Ya se encuentra el email en uso')]
    public $email = '';

    public $search = '';
    public $userId;
    


    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.user.user-index-component')->with('users', $users);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function createUser()
    {
        $validated = $this->validate();
        $validated["password"] = bcrypt('gt-12345678');
        User::create($validated);
        $this->reset('name', 'email');
        $this->alert('success', 'Usuario creado con éxito!',[
            'position' =>  'top',
        ]);
    }

    public function destroyUser(User $user)
    {
        $this->alert('question', "Estas seguro que quieres eliminar al usuario $user->name?", [
            'timer' => null,
            'showConfirmButton' => true,
            'showCancelButton' => True,
            'cancelButtonText' =>  'Cancelar',
            'position' => 'top',
            'confirmButtonColor' => 'red',
            'onConfirmed' => "confirmed",
            'data' => [
                'value' => $user->id,
            ]
        ]);
    }

    public function confirmed($data){
        $user = User::find($data['value']);
        $user->delete();
        $this->alert('success', 'Usuario eliminado con éxito', [
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
