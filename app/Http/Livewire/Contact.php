<?php

namespace App\Http\Livewire;

// Componente Livewire para el formulario de contáctenos

use App\Models\Contact as Contactos;
use Livewire\Component;


class Contact extends Component
{
    public $data, $name, $email, $message, $phone, $asunto, $selected_id;
    public $updateMode = false;

    public function render()
    {
        return view('livewire.contact');
    }

    public function edit()
    {
        return view('admin.informacion.edit');
    }
}
