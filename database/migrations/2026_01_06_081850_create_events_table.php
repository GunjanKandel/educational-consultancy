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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
             $table->string('title');
        $table->string('slug')->unique();
        $table->text('description');
        $table->enum('type', ['seminar', 'workshop', 'fair', 'webinar']);
        $table->dateTime('event_date');
        $table->string('venue')->nullable();
        $table->string('online_link')->nullable();
        $table->integer('capacity')->nullable();
        $table->integer('registered')->default(0);
        $table->string('featured_image')->nullable();
        $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
