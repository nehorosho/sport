<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table -> id();
            $table -> date('date');
            $table -> decimal('sum', 10,2);
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
