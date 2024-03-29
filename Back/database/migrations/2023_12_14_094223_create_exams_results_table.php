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
        Schema::create('exams_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('result_id');
            $table->unsignedBigInteger('exam_id');
            $table->timestamps();

            $table->foreign('result_id')->references('id')->on('results')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams_results');
    }
};
