<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table -> id();
            $table -> string('title', 250);
            $table -> decimal('price', 10,2);
            $table -> integer('size');
            $table -> string('image');
            $table->foreignId('id_type')->constrained('types')->cascadeOnDelete(); 
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
