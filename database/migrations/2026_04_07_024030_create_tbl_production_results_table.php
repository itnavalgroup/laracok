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
        Schema::create('tbl_production_results', function (Blueprint $table) {
            $table->increments('id_production_result');
            $table->unsignedInteger('id_production');
            $table->unsignedInteger('id_item')->nullable();
            $table->unsignedInteger('id_item_category')->nullable();
            $table->unsignedInteger('id_uom')->nullable();
            $table->unsignedInteger('id_packaging')->nullable();
            $table->decimal('qty', 15, 4)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_production_results');
    }
};
