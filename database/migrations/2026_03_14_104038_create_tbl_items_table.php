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
        Schema::create('tbl_items', function (Blueprint $table) {
            $table->bigInteger('id_item')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_item_category')->nullable()->unsigned()->index();
            $table->string('item_name', '255');
            $table->string('item_code', '255')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('tbl_items');
    }
};
