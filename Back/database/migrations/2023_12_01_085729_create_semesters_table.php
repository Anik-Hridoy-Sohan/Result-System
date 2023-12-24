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
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept_id');
            $table->unsignedBigInteger('stage_id'); // 1.1, 1.2, 2.1, 2.2, 3.1, 3.2, 4.1, 4.2, 5.1, 5.2, 6.1, 6.2....
            $table->string('year');
            $table->unsignedBigInteger('program_id');
            $table->timestamps();

            $table->unique(['dept_id', 'stage_id', 'year', 'program_id']);
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
