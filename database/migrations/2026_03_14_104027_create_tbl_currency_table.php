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
        Schema::create('tbl_currency', function (Blueprint $table) {
            $table->bigInteger('id_currency')->primary()->unsigned()->autoIncrement();
            $table->string('country', '100');
            $table->string('code', '3');
            $table->string('symbol', '10');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_currency');
    }
};
