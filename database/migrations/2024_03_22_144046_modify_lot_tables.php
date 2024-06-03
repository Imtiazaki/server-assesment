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
            $table->string('email')->unique()->after('nama');
        });
        Schema::table('in_tray', function (Blueprint $table) {
            // Change column type to text
            $table->string('email')->unique()->after('nama');
        });
        Schema::table('essay_assessment1', function (Blueprint $table) {
            // Change column type to text
            $table->string('email')->unique()->after('nama');
        });
        Schema::table('essay_assessment2', function (Blueprint $table) {
            // Change column type to text
            $table->string('email')->unique()->after('nama');
        });
        Schema::table('jawaban_problem_analysis', function (Blueprint $table) {
            // Change column type to text
            $table->string('email')->unique()->after('nama');
        });
        Schema::table('jawaban_in_tray', function (Blueprint $table) {
            // Change column type to text
            $table->string('email')->unique()->after('nama');
        });
        Schema::table('jawaban_essay_assesment1', function (Blueprint $table) {
            // Change column type to text
            $table->string('email')->unique()->after('nama');
        });
        Schema::table('jawaban_essay_assesment2', function (Blueprint $table) {
            // Change column type to text
            $table->string('email')->unique()->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
/*         Schema::table('problem_analysis', function (Blueprint $table) {
            // Revert the column type change
            $table->string('email')->change();

            $table->string('email')->unique()->after('nama');

        });
        Schema::table('in_tray', function (Blueprint $table) {
            // Revert the column type change
            $table->string('email')->change();
        });
        Schema::table('essay_assessment1', function (Blueprint $table) {
            // Revert the column type change
            $table->string('email')->change();
        });
        Schema::table('essay_assessment2', function (Blueprint $table) {
            // Revert the column type change
            $table->string('email')->change();
        });
        Schema::table('jawaban_problem_analysis', function (Blueprint $table) {
            // Revert the column type change
            $table->string('email')->change();
        });
        Schema::table('jawaban_in_tray', function (Blueprint $table) {
            // Revert the column type change
            $table->string('email')->change();
        });
        Schema::table('jawaban_essay_assessment1', function (Blueprint $table) {
            // Revert the column type change
            $table->string('email')->change();
        });
        Schema::table('jawaban_essay_assessment2', function (Blueprint $table) {
            // Revert the column type change
            $table->string('email')->change();
        }); */
    }
};
