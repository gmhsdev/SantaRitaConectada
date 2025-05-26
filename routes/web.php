<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberDocumentController;

// Ruta para exportar socios a CSV
Route::get('/members/export', [MemberController::class, 'export'])->name('members.export');

// Rutas CRUD de Socios
Route::resource('members', MemberController::class);

// Rutas para documentos de socios
Route::post(
    '/members/{member}/documents',
    [MemberDocumentController::class, 'store']
)->name('member-documents.store');

Route::get(
    '/documents/{id}/download',
    [MemberDocumentController::class, 'download']
)->name('member-documents.download');

Route::delete(
    '/documents/{id}',
    [MemberDocumentController::class, 'destroy']
)->name('member-documents.destroy');
