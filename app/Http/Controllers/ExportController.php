<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{
    public function export()
    {
        $filename = 'socios_' . now()->format('Y-m-d_H-i-s') . '.csv';
        $path = storage_path('app/' . $filename);

        $writer = SimpleExcelWriter::create($path);

        Member::all()->each(function ($member) use ($writer) {
            $writer->addRow([
                'ID' => $member->id,
                'Nombre' => $member->name,
                'Correo' => $member->email,
                'Teléfono' => $member->phone,
                'Fecha de creación' => $member->created_at->format('Y-m-d H:i'),
            ]);
        });

        $writer->close();

        return response()->download($path)->deleteFileAfterSend(true);
    }
}
