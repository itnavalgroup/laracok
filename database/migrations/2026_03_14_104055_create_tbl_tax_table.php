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
        Schema::create('tbl_tax', function (Blueprint $table) {
            $table->bigInteger('id_tax')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_tax_type')->unsigned()->index();
            $table->string('tax', '100');
            $table->decimal('tax_persen', 9, 5)->nullable();
            $table->text('tax_description')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tax');
    }
};
