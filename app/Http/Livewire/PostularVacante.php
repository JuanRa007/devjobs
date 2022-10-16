<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{

    // Habilitamos la subida de imágenes en LiveWire
    use WithFileUploads;


    public $cv;
    public $vacante;

    // Reglas de validaciones
    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];


    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {

        // Aplicamos las "rules".
        $datos = $this->validate();

        // Almacenar CV
        $cv = $this->cv->store('public/cv');
        $datos['cv'] = str_replace('public/cv/', '', $cv);

        // Crear el candidato a la vacante
        $this->vacante->candidatos()->create([
            'user_id'   => auth()->user()->id,
            'cv'        => $datos['cv']
        ]);

        // Crear Notificación y enviar email.
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));


        // Mostrar al usuario un aviso de OK.
        session()->flash('mensaje', 'Se envió correctamente tu información. ¡Mucha Suerte!');

        // Redireccionar al usuario
        return redirect()->back();
    }


    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
