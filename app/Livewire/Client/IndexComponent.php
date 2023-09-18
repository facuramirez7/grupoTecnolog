<?php

namespace App\Livewire\Client;

use App\City;
use App\Country;
use App\Models\Client;
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

    #[Rule('min:5|string|required')]
    public $country = '';

    #[Rule('min:5|string|required')]
    public $province = '';

    #[Rule('min:5|string|required')]
    public $address = '';

    #[Rule('required|email')]
    public $email;

    public $search = '';

    /* Sorting */
    public $sortBy = 'name';
    public $asc = true;

    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        $clients = Client::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->asc ? 'ASC' : 'DESC')
            ->paginate(10);
        return view('livewire.client.index-component')->with('clients', $clients);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function createClient()
    {
        $validated = $this->validate();
        Client::create($validated);
        $this->reset();
        $this->alert('success', 'Cliente creado con éxito!', [
            'position' =>  'top',
        ]);
    }

    public function destroyClient(Client $client)
    {
        $this->alert('question', "Estas seguro que quieres eliminar el cliente $client->name?", [
            'timer' => null,
            'showConfirmButton' => true,
            'showCancelButton' => True,
            'cancelButtonText' =>  'Cancelar',
            'position' => 'top',
            'confirmButtonColor' => 'red',
            'onConfirmed' => "confirmed",
            'data' => [
                'value' => $client->id,
            ]
        ]);
    }

    public function confirmed($data)
    {
        $client = Client::find($data['value']);
        $client->delete();
        $this->alert('success', 'Cliente eliminado con éxito', [
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
        if ($field == $this->sortBy)
            $this->asc = !$this->asc;
        $this->sortBy = $field;
    }
}
