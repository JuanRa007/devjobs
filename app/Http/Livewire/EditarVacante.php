<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class EditarVacante extends Component
{

    // Los nombres que coincidan con los "wire:model=" que tiene el formulario.
    public $vacante_id;             // No se usa en el formulario, lo usamos para saber el registro a modificar
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagen_nueva;

    // Habilitamos la subida de imágenes en LiveWire
    use WithFileUploads;

    // Reglas de validaciones
    protected $rules = [
        'titulo'        => 'required|string',
        'salario'       => 'required',
        'categoria'     => 'required',
        'empresa'       => 'required',
        'ultimo_dia'    => 'required',
        'descripcion'   => 'required',
        'imagen_nueva'  => 'nullable|image|max:1024'
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante_id   = $vacante->id;
        $this->titulo       = $vacante->titulo;
        $this->salario      = $vacante->salario_id;
        $this->categoria    = $vacante->categoria_id;
        $this->empresa      = $vacante->empresa;
        $this->ultimo_dia   = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion  = $vacante->descripcion;
        $this->imagen       = $vacante->imagen;
    }

    public function editarVacante()
    {
        $datos = $this->validate();

        // Comprobar si hay una imagen nueva.
        if ($this->imagen_nueva) {
            $imagen = $this->imagen_nueva->store('public/vacantes');
            $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);
        }


        // Encontrar la vacante a modificar.
        $vacante = Vacante::find($this->vacante_id);

        // Asignar los valores.
        $vacante->titulo        = $datos['titulo'];
        $vacante->salario_id    = $datos['salario'];
        $vacante->categoria_id  = $datos['categoria'];
        $vacante->empresa       = $datos['empresa'];
        $vacante->ultimo_dia    = $datos['ultimo_dia'];
        $vacante->descripcion   = $datos['descripcion'];
        $vacante->imagen        = $datos['imagen'] ?? $vacante->imagen;

        // Guardar la vacante.
        $vacante->save();


        // Redireccionar.
        session()->flash('mensaje', 'La Vacante se actualizó Correctamente.');

        return redirect()->route('vacantes.index');
    }

    public function render()
    {

        // Consultar BBDD
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.editar-vacante', [
            'salarios'   => $salarios,
            'categorias' => $categorias
        ]);
    }
}
