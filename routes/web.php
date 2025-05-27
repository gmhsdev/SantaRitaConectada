<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberDocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Socios (Members)
    Route::get('members/export', [MemberController::class, 'export'])->name('members.export'); // <-- esta línea fue movida arriba
    Route::resource('members', MemberController::class);

    // Documentos de socios
    Route::post('members/{member}/documents', [MemberDocumentController::class, 'store'])->name('member-documents.store');
    Route::get('documents/{document}/download', [MemberDocumentController::class, 'download'])->name('member-documents.download');
    Route::delete('documents/{document}', [MemberDocumentController::class, 'destroy'])->name('member-documents.destroy');

    // Rutas de invitaciones (citaciones)
    Route::resource('invitations', \App\Http\Controllers\InvitationController::class);

});

require __DIR__.'/auth.php';
