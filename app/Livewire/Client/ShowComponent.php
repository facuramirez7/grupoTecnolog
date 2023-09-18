<?php

namespace App\Livewire\Client;

use App\Models\Rol;
use App\Models\Client;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;


class ShowComponent extends Component
{
    use LivewireAlert;

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

    public $updatedName = null;
    public $updatedCountry = null;
    public $updatedProvince = null;
    public $updatedAddress = null;
    public $updatedEmail = null;

    public function render()
    {
        $this->updatedName ? $this->name = $this->updatedName : $this->name =  $this->client->name;
        $this->updatedCountry ? $this->country = $this->updatedCountry : $this->country =  $this->client->country;
        $this->updatedProvince ? $this->province = $this->updatedProvince : $this->province =  $this->client->province;
        $this->updatedAddress ? $this->address = $this->updatedAddress : $this->address =  $this->client->address;
        $this->updatedEmail ? $this->email = $this->updatedEmail : $this->email =  $this->client->email;
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
        $client->update($validated);
        $this->alert('success', 'Usuario editado con éxito!', [
            'position' =>  'top',
        ]);
    }
}
