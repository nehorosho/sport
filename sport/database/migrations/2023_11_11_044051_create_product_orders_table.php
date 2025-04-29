<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table -> id();
            $table -> integer('qty');
            $table->foreignId('id_order')->constrained('orders')->cascadeOnDelete(); 
            $table->foreignId('id_product')->constrained('products')->cascadeOnDelete(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_orders');
    }
};
