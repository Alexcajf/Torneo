<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participante;
use App\Models\Torneo;

class ParticipanteController extends Controller
{
    public function index($torneo_id)
    {
        $torneo = Torneo::findOrFail($torneo_id);
        $participantes = $torneo->participantes; // Relación con participantes
        return view('participantes.index', compact('participantes', 'torneo'));
    }

    public function create($torneo_id)
    {
        $torneo = Torneo::findOrFail($torneo_id);
        return view('participantes.create', compact('torneo')); // Mostrar formulario
    }

    public function store(Request $request, $torneo_id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
        ]);

        $torneo = Torneo::findOrFail($torneo_id);
        $torneo->participantes()->create($validated); // Crear participante vinculado al torneo
        return redirect()->route('participantes.index', $torneo_id)->with('success', 'Participante añadido con éxito.');
    }

    public function edit($id)
    {
        $participante = Participante::findOrFail($id);
        return view('participantes.edit', compact('participante'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
        ]);

        $participante = Participante::findOrFail($id);
        $participante->update($validated); // Actualizar participante
        return redirect()->route('participantes.index', $participante->torneo_id)->with('success', 'Participante actualizado con éxito.');
    }

    public function destroy($id)
    {
        $participante = Participante::findOrFail($id);
        $torneo_id = $participante->torneo_id;
        $participante->delete(); // Eliminar participante
        return redirect()->route('participantes.index', $torneo_id)->with('success', 'Participante eliminado con éxito.');
    }
}
