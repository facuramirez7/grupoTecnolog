<?php

namespace App\Livewire\Device;

use App\Models\Client;
use App\Models\Device;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;


class ShowComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $device;

    #[Rule('min:5|string|required')]
    public $model = '';

    #[Rule('min:5|string|required')]
    public $serial_number = '';

    #[Rule('min:0|numeric|required')]
    public $hours_lastServ = '';

    #[Rule('min:0|numeric|required')]
    public $actual_hours = '';

    #[Rule('required|numeric')]
    public $service_id;

    #[Rule('required|numeric')]
    public $prox_service;

    #[Rule('required|numeric')]
    public $client_id;

    #[Rule('bool')]
    public $active;

    public $last_visit;
    public $update_actualHours;

    public $photo;

    public $updatedModel = null;
    public $updatedSerial_number = null;
    public $updatedHours_lastServ = null;
    public $updatedActual_hours = null;
    public $updatedLastVisit = null;
    public $updatedUpdate_actualHours = null;
    public $updatedPhoto = null;
    public $updatedPhotoView = null;
    public $updatedClient = null;
    public $updatedActive = 'unprocessed';

    public function mount()
    {
        $this->service_id = $this->device->service_id;
        $this->prox_service = $this->device->prox_service;
        $this->client_id = $this->device->client_id;
    }

    public function render()
    {
        $this->updatedModel ? $this->model = $this->updatedModel : $this->model =  $this->device->model;
        $this->updatedSerial_number ? $this->serial_number = $this->updatedSerial_number : $this->serial_number =  $this->device->serial_number;
        $this->updatedHours_lastServ ? $this->hours_lastServ = $this->updatedHours_lastServ : $this->hours_lastServ =  $this->device->hours_lastServ;
        $this->updatedActual_hours ? $this->actual_hours = $this->updatedActual_hours : $this->actual_hours =  $this->device->actual_hours;
        $this->updatedLastVisit ? $this->last_visit = $this->updatedLastVisit : $this->last_visit =  $this->device->last_visit;
        $this->updatedUpdate_actualHours ? $this->update_actualHours = $this->updatedUpdate_actualHours : $this->update_actualHours =  $this->device->update_actualHours;
        //$this->updatedActive != 'unprocessed' ? $this->active = $this->updatedActive : $this->active =  $this->device->active;
        $this->updatedPhoto ? $this->photo = $this->updatedPhoto : $this->photo =  $this->device->photo;
        $this->active = $this->device->active;
        $clients = Client::all();
        $services = Service::all();
        $data = [
            'clients' => $clients,
            'services' => $services,
        ];
        return view('livewire.device.show-component')->with($data);
    }


    public function edit(Device $device)
    {
        $validated = $this->validate();
        $this->validate([
            'last_visit' => 'required|date',
            'update_actualHours' => 'required|date',
        ]);
        $validated = array_merge($validated, ['last_visit' => $this->last_visit, 'update_actualHours' => $this->update_actualHours]);
        $this->updatedModel = $validated['model'];
        $this->updatedSerial_number = $validated['serial_number'];
        $this->updatedHours_lastServ = $validated['hours_lastServ'];
        $this->updatedActual_hours = $validated['actual_hours'];
        $this->updatedModel = $validated['model'];
        $this->updatedLastVisit = $validated['last_visit'];
        $this->updatedUpdate_actualHours = $validated['update_actualHours'];
        $this->updatedUpdate_actualHours = $validated['update_actualHours'];
        if(isset($this->updatedPhoto)){
            $validated['photo'] =  $this->updatedPhoto->store('devices', 'public');
            if ($device->photo) {
                $imagenPath = 'public/' . $device->photo;
                if (Storage::exists($imagenPath)) {
                    Storage::delete($imagenPath);
                }
            }
        }

        if($validated['active'] == false){
            $validated['active'] = 0;
        } else {
            $validated['active'] = 1;
        }
        
        $this->updatedActive = $validated['active'];

        $device->update($validated);
        $this->alert('success', 'Equipo editado con éxito!', [
            'position' =>  'top',
        ]);
    }
    
    public function loadFoto()
    {
        $this->updatedPhotoView = $this->updatedPhoto;
    }
}
