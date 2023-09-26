<?php

namespace App\Livewire\Device;

use App\Models\Client;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\Service;
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


    #[Rule('min:5|string|required|max:100')]
    public $model = '';

    #[Rule('min:5|string|required|max:50')]
    public $serial_number = '';

    #[Rule('required|numeric')]
    public $client_id = null;

    #[Rule('required|numeric')]
    public $deviceType_id = null;

    #[Rule('required|numeric|min:0')]
    public $hours_lastServ = null;

    #[Rule('required|numeric|min:0')]
    public $actual_hours = null;

    #[Rule('nullable|sometimes|image|max:1024')]
    public $photo;

    public $search = '';
    public $searchClient;
    public $searchType;
    public $searchService;
    public $active;
    public $textActive = 'Todos';

    /* Sorting */
    public $sortBy = 'model';
    public $asc = true;

    protected $listeners = [
        'confirmed'
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'searchClient' => ['except' => ''],
        'searchType' => ['except' => ''],
        'searchService' => ['except' => ''],
    ];


    public function render()
    {
        $devicesQuery = Device::query();
        if (!empty($this->searchService)) {
            $devicesQuery->where('prox_service',  $this->searchService);
        }

        if (!empty($this->active)) {
            $devicesQuery->where('active',  1);
            $this->textActive = 'Activos';
        } else {
            $this->textActive = 'Todos';
        }
        
        if (!empty($this->searchClient)) {
            $devicesQuery->where('client_id', $this->searchClient);
        }

        if (!empty($this->searchType)) {
            $devicesQuery->where('deviceType_id', $this->searchType);
        }

        $devices = $devicesQuery
            ->where(function ($query) {
                $query->where('model', 'like', '%' . $this->search . '%')
                    ->orWhere('serial_number', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->asc ? 'ASC' : 'DESC')
            ->paginate(9);
        $clients = Client::all();
        $types = DeviceType::all();
        $services = Service::all();
        $data = [
            'devices' => $devices,
            'clients' => $clients,
            'types' => $types,
            'services' => $services,
        ];
        return view('livewire.device.index-component')->with($data);
    }


    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSearchClient()
    {
        $this->resetPage();
    }

    public function updatedSearchType()
    {
        $this->resetPage();
    }

    public function updatedSearchService()
    {
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
        $this->alert('success', 'Equipo creado con éxito!', [
            'position' =>  'top',
        ]);
    }

    public function destroyDevice(Device $device)
    {
        $this->alert('question', "Estas seguro que quieres eliminar el equipo: $device->model - $device->serial_number?", [
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
        $this->alert('success', 'Equipo eliminado con éxito', [
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
