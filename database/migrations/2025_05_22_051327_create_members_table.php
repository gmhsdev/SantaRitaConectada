<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('rut')->unique();                // RUT chileno
            $table->string('first_name');                   // Nombre
            $table->string('last_name');                    // Apellido
            $table->string('email')->nullable();            // Email (opcional)
            $table->string('phone')->nullable();            // Teléfono (opcional)
            $table->string('address')->nullable();          // Dirección
            $table->date('birth_date')->nullable();         // Fecha de nacimiento
            $table->date('join_date')->nullable();          // Fecha de ingreso a la junta
            $table->boolean('is_active')->default(true);    // Activo o no
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
