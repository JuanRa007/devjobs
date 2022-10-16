<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Validamos contra el POLICY "VacantePolicy",
        // pasándole el MODELO Vacante.
        $this->authorize('viewAny', Vacante::class);

        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Validamos contra el POLICY "VacantePolicy",
        // pasándole el MODELO Vacante.
        $this->authorize('create', Vacante::class);

        return view('vacantes.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        return view('vacantes.show', [
            'vacante' => $vacante
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {
        // Solo permitimos que lo edite el mismo usuario que la creó,
        // mediente los "policy" creados mendiente la orden:
        // php artisan make:policy VacantePolicy --model=Vacante
        $this->authorize('update', $vacante);

        return view('vacantes.edit', [
            'vacante' => $vacante
        ]);
    }
}
