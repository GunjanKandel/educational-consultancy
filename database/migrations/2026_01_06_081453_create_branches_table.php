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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
             $table->string('name');
        $table->text('address');
        $table->string('city');
        $table->string('state')->nullable();
        $table->string('country')->default('Nepal');
        $table->string('phone');
        $table->string('email');
        $table->string('map_url')->nullable();
        $table->boolean('is_main')->default(false);
        $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
