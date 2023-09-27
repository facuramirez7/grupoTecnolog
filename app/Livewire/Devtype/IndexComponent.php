<?php

namespace App\Livewire\Devtype;

use App\Models\DeviceType;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

class IndexComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    #[Rule('min:5|string|required|max:20')]
    public $name = '';


    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        $types = DeviceType::all();
        return view('livewire.devtype.index-component')->with('types', $types);
    }

    public function createType()
    {
        $validated = $this->validate();
        //DB::insert('insert into device_types (name) values (?)', [$validated['name']]);
        DeviceType::create($validated);
        $this->reset();
        $this->alert('success', 'Tipo creado con éxito!',[
            'position' =>  'top',
        ]);
    }

    public function destroyType(DeviceType $type)
    {
        $this->alert('question', "Estas seguro que quieres eliminar el tipo $type->name?", [
            'timer' => null,
            'showConfirmButton' => true,
            'showCancelButton' => True,
            'cancelButtonText' =>  'Cancelar',
            'position' => 'top',
            'confirmButtonColor' => 'red',
            'onConfirmed' => "confirmed",
            'data' => [
                'value' => $type->id,
            ]
        ]);
    }

    public function confirmed($data){
        $type = DeviceType::find($data['value']);
        $type->delete();
        $this->alert('success', 'Tipo de equipo eliminado con éxito', [
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
