<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{

    // Propiedades a controlar
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    // Habilitamos la subida de imágenes en LiveWire
    use WithFileUploads;

    // Reglas de validaciones
    protected $rules = [
        'titulo'      => 'required|string',
        'salario'     => 'required',
        'categoria'   => 'required',
        'empresa'     => 'required',
        'ultimo_dia'  => 'required',
        'descripcion' => 'required',
        'imagen'      => 'required|image|max:1024'
    ];

    public function crearVacante()
    {
        // Aplicamos las "rules".
        $datos = $this->validate();
    }


    public function render()
    {
        // Consultar BBDD
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', [
            'salarios'   => $salarios,
            'categorias' => $categorias
        ]);
    }
}
