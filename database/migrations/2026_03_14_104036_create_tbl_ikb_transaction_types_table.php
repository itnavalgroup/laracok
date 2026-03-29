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
        Schema::create('tbl_ikb_transaction_types', function (Blueprint $table) {
            $table->bigInteger('id_ikb_transaction_type')->primary()->unsigned()->autoIncrement();
            $table->string('transaction_type', '255');
            $table->integer('is_active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ikb_transaction_types');
    }
};
