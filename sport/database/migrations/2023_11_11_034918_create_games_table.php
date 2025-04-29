<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_first_team');
            $table->unsignedBigInteger('id_second_team');
            $table->date('date');
            $table->timestamps();

            $table->foreign('id_first_team')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('id_second_team')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
