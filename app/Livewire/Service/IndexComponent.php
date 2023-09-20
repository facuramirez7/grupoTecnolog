<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

class IndexComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    #[Rule('required|min:5|string')]
    public $name = '';

    #[Rule('required|min:5|string')]
    public $description = '';

    #[Rule('required|numeric')]
    public $prize = '';

    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        $service = Service::all();
        return view('livewire.service.index-component')->with('services', $service);
    }

    public function createService()
    {
        $validated = $this->validate();
        Service::create($validated);
        $this->reset();
        $this->alert('success', 'Servicio creado con éxito!',[
            'position' =>  'top',
        ]);
    }

    public function destroyService(Service $service)
    {
        $this->alert('question', "Estas seguro que quieres eliminar el servicio $service->name?", [
            'timer' => null,
            'showConfirmButton' => true,
            'showCancelButton' => True,
            'cancelButtonText' =>  'Cancelar',
            'position' => 'top',
            'confirmButtonColor' => 'red',
            'onConfirmed' => "confirmed",
            'data' => [
                'value' => $service->id,
            ]
        ]);
    }

    public function confirmed($data){
        $service = Service::find($data['value']);
        $service->delete();
        $this->alert('success', 'Servicio eliminado con éxito', [
            'position' =>  'top',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }
}
