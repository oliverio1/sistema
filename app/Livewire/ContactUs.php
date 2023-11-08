<?php

namespace App\Livewire;
use App\Models\Contact;

use Livewire\Component;

class ContactUs extends Component
{
    public $name, $email, $subject, $message;
    public $mostrar = 0;

    protected $rules = [
        'name' => ['required', 'string'],
        'email' => ['required', 'email'],
        'subject' => ['required'],
        'message' => ['required']
    ];

    public function render()
    {
        return view('livewire.contact-us');
    }

    public function enviar() {
        // Validamos los campos
        $this->validate();
        Contact::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'subject'=>$this->subject,
            'message'=>$this->message
        ]);
        $this->name = '';
        $this->email = '';
        $this->subject = '';
        $this->message = '';
        $this->mostrar = 1;
    }
}
