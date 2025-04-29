<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table -> id();
            $table -> string('lastname', 250);
            $table -> string('firstname', 250);
            $table -> string('amplya', 250);
            $table -> date('birthday');
            $table -> date('debute');
            $table -> integer('height');
            $table -> integer('weight');
            $table -> integer('qty_game');
            $table -> integer('qty_goal');
            $table -> integer('win');
            $table -> integer('loss');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
