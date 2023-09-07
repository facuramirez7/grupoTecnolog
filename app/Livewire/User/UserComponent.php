<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserComponent extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $search = '';

    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.user.user-component')->with('users', $users);
    }

    public function updatedSearch()
    {
        $this->resetPage(); // Reinicia la página actual a 1 cuando se cambia la búsqueda.
    }

    public function editUser(User $user)
    {
        $this->emit('editUser', $user);
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
