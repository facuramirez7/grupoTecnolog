<?php

namespace App\Livewire\Client;

use App\Models\Client;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class IndexComponent extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithFileUploads;

    #[Rule('min:5|string|required')]
    public $name = '';

    #[Rule('required|numeric')]
    public $country_id = 1;

    #[Rule('required|numeric')]
    public $province_id = 13;

    #[Rule('min:5|string|required')]
    public $address = '';

    #[Rule('required|email')]
    public $email;

    #[Rule('nullable|sometimes|image|max:1024')]
    public $photo;

    public $countries;
    public $provinces;
    public $selectedCountry = null;
    public $selectedProvince = null;
    

    public $search = '';

    /* Sorting */
    public $sortBy = 'name';
    public $asc = true;

    protected $listeners = [
        'confirmed'
    ];

    public function mount()
    {
        $this->countries = Country::all();
        $this->provinces = collect();
    }

    public function render()
    {
        $clients = Client::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->asc ? 'ASC' : 'DESC')
            ->paginate(10);
        $data = [
            'clients' => $clients
        ];
        return view('livewire.client.index-component')->with($data);
    }

    public function updatedSelectedCountry($country)
    {
        $this->provinces = Province::where('country_id', $country)->get();
        $this->selectedProvince = null;
    }


    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function createClient()
    {
        $validated = $this->validate();
        $validated = array_merge($validated, ['country_id' => $this->selectedCountry, 'province_id' => $this->selectedProvince]);
        if ($this->photo) {
            $validated['photo'] =  $this->photo->store('clients', 'public');
        }
        Client::create($validated);
        $this->reset();
        $this->countries = Country::all();
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
        if ($client->photo) {
            $imagenPath = 'public/' . $client->photo;
            if (Storage::exists($imagenPath)) {
                Storage::delete($imagenPath);
            }
        }
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
