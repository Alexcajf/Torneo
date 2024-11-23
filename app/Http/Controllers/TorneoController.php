<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use App\Models\Participante;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    // Mostrar la lista de torneos
    public function index()
    {
        $torneos = Torneo::with('participantes')->get(); // Cargar torneos con sus participantes
        return view('torneos.index', compact('torneos'));
    }

    // Mostrar formulario para crear un torneo
    public function create()
    {
        return view('torneos.create');
    }

    // Guardar un nuevo torneo y sus participantes
    public function store(Request $request)
    {
        // Validar datos del torneo
        $validatedTorneo = $request->validate([
            'nombre' => 'required|string|max:255',
            'videojuego' => 'required|string|max:255',
            'fecha' => 'required|date',
            'participantes' => 'required|array',
            'participantes.*.nombre' => 'required|string|max:255',
            'participantes.*.email' => 'required|email|max:255',
            'participantes.*.edad' => 'required|integer|min:0',
        ]);

        // Crear el torneo
        $torneo = Torneo::create($validatedTorneo);

        // Crear los participantes
        foreach ($validatedTorneo['participantes'] as $participanteData) {
            $torneo->participantes()->create($participanteData);
        }

        // Redirigir a la página de índice de torneos con un mensaje de éxito
        return redirect()->route('torneos.index')->with('success', 'Torneo y participantes creados con éxito.');
    }

    // Mostrar el formulario de edición de torneo
    public function edit($id)
    {
        $torneo = Torneo::with('participantes')->findOrFail($id);
        return view('torneos.edit', compact('torneo'));
    }

    // Actualizar torneo y participantes
    public function update(Request $request, $id)
    {
        // Validar datos del torneo
        $validatedTorneo = $request->validate([
            'nombre' => 'required|string|max:255',
            'videojuego' => 'required|string|max:255',
            'fecha' => 'required|date',
            'participantes' => 'required|array',
            'participantes.*.id' => 'nullable|exists:participantes,id',
            'participantes.*.nombre' => 'required|string|max:255',
            'participantes.*.email' => 'required|email|max:255',
            'participantes.*.edad' => 'required|integer|min:0',
        ]);

        // Actualizar el torneo
        $torneo = Torneo::findOrFail($id);
        $torneo->update($validatedTorneo);

        // Actualizar los participantes
        $existingParticipantIds = [];
        foreach ($validatedTorneo['participantes'] as $participanteData) {
            if (isset($participanteData['id'])) {
                // Actualizar participante existente
                $participante = Participante::findOrFail($participanteData['id']);
                $participante->update($participanteData);
                $existingParticipantIds[] = $participante->id;
            } else {
                // Crear nuevo participante
                $newParticipante = $torneo->participantes()->create($participanteData);
                $existingParticipantIds[] = $newParticipante->id;
            }
        }

        // Eliminar participantes que no están en la lista actualizada
        $torneo->participantes()->whereNotIn('id', $existingParticipantIds)->delete();

        // Redirigir a la página de índice de torneos con un mensaje de éxito
        return redirect()->route('torneos.index')->with('success', 'Torneo y participantes actualizados con éxito.');
    }

    // Eliminar torneo y sus participantes
    public function destroy($id)
    {
        $torneo = Torneo::findOrFail($id);
        $torneo->delete();

        return redirect()->route('torneos.index')->with('success', 'Torneo eliminado exitosamente.');
    }

    // Otros métodos...

    public function showBrackets($id)
    {
        $torneo = Torneo::findOrFail($id);
        $participantes = $torneo->participantes()->orderBy('id')->get();

        // Agrupar participantes por rounds (puedes ajustar esto según sea necesario)
        $rounds = $participantes->chunk(2);

        return view('torneos.brackets', compact('torneo', 'rounds'));
    }

    public function updateBrackets(Request $request, $id)
    {
        $torneo = Torneo::findOrFail($id);

        // Actualizar los ganadores de cada ronda
        if ($request->has('winners')) {
            foreach ($request->winners as $participanteId) {
                $participante = Participante::find($participanteId);
                if ($participante) {
                    $participante->is_winner = true;
                    $participante->save();
                }
            }
        }

        return redirect()->route('torneos.showBrackets', ['id' => $id])->with('success', 'Brackets actualizados exitosamente.');
    }
}
