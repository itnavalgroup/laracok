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
        Schema::create('tbl_production_materials', function (Blueprint $table) {
            $table->bigIncrements('id_production_material');
            $table->unsignedBigInteger('id_production');
            $table->unsignedBigInteger('id_item')->nullable();
            $table->unsignedBigInteger('id_item_category')->nullable();
            $table->unsignedBigInteger('id_uom')->nullable();
            $table->unsignedBigInteger('id_packaging')->nullable();
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
        Schema::dropIfExists('tbl_production_materials');
    }
};
