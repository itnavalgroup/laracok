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
        Schema::create('tbl_payment', function (Blueprint $table) {
            $table->bigInteger('id_payment')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_doc_type')->unsigned()->index();
            $table->bigInteger('id_pr')->nullable()->unsigned()->index();
            $table->bigInteger('id_cost_type')->unsigned()->index();
            $table->bigInteger('id_cost_category')->unsigned()->index();
            $table->bigInteger('id_user')->unsigned()->index();
            $table->bigInteger('id_departement')->unsigned()->index();
            $table->bigInteger('id_branch')->unsigned()->index();
            $table->bigInteger('id_company')->unsigned()->index();
            $table->bigInteger('id_vendor')->unsigned()->index();
            $table->bigInteger('id_norek_vendor')->nullable()->unsigned()->index();
            $table->text('payment_description')->nullable();
            $table->integer('payment_type');
            $table->integer('payment_method');
            $table->string('nama_bank', '255')->nullable();
            $table->string('nama_penerima', '255')->nullable();
            $table->string('norek', '255')->nullable();
            $table->decimal('ammount', 20, 4);
            $table->decimal('additional', 20, 4)->nullable();
            $table->decimal('grand_total', 20, 4);
            $table->integer('status');
            $table->string('filename', '255')->nullable();
            $table->text('reason')->nullable();
            $table->dateTime('payment_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_payment');
    }
};
