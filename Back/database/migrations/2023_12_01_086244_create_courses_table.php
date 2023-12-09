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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code');
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('dept_id');
            $table->string('name');
            $table->unsignedDecimal('cradit', $precision = 8, $scale = 2);
            $table->timestamps();

            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
