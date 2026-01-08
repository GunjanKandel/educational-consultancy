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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
             $table->string('name');
        $table->string('slug')->unique();
        $table->string('flag')->nullable();
        $table->text('description')->nullable();
        $table->text('benefits')->nullable();
        $table->text('requirements')->nullable();
        $table->integer('order')->default(0);
        $table->boolean('is_popular')->default(false);
        $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
