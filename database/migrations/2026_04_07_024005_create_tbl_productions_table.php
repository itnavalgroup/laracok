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
        Schema::create('tbl_productions', function (Blueprint $table) {
            $table->bigIncrements('id_production');
            $table->string('production_number', 50)->unique();
            $table->unsignedBigInteger('id_user')->nullable(); // Requestor
            $table->unsignedBigInteger('id_warehouse')->nullable();
            $table->unsignedBigInteger('id_departement')->nullable();
            $table->unsignedBigInteger('id_company')->nullable();
            $table->unsignedBigInteger('id_requestor')->nullable();
            $table->dateTime('production_date')->nullable();
            $table->dateTime('finished_date')->nullable();
            $table->integer('status')->default(0)->comment('0: Draft, 1: Processed, 2: Finished, 3: Canceled');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->unsignedBigInteger('finished_by')->nullable();
            $table->unsignedBigInteger('canceled_by')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_productions');
    }
};
