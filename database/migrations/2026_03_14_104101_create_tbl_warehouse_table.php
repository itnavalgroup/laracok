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
        Schema::create('tbl_warehouse', function (Blueprint $table) {
            $table->bigInteger('id_warehouse')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_user')->nullable()->unsigned()->index();
            $table->string('warehouse_name', '255');
            $table->string('address', '255')->nullable();
            $table->integer('is_active')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_warehouse');
    }
};
