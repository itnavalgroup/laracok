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
        Schema::create('tbl_item_transactions', function (Blueprint $table) {
            $table->bigInteger('id_item_transaction')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_item')->unsigned()->index();
            $table->bigInteger('id_item_category')->unsigned()->index();
            $table->bigInteger('id_warehouse')->unsigned()->index();
            $table->bigInteger('id_company')->unsigned()->index();
            $table->bigInteger('id_user')->unsigned()->index();
            $table->bigInteger('id_departement')->unsigned()->index();
            $table->bigInteger('id_uom')->unsigned()->index();
            $table->bigInteger('id_packaging')->unsigned()->index();
            $table->bigInteger('id_sr')->nullable()->unsigned()->index();
            $table->bigInteger('id_pr')->nullable()->unsigned()->index();
            $table->bigInteger('id_doc_type')->nullable()->unsigned()->index();
            $table->bigInteger('id_vendor')->nullable()->unsigned()->index();
            $table->string('transaction_code', '255');
            $table->decimal('income', 20, 4);
            $table->decimal('outcome', 20, 4);
            $table->dateTime('transaction_date');
            $table->text('description')->nullable();
            $table->string('police_number', '255')->nullable();
            $table->string('driver_name', '255')->nullable();
            $table->string('so_number', '255')->nullable();
            $table->string('invoice_number', '255')->nullable();
            $table->string('po_number', '255')->nullable();
            $table->string('fob', '255')->nullable();
            $table->string('filename', '255')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_item_transactions');
    }
};
