<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member; // Asegúrate de importar el modelo


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all(); // Recupera todos los registros de la tabla members
        return view('members.index', compact('members')); // Pasa la variable a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'rut'        => 'required|string|max:20|unique:members',
        'email'      => 'required|email|unique:members',
        'phone'      => 'nullable|string|max:20',
        'address'    => 'nullable|string|max:255',
        'birth_date' => 'nullable|date',
        'join_date'  => 'nullable|date',
    ]);

    Member::create($validated);

    return redirect()
        ->route('members.index')
        ->with('success', 'Socio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);

        $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'rut' => 'required|string|max:20|unique:members,rut,' . $member->id,
        'email' => 'required|email|unique:members,email,' . $member->id,
        'phone' => 'nullable|string|max:20',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Socio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
