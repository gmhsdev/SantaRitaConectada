<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    // Muestra una lista paginada de invitaciones
    public function index()
    {
        $invitations = Invitation::orderBy('scheduled_at','desc')->paginate(10);
        return view('invitations.index', compact('invitations'));
    }

    // Formulario para crear una nueva invitación
    public function create()
    {
        return view('invitations.create');
    }

    // Almacena en BD la invitación recién creada
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'body'         => 'nullable|string',
            'scheduled_at' => 'required|date',
        ]);

        Invitation::create($data);

        return redirect()
            ->route('invitations.index')
            ->with('success', 'Citación creada correctamente.');
    }

    // Muestra el formulario para editar una invitación existente
    public function edit(Invitation $invitation)
    {
        return view('invitations.edit', compact('invitation'));
    }

    // Actualiza la invitación en BD
    public function update(Request $request, Invitation $invitation)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'body'         => 'nullable|string',
            'scheduled_at' => 'required|date',
        ]);

        $invitation->update($data);

        return redirect()
            ->route('invitations.index')
            ->with('success', 'Citación actualizada correctamente.');
    }

    // Elimina la invitación
    public function destroy(Invitation $invitation)
    {
        $invitation->delete();

        return redirect()
            ->route('invitations.index')
            ->with('success', 'Citación eliminada.');
    }
}
