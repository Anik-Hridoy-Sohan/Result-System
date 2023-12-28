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
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->default('Not specified');
            $table->string('doc_file')->nullable();
            $table->string('avatar')->nullable();
            $table->string('mobile')->unique();
            $table->integer('status')->default(0);
            $table->string('father_name')->default('John Doe');
            $table->string('mother_name')->default('jane Doe');
            $table->string('nationality')->default('Bangladesh');
            $table->string('religion')->default('Human');
            $table->date('dob')->default(now());
            $table->string('emergency_mobile')->default('Not available');

            $table->string('student_id')->nullable();
            $table->unsignedBigInteger('program_id')->nullable();
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->string('session')->nullable();
            $table->string('teacher_id')->nullable();
            $table->string('staff_id')->nullable();
            $table->unsignedBigInteger('role_id')->default(1);
            $table->unsignedBigInteger('dept_id')->nullable();
            $table->unsignedBigInteger('previous_id')->nullable();

            $table->unique(['student_id', 'program_id']);

            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('previous_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('doc_file');
            $table->dropColumn('avatar');
            $table->dropColumn('mobile');
            $table->dropColumn('status');
            $table->dropColumn('student_id');
            $table->dropColumn('program');
            $table->dropColumn('session');
            $table->dropColumn('teacher_id');
            $table->dropColumn('staff_id');
            $table->dropColumn('role_id');
            $table->dropColumn('dept_id');
            $table->dropColumn('semester_id');
            $table->dropColumn('previous_id');
            $table->dropColumn('father_name');
            $table->dropColumn('mother_name');
            $table->dropColumn('nationality');
            $table->dropColumn('religion');
            $table->dropColumn('dob');
            $table->dropColumn('emergency_mobile');
        });
    }
};
