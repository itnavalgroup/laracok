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
        Schema::create('tbl_tax_types', function (Blueprint $table) {
            $table->bigInteger('id_tax_type')->primary()->unsigned()->autoIncrement();
            $table->string('tax_type', '100');
            $table->text('tax_type_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tax_types');
    }
};
