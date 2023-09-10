<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

class IndexComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    #[Rule('min:5|string|required')]
    public $name = '';

    #[Rule('required|unique:users|email')]
    public $email;

    public $search = '';
    public $userId;

    /* Sorting */
    public $sortBy = 'name';
    public $asc = true;


    protected $queryString = [
        'sortBy' => ['except' => 'name'],
        'asc' => ['except' => true],
    ];

    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->asc ? 'ASC' : 'DESC')
            ->paginate(10);
        return view('livewire.user.index-component')->with('users', $users);
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
        $this->alert('success', 'Usuario creado con éxito!', [
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

    public function confirmed($data)
    {
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

    public function sort($field)
    {
        if($field == $this->sortBy)
            $this->asc = !$this->asc;
        $this->sortBy = $field;
    }
}
