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
        Schema::create('tbl_sr', function (Blueprint $table) {
            $table->bigInteger('id_sr')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_pr')->unsigned()->index();
            $table->bigInteger('id_doc_type')->nullable()->unsigned()->index();
            $table->bigInteger('id_cost_type')->nullable()->unsigned()->index();
            $table->bigInteger('id_cost_category')->nullable()->unsigned()->index();
            $table->bigInteger('id_branch')->nullable()->unsigned()->index();
            $table->bigInteger('id_loan')->nullable()->unsigned()->index();
            $table->bigInteger('id_user')->nullable()->unsigned()->index();
            $table->bigInteger('id_departement')->nullable()->unsigned()->index();
            $table->bigInteger('id_company')->nullable()->unsigned()->index();
            $table->bigInteger('id_vendor')->nullable()->unsigned()->index();
            $table->bigInteger('id_email_vendor')->nullable()->unsigned()->index();
            $table->bigInteger('id_norek_vendor')->nullable()->unsigned()->index();
            $table->bigInteger('id_email_user')->nullable()->unsigned()->index();
            $table->bigInteger('id_warehouse')->nullable()->unsigned()->index();
            $table->text('subject')->nullable();
            $table->string('no_invoice', '255')->nullable();
            $table->decimal('additional_discount', 20, 4)->nullable();
            $table->integer('payment_method');
            $table->string('nama_bank', '255')->nullable();
            $table->string('nama_penerima', '255')->nullable();
            $table->string('norek', '255')->nullable();
            $table->string('qr', '255')->nullable();
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
        Schema::dropIfExists('tbl_sr');
    }
};
