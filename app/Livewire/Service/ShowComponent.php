<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

class ShowComponent extends Component
{
    use LivewireAlert;

    public $service;

    #[Rule('min:5|string|required')]
    public $name = "";

    #[Rule('min:5|string|required')]
    public $description = "";

    #[Rule('min:5|string|required')]
    public $prize = "";

    public $updatedName = null;
    public $updatedDesc = null;
    public $updatedPrize = null;

    public function render()
    {
        $this->updatedName ? $this->name = $this->updatedName : $this->name =  $this->service->name;
        $this->updatedDesc ? $this->description = $this->updatedDesc : $this->description =  $this->service->description;
        $this->updatedPrize ? $this->prize = $this->updatedPrize : $this->prize =  $this->service->prize;
        return view('livewire.service.show-component');
    }

    public function edit(Service $service)
    {
        $validated = $this->validate();
        $service->update($validated);
        $this->updatedName = $validated['name'];
        $this->updatedDesc = $validated['description'];
        $this->updatedPrize = $validated['prize'];
        $this->reset('name', 'description', 'prize');
        $this->alert('success', 'Servicio editado con éxito!', [
            'position' =>  'top',
        ]);
    }
}
