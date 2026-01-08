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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
              $table->string('student_name');
        $table->string('student_photo')->nullable();
        $table->foreignId('country_id')->constrained();
        $table->foreignId('course_id')->nullable()->constrained();
        $table->string('university')->nullable();
        $table->text('testimonial');
        $table->integer('rating')->default(5);
        $table->string('video_url')->nullable();
        $table->boolean('is_featured')->default(false);
        $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
