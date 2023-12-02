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
            $table->string('address');
            $table->string('doc_file')->nullable();
            $table->string('avatar')->nullable();
            $table->string('mobile')->unique();
            $table->int('status')->default(0);
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
        });
    }
};
