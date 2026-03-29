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
        Schema::create('tbl_invoice', function (Blueprint $table) {
            $table->bigInteger('id_invoice')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_user')->nullable()->unsigned()->index();
            $table->bigInteger('id_departement')->nullable()->unsigned()->index();
            $table->bigInteger('id_company')->nullable()->unsigned()->index();
            $table->bigInteger('id_vendor')->nullable()->unsigned()->index();
            $table->bigInteger('id_doc_type')->nullable()->unsigned()->index();
            $table->bigInteger('id_pr')->nullable()->unsigned()->index();
            $table->bigInteger('id_norek_vendor')->nullable()->unsigned()->index();
            $table->string('nama_bank', '255')->nullable();
            $table->string('nama_penerima', '255')->nullable();
            $table->string('norek', '255')->nullable();
            $table->string('truck', '255')->nullable();
            $table->dateTime('invoice_date');
            $table->string('invoice_number', '255');
            $table->dateTime('delivery_date')->nullable();
            $table->string('file_name', '255')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_invoice');
    }
};
