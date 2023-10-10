<?php

namespace App\Livewire\Device;

use App\Models\Device;
use App\Models\ServicePerformed;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

class ServicesComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $device;

    public function render()
    {
        $performeds = $this->device->performeds()->orderBy('created_at', 'asc')->paginate(10);
        return view('livewire.device.services-component')->with('performeds', $performeds);
    }

    public function approveService(ServicePerformed $service)
    {
        $service->approved = true;
        $service->viewed = true;
        $service->save();
        if($service->actual_hours > $this->device->actual_hours){
           $this->device->actual_hours = $service->actual_hours; 
           $this->device->update_actualHours = $service->created_at;
        }
        $this->device->service_id = $service->service_id;
        $this->device->save();
        $this->alert('success', 'Servicio aprobado con éxito!',[
            'position' =>  'top',
        ]);
    }


    public function rejectService(ServicePerformed $service)
    {
        $service->approved = false;
        $service->viewed = true;
        $service->save();
        $this->alert('success', 'Servicio rechazado con éxito.',[
            'position' =>  'top',
        ]);
    }
}
