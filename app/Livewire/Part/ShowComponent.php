<?php

namespace App\Livewire\Part;

use App\Models\Part;
use App\Models\PartType;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;


class ShowComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $part;

    #[Rule('min:5|string|required|max:40')]
    public $serial_number = '';

    #[Rule('min:5|numeric')]
    public $part_type_id = '';

    #[Rule('required|numeric|min:0')]
    public $buy_prize = '';

    #[Rule('required|numeric|min:0')]
    public $sell_prize = '';

    #[Rule('required|numeric|min:0|nullable')]
    public $stock = '';

    public $photo;

    public $updatedSerialNumber = null;
    public $updatedPartType = null;
    public $updatedBuyPrize = null;
    public $updatedSellPrize = null;
    public $updatedStock = null;
    public $updatedPhoto = null;
    public $updatedPhotoView = null;

    public function render()
    {
        $types = PartType::orderBy('name' , 'asc')->get();
        $this->updatedSerialNumber ? $this->serial_number = $this->updatedSerialNumber : $this->serial_number =  $this->part->serial_number;
        $this->updatedBuyPrize ? $this->buy_prize = $this->updatedBuyPrize : $this->buy_prize =  $this->part->buy_prize;
        $this->updatedSellPrize ? $this->sell_prize = $this->updatedSellPrize : $this->sell_prize =  $this->part->sell_prize;
        $this->updatedStock ? $this->stock = $this->updatedStock : $this->stock =  $this->part->stock;
        $this->updatedPhoto ? $this->photo = $this->updatedPhoto : $this->photo =  $this->part->photo;
        return view('livewire.part.show-component')->with('types', $types);
    }


    public function mount()
    {
        $this->part_type_id = $this->part->part_type_id;
    }

    public function edit(Part $part)
    {
        $validated = $this->validate();
        $this->updatedSerialNumber = $validated['serial_number'];
        $this->updatedBuyPrize = $validated['buy_prize'];
        $this->updatedSellPrize = $validated['sell_prize'];
        $this->updatedStock = $validated['stock'];
        if(isset($this->updatedPhoto)){
            $validated['photo'] =  $this->updatedPhoto->store('parts', 'public');
            if ($part->photo) {
                $imagenPath = 'public/' . $part->photo;
                if (Storage::exists($imagenPath)) {
                    Storage::delete($imagenPath);
                }
            }
        }
        $part->update($validated);
        $this->alert('success', 'Repuesto editado con éxito!', [
            'position' =>  'top',
        ]);
    }
    
    public function loadFoto()
    {
        $this->updatedPhotoView = $this->updatedPhoto;
    }
}
