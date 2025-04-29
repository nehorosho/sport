<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	
	public function up(): void
	{
		Schema::create('users', function (Blueprint $table) {

			$table->id();
			$table->string('lastname');
			$table->string('firstname');
			$table->string('patronymic')->nullable();
			$table->string('login')->unique();
			$table->string('password');
			$table->enum('role', ['User', 'Admin']);
			$table->rememberToken();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('users');
	}
};
