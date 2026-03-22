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
        Schema::create('weeks', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('year');
            $table->tinyInteger('week_number');
            $table->string('descriptor');
            $table->unsignedTinyInteger('month'); // Mes del inicio de la semana (1-12)
            $table->decimal('price', 8, 2)->default(0);
            $table->string('status')->default('LIBRE'); // Estados: LIBRE, PRE-RESERVA, RESERVADO, NO DISPONIBLE
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weeks');
    }
};
