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
        Schema::create('game', function (Blueprint $table) {
            $table->id();
	    $table->string('name');
	    $table->string('c0')->default('');
	    $table->string('c1')->default('');
	    $table->string('c2')->default('');
	    $table->string('c3')->default('');
	    $table->string('c4')->default('');
	    $table->string('c5')->default('');
	    $table->string('c6')->default('');
	    $table->string('c7')->default('');
	    $table->string('c8')->default('');
	    $table->string('c9')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game');
    }
};
