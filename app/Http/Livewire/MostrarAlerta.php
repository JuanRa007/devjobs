<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MostrarAlerta extends Component
{

    // He de definirlo aquí, ya que la uso para pasarla al componete:
    // <livewire:mostrar-alerta :message="$message" />
    public $message;

    public function render()
    {
        return view('livewire.mostrar-alerta');
    }
}
