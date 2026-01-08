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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
             $table->string('application_number')->unique();
        $table->foreignId('course_id')->constrained()->onDelete('cascade');
        $table->foreignId('country_id')->constrained()->onDelete('cascade');
        $table->string('full_name');
        $table->string('email');
        $table->string('phone');
        $table->date('date_of_birth');
        $table->text('address');
        $table->string('nationality');
        $table->string('passport_number');
        $table->string('highest_qualification');
        $table->decimal('gpa_percentage', 5, 2);
        $table->enum('english_test', ['IELTS', 'TOEFL', 'PTE', 'Duolingo', 'None']);
        $table->decimal('english_score', 4, 1)->nullable();
        $table->enum('status', ['pending', 'reviewing', 'approved', 'rejected', 'document_required'])->default('pending');
        $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
