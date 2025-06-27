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
        Schema::create('log', function (Blueprint $table) {
		$table->id()->autoIncrement();
		$table->time('timeOfCapture', $precision = 0);
		$table->string('type')->default('');
		$table->string('sourceIP')->default('');
		$table->string('sourcePort')->default('');
		$table->string('destIP')->default('');
		$table->string('destPort')->default('');
		$table->string('contentOfCapture')->default('');
		$table->string('comments')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log');
    }
};
