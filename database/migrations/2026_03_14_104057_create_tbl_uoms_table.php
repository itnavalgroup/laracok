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
        Schema::create('tbl_uoms', function (Blueprint $table) {
            $table->bigInteger('id_uom')->primary()->unsigned()->autoIncrement();
            $table->string('uom', '255');
            $table->decimal('qty_kg', 20, 4)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_uoms');
    }
};
