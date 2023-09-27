<?php

namespace App\Livewire\Parttype;

use App\Models\PartType;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

class IndexComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    #[Rule('min:5|string|required|max:40')]
    public $name = '';

    public $search = '';


    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        $types = PartType::where('name', 'LIKE', "%{$this->search}%")
            ->orderBy('name', 'ASC')
            ->paginate(10);
        return view('livewire.parttype.index-component')->with('types', $types);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function createType()
    {
        $validated = $this->validate();
        //DB::insert('insert into device_types (name) values (?)', [$validated['name']]);
        PartType::create($validated);
        $this->reset();
        $this->alert('success', 'Tipo creado con éxito!', [
            'position' =>  'top',
        ]);
    }

    public function destroyType(PartType $type)
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

    public function confirmed($data)
    {
        $type = PartType::find($data['value']);
        $type->delete();
        $this->alert('success', 'Tipo de repuesto eliminado con éxito', [
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
