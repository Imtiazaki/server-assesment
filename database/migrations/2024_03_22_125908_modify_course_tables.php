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
        Schema::table('problem_analysis', function (Blueprint $table) {
            // Change column type to text
            $table->integer('mulai')->change();
            $table->integer('selesai')->change();
        });
        Schema::table('in_tray', function (Blueprint $table) {
            // Change column type to text
            $table->integer('mulai')->change();
            $table->integer('selesai')->change();
        });
        Schema::table('essay_assessment1', function (Blueprint $table) {
            // Change column type to text
            $table->integer('mulai')->change();
            $table->integer('selesai')->change();
        });
        Schema::table('essay_assessment2', function (Blueprint $table) {
            // Change column type to text
            $table->integer('mulai')->change();
            $table->integer('selesai')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('problem_analysis', function (Blueprint $table) {
            // Revert the column type change
            $table->dateTime('mulai')->change();
            $table->dateTime('selesai')->change();
        });
        Schema::table('in_tray', function (Blueprint $table) {
            // Revert the column type change
            $table->dateTime('mulai')->change();
            $table->dateTime('selesai')->change();
        });
        Schema::table('essay_assessment1', function (Blueprint $table) {
            // Revert the column type change
            $table->dateTime('mulai')->change();
            $table->dateTime('selesai')->change();
        });
        Schema::table('essay_assessment2', function (Blueprint $table) {
            // Revert the column type change
            $table->dateTime('mulai')->change();
            $table->dateTime('selesai')->change();
        });
    }
};
