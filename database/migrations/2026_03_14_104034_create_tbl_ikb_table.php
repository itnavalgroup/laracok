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
        Schema::create('tbl_ikb', function (Blueprint $table) {
            $table->bigInteger('id_ikb')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_user')->unsigned()->index();
            $table->bigInteger('sales')->unsigned()->index();
            $table->bigInteger('id_warehouse')->unsigned()->index();
            $table->bigInteger('id_vendor')->unsigned()->index();
            $table->bigInteger('id_departement')->unsigned()->index();
            $table->bigInteger('id_company')->unsigned()->index();
            $table->bigInteger('id_doc_type')->unsigned()->index();
            $table->bigInteger('id_ikb_transaction_type')->nullable()->unsigned()->index();
            $table->integer('number');
            $table->string('ikb_number', '255');
            $table->string('po_number', '255')->nullable();
            $table->string('so_number', '255')->nullable();
            $table->string('ri_number', '255')->nullable();
            $table->string('sk_number', '255')->nullable();
            $table->string('do_number', '255')->nullable();
            $table->string('batch_number', '255')->nullable();
            $table->string('destination', '255')->nullable();
            $table->string('qr', '255')->nullable();
            $table->integer('status')->nullable();
            $table->dateTime('booking_date')->nullable();
            $table->dateTime('stuffing_date')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ikb');
    }
};
