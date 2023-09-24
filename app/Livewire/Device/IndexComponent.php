<?php

namespace App\Livewire\Device;

use App\Models\Client;
use App\Models\Device;
use App\Models\Country;
use App\Models\DeviceType;
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
    public $model = '';

    #[Rule('min:5|string|required')]
    public $serial_number = '';

    #[Rule('required|numeric')]
    public $client_id = null;

    #[Rule('required|numeric')]
    public $deviceType_id = null;

    #[Rule('required|numeric')]
    public $hours_lastServ = null;

    #[Rule('required|numeric')]
    public $actual_hours = null;

    #[Rule('nullable|sometimes|image|max:1024')]
    public $photo;

    public $search = '';
    public $searchClient;

    /* Sorting */
    public $sortBy = 'model';
    public $asc = true;

    protected $listeners = [
        'confirmed'
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'searchClient' => ['except' => ''],
    ];


    public function render($lol = null)
    {
        $devices = Device::when($this->searchClient, function ($query) {
            return $query->where('client_id', '=', $this->searchClient);
        })
            ->where('model', 'like', '%' . $this->search . '%')
            ->orWhere('serial_number', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->asc ? 'ASC' : 'DESC')
            ->paginate(10);
        $clients = Client::all();
        $types = DeviceType::all();
        $data = [
            'devices' => $devices,
            'clients' => $clients,
            'types' => $types
        ];
        return view('livewire.device.index-component')->with($data);
    }


    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSearchClient()
    {
        //dd('hola');
        $this->resetPage();
    }

    public function createDevice()
    {
        $validated = $this->validate();
        if ($this->photo) {
            $validated['photo'] =  $this->photo->store('devices', 'public');
        }
        Device::create($validated);
        $this->reset();
        $this->alert('success', 'Máquina creado con éxito!', [
            'position' =>  'top',
        ]);
    }

    public function destroyDevice(Device $device)
    {
        $this->alert('question', "Estas seguro que quieres eliminar la máquina $device->model - $device->serial_number?", [
            'timer' => null,
            'showConfirmButton' => true,
            'showCancelButton' => True,
            'cancelButtonText' =>  'Cancelar',
            'position' => 'top',
            'confirmButtonColor' => 'red',
            'onConfirmed' => "confirmed",
            'data' => [
                'value' => $device->id,
            ]
        ]);
    }

    public function confirmed($data)
    {
        $device = Device::find($data['value']);
        if ($device->photo) {
            $imagenPath = 'public/' . $device->photo;
            if (Storage::exists($imagenPath)) {
                Storage::delete($imagenPath);
            }
        }
        $device->delete();
        $this->alert('success', 'Máquina eliminado con éxito', [
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
