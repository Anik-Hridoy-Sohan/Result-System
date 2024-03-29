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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('invigilator_id');
            $table->unsignedBigInteger('course_id');
            $table->string('type');
            $table->float('total_mark');
            $table->float('achived_mark');
            $table->timestamps();

            $table->unique(['student_id', 'course_id']);
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('invigilator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
