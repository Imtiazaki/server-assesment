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
        Schema::table('answers', function (Blueprint $table) {
            // Change column type to text
            $table->string('mulai')->after('token')->change();
            $table->string('selesai')->before('jawaban')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answers', function (Blueprint $table) {
            // Revert the column type change
            $table->time('mulai')->change();
            $table->time('selesai')->change();


        });
    }
};
