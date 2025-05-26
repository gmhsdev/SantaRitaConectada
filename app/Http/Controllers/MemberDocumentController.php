<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberDocument;
use Illuminate\Support\Facades\Storage;

class MemberDocumentController extends Controller
{
    public function store(Request $request, $memberId)
    {
        $request->validate([
            'document' => 'required|file|max:2048', // máximo 2MB
        ]);

        $member = Member::findOrFail($memberId);

        $path = $request->file('document')->store('member_documents', 'public');

        MemberDocument::create([
            'member_id' => $member->id,
            'document_name' => $request->file('document')->getClientOriginalName(),
            'document_path' => $path,
        ]);

        return redirect()->route('members.show', $member->id)
                         ->with('success', 'Documento subido exitosamente.');
    }

    public function download($id)
    {
    $document = MemberDocument::findOrFail($id);

    return Storage::disk('public')->download($document->document_path, $document->document_name);
    }



    public function destroy($id)
    {
        $document = MemberDocument::findOrFail($id);

        // Eliminar archivo del disco
        Storage::disk('public')->delete($document->document_path);

        $document->delete();

        return back()->with('success', 'Documento eliminado correctamente.');
    }
}
