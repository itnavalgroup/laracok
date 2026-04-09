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
        Schema::create('tbl_production_notes', function (Blueprint $table) {
            $table->bigIncrements('id_production_note');
            $table->unsignedBigInteger('id_production');
            $table->unsignedBigInteger('id_user');
            $table->integer('note_type')->comment('1: Process (Step 2), 2: Verify (Step 3), dll');
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_production_notes');
    }
};
