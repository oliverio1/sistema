<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Study;
use App\Models\Client;
use App\Models\ClientStudy;

class Prices extends Component
{
    public $editedPriceIndex;
    public $client_id;
    public $prices;
    public $price;
    public $client;
    public $amount;
    public $studiesId = [];

    protected $rules = [
        'price' => 'required|numeric'
    ];

    protected $messages = [
        'price.required' => 'Ingresa el precio para el estudio',
        'price.numeric' => 'Debes ingresar solamente números'
    ];

    public function render()
    {
        $this->client_id = $this->client_id;
        $this->client = Client::where('id',$this->client_id)->first();
        $this->prices = ClientStudy::where('client_id',$this->client_id)
        ->join('studies','client_study.study_id','=','studies.id')
        ->select('client_study.price','studies.name','studies.price as list','client_study.id')
        ->get();
        return view('livewire.prices');
    }

    public function editar($priceIndex) {
        $this->editedPriceIndex = $priceIndex;
    }

    public function guardar($priceIndex) {
        $this->validate();
        $this->editedPriceIndex = $priceIndex;
        ClientStudy::find($this->editedPriceIndex)->update([
            'price' => $this->price
        ]);
        $this->price = '';
        $this->editedPriceIndex = null;
    } 
}
