<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

Route::get('/members/export', [MemberController::class, 'export'])->name('members.export');

Route::resource('members', MemberController::class);
