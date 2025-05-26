<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('member_documents', function (Blueprint $table) {
        $table->id();
        $table->foreignId('member_id')->constrained()->onDelete('cascade');
        $table->string('document_name'); // Nombre del archivo original
        $table->string('document_path'); // Ruta en storage
        $table->timestamps();
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
    Schema::dropIfExists('member_documents');
    }

};
