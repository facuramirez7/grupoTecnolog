<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;
    public $search = '';

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
}
