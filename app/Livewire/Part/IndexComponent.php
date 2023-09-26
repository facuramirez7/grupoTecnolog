<?php

namespace App\Livewire\Part;

use App\Models\Part;
use App\Models\Country;
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

    #[Rule('min:5|string|required|max:40')]
    public $name = '';

    #[Rule('required|numeric')]
    public $country_id = 1;

    #[Rule('required|numeric')]
    public $province_id = 13;

    #[Rule('min:5|string|required|max:150')]
    public $address = '';

    #[Rule('required|email')]
    public $email;

    #[Rule('nullable|sometimes|image|max:1024')]
    public $photo;

    public $countries;
    public $provinces;
    public $selectedCountry = null;
    public $selectedProvince = null;
    

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
        $data = [
            'parts' => $parts
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
        $validated = array_merge($validated, ['country_id' => $this->selectedCountry, 'province_id' => $this->selectedProvince]);
        if ($this->photo) {
            $validated['photo'] =  $this->photo->store('parts', 'public');
        }
        Part::create($validated);
        $this->reset();
        $this->countries = Country::all();
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
