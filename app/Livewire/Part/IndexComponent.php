<?php

namespace App\Livewire\Part;

use App\Models\Part;
use App\Models\Country;
use App\Models\PartType;
use App\Models\Province;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class IndexComponent extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithFileUploads;

    #[Rule('min:5|string|required|max:50')]
    public $serial_number = '';

    #[Rule('min:5|numeric')]
    public $part_type_id = '';

    #[Rule('required|numeric|min:0')]
    public $buy_prize = '';

    #[Rule('required|numeric|min:0')]
    public $sell_prize = '';

    #[Rule('required|numeric|min:0|nullable')]
    public $stock = '';

    #[Rule('nullable|sometimes|image|max:1024')]
    public $photo;

    public $search = '';

    /* Sorting */
    public $sortBy = 'serial_number';
    public $asc = true;

    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        $parts = Part::where('serial_number', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->asc ? 'ASC' : 'DESC')
            ->paginate(15);
        $types = PartType::orderBy('name', 'ASC')->get();
        $data = [
            'parts' => $parts,
            'types' => $types,
        ];
        return view('livewire.part.index-component')->with($data);
    }


    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function createPart()
    {
        $validated = $this->validate();
        //dd($validated);
        if ($this->photo) {
            $validated['photo'] =  $this->photo->store('parts', 'public');
        }
        Part::create($validated);
        $this->reset();
        $this->alert('success', 'Repuesto creado con éxito!', [
            'position' =>  'top',
        ]);
    }

    public function destroyPart(Part $part)
    {
        $this->alert('question', "Estas seguro que quieres eliminar el repuesto $part->name?", [
            'timer' => null,
            'showConfirmButton' => true,
            'showCancelButton' => True,
            'cancelButtonText' =>  'Cancelar',
            'position' => 'top',
            'confirmButtonColor' => 'red',
            'onConfirmed' => "confirmed",
            'data' => [
                'value' => $part->id,
            ]
        ]);
    }

    public function confirmed($data)
    {
        $part = Part::find($data['value']);
        if ($part->photo) {
            $imagenPath = 'public/' . $part->photo;
            if (Storage::exists($imagenPath)) {
                Storage::delete($imagenPath);
            }
        }
        $part->delete();
        $this->alert('success', 'Repuesto eliminado con éxito', [
            'position' =>  'top',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }

    public function sort($field)
    {
        if ($field == $this->sortBy)
            $this->asc = !$this->asc;
        $this->sortBy = $field;
    }
}
