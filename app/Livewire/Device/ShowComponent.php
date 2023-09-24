<?php

namespace App\Livewire\Device;

use App\Models\Rol;
use App\Models\Device;
use App\Models\Country;
use App\Models\Province;
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

    #[Rule('min:5|string|required')]
    public $province = '';

    #[Rule('min:5|string|required')]
    public $address = '';

    #[Rule('required|email')]
    public $email;

    public $photo;

    #[Rule('bool')]
    public $active;

    public $updatedModel = null;
    public $updatedSerial_number = null;

    public $updatedPhoto = null;
    public $updatedPhotoView = null;

    public function render()
    {
        $country = Country::find($this->device->country_id);
        $province = Province::find($this->device->province_id);
        $this->updatedModel ? $this->model = $this->updatedModel : $this->model =  $this->device->model;
        $this->updatedSerial_number ? $this->serial_number = $this->updatedSerial_number : $this->serial_number =  $this->device->serial_number;

        $this->updatedPhoto ? $this->photo = $this->updatedPhoto : $this->photo =  $this->device->photo;
        $this->active = $this->device->active;
        return view('livewire.device.show-component');
    }


    public function edit(Device $device)
    {
        $validated = $this->validate();
        $this->updatedModel = $validated['model'];
        if(isset($this->updatedPhoto)){
            $validated['photo'] =  $this->updatedPhoto->store('devices', 'public');
            if ($device->photo) {
                $imagenPath = 'public/' . $device->photo;
                if (Storage::exists($imagenPath)) {
                    Storage::delete($imagenPath);
                }
            }
        }

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
