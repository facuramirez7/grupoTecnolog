<?php

namespace App\Livewire\Service;

use App\Models\Device;
use App\Models\Service;
use App\Models\ServicePerformed;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

use function Laravel\Prompts\text;

class PerformedComponent extends Component
{
    use LivewireAlert;

    public $service_id = "";

    public $device_id = "";

    public $client_id = null;

    #[Rule('min:5|string|required|max:1000')]
    public $description = "";

    #[Rule('min:5|string|max:255|nullable|sometimes')]
    public $observations = "";

    #[Rule("min:0|numeric|required")]
    public $actual_hours = 0;
    
    public $selectedService = null;
    public $selectedDevice = null;
    public $client = null;

    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        $devices = Device::orderBy('model', 'asc')->get();
        $services = Service::all();
        $data = [
            'services' => $services,
            'devices' => $devices,
        ];
        return view('livewire.service.performed-component')->with($data);
    }

    public function updatedSelectedDevice()
    {
        $device = Device::find($this->selectedDevice);
        $this->actual_hours = $device->actual_hours;
        $this->client = $device->client;
    }

    public function create()
    {
        $validated = $this->validate();
        $validated = array_merge($validated, [
            'service_id' => $this->selectedService,
            'device_id' => $this->selectedDevice,
            'client_id' => $this->client->id,
            'user_id' => auth()->user()->id,
        ]);
        //dd($validated);
        $device = Device::find($this->selectedDevice);
        $service = Service::find($this->selectedService);
        $this->alert('question', "Estas seguro que quieres crear un servicio <b style='color: black !important;'>$service->name</b> para la máquina  <b style='color: black !important;'>$device->model - $device->serial_number</b>?", [
            'timer' => null,
            'showConfirmButton' => true,
            'showCancelButton' => True,
            'cancelButtonText' =>  'Cancelar',
            'position' => 'top',
            'confirmButtonColor' => 'green',
            'onConfirmed' => "confirmed",
            'data' => [
                'value' => $validated,
            ]
        ]);
    }

    public function confirmed($data)
    {
        ServicePerformed::create($data['value']);
        $this->alert('success', 'Creado con éxito!', [
            'position' =>  'top',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
        $this->reset();
    }
}
