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
        Schema::create('tbl_detail_sr', function (Blueprint $table) {
            $table->bigInteger('id_detail_sr')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_pr')->nullable()->unsigned()->index();
            $table->bigInteger('id_sr')->nullable()->unsigned()->index();
            $table->bigInteger('id_user')->nullable()->unsigned()->index();
            $table->bigInteger('id_departement')->nullable()->unsigned()->index();
            $table->bigInteger('id_doc_type')->nullable()->unsigned()->index();
            $table->bigInteger('id_uom')->nullable()->unsigned()->index();
            $table->bigInteger('id_tax_type1')->nullable()->unsigned()->index();
            $table->bigInteger('id_tax1')->nullable()->unsigned()->index();
            $table->bigInteger('id_tax_type2')->nullable()->unsigned()->index();
            $table->bigInteger('id_tax2')->nullable()->unsigned()->index();
            $table->bigInteger('id_item_category')->nullable()->unsigned()->index();
            $table->bigInteger('id_item')->nullable()->unsigned()->index();
            $table->bigInteger('id_warehouse')->nullable()->unsigned()->index();
            $table->text('detail');
            $table->text('bl_number')->nullable();
            $table->decimal('dpp_pph', 20, 4)->nullable();
            $table->decimal('qty', 20, 4);
            $table->decimal('price', 20, 4);
            $table->decimal('discount', 20, 4)->nullable();
            $table->decimal('tax1', 20, 4)->nullable();
            $table->decimal('tax2', 20, 4)->nullable();
            $table->integer('progresif')->nullable()->index();
            $table->integer('gross')->nullable()->index();
            $table->integer('is_purchase_items')->nullable()->index();
            $table->decimal('ammount', 20, 4)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_detail_sr');
    }
};
