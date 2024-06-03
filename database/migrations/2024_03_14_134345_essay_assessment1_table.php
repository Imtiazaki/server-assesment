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
        Schema::create('essay_assessment1', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('nama');
            $table->date('tanggal_test');
            $table->dateTime('mulai');
            $table->dateTime('selesai');
            $table->timestamps();
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
