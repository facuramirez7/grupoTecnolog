<?php

namespace App\Livewire\Client;

use App\Models\Rol;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;


class ShowComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $client;

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

    public $photo;

    #[Rule('bool')]
    public $active;

    public $updatedName = null;
    public $updatedCountry = null;
    public $updatedProvince = null;
    public $updatedAddress = null;
    public $updatedEmail = null;
    public $updatedPhoto = null;
    public $updatedActive = 'unprocessed';
    public $updatedPhotoView = null;

    public function render()
    {
        $this->updatedName ? $this->name = $this->updatedName : $this->name =  $this->client->name;
        $this->updatedCountry ? $this->country = $this->updatedCountry : $this->country =  $this->client->country;
        $this->updatedProvince ? $this->province = $this->updatedProvince : $this->province =  $this->client->province;
        $this->updatedAddress ? $this->address = $this->updatedAddress : $this->address =  $this->client->address;
        $this->updatedEmail ? $this->email = $this->updatedEmail : $this->email =  $this->client->email;
        $this->updatedActive != 'unprocessed' ? $this->active = $this->updatedActive : $this->active =  $this->client->active;
        $this->updatedPhoto ? $this->photo = $this->updatedPhoto : $this->photo =  $this->client->photo;
        $this->active = $this->client->active;
        return view('livewire.client.show-component');
    }


    public function edit(Client $client)
    {
        $validated = $this->validate();
        $this->updatedName = $validated['name'];
        $this->updatedCountry = $validated['country'];
        $this->updatedProvince = $validated['province'];
        $this->updatedAddress = $validated['address'];
        $this->updatedEmail = $validated['email'];
        if(isset($this->updatedPhoto)){
            $validated['photo'] =  $this->updatedPhoto->store('clients', 'public');
            if ($client->photo) {
                $imagenPath = 'public/' . $client->photo;
                if (Storage::exists($imagenPath)) {
                    Storage::delete($imagenPath);
                }
            }
        }
        if($validated['active'] == null){
            $validated['active'] = 0;
        } else {
            $validated['active'] = 1;
        }
        
        $this->updatedActive = $validated['active'];
        $client->update($validated);
        $this->alert('success', 'Usuario editado con éxito!', [
            'position' =>  'top',
        ]);
    }
    
    public function loadFoto()
    {
        $this->updatedPhotoView = $this->updatedPhoto;
    }
}
