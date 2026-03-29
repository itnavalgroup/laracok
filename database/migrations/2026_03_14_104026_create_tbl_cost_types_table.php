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
        Schema::create('tbl_cost_types', function (Blueprint $table) {
            $table->bigInteger('id_cost_type')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_user')->unsigned()->index();
            $table->bigInteger('id_cost_category')->nullable()->unsigned()->index();
            $table->text('cost_type')->nullable();
            $table->text('cost_document')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cost_types');
    }
};
