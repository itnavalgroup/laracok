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
        Schema::create('tbl_loans', function (Blueprint $table) {
            $table->bigInteger('id_loan')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_user')->unsigned()->index();
            $table->string('loan', '255')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_loans');
    }
};
