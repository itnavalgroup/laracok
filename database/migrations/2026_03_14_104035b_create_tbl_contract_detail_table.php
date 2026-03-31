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
        Schema::create('tbl_contract_detail', function (Blueprint $table) {
            $table->bigInteger('id_contract_detail')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_contract')->unsigned()->index();
            $table->bigInteger('id_item_category')->unsigned()->index();
            $table->bigInteger('id_item')->unsigned()->index();
            $table->decimal('qty', 20, 4);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_contract_detail');
    }
};
