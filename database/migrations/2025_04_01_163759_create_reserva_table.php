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
        Schema::create('reserva', function (Blueprint $table) {
            $table->id();
            $table->date('fechaR');
            $table->string('estado');
            $table->timestamps();
            $table->unsignedBigInteger('ids'); 
            $table->unsignedBigInteger('idu');
            $table->foreign('ids')->references('id')->on('salon')->onDelete('cascade');
            $table->foreign('idu')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva');
    }
};
