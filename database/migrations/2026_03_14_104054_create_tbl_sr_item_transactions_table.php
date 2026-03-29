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
        Schema::create('tbl_sr_item_transactions', function (Blueprint $table) {
            $table->bigInteger('id_sr_item_transaction')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_sr')->unsigned()->index();
            $table->bigInteger('id_item')->unsigned()->index();
            $table->bigInteger('id_warehouse')->unsigned()->index();
            $table->bigInteger('id_user')->unsigned()->index();
            $table->bigInteger('id_uom')->unsigned()->index();
            $table->bigInteger('id_packaging')->unsigned()->index();
            $table->bigInteger('id_company')->unsigned()->index();
            $table->bigInteger('id_departement')->unsigned()->index();
            $table->bigInteger('id_doc_type')->unsigned()->index();
            $table->decimal('qty', 20, 4);
            $table->text('note')->nullable();
            $table->dateTime('transaction_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sr_item_transactions');
    }
};
