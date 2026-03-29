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
        Schema::create('tbl_sign_transaction', function (Blueprint $table) {
            $table->bigInteger('id_sign_transaction')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_pr')->nullable()->unsigned()->index();
            $table->bigInteger('id_ikb')->nullable()->unsigned()->index();
            $table->bigInteger('id_user')->unsigned()->index();
            $table->bigInteger('id_doc_type')->unsigned()->index();
            $table->integer('status')->nullable();
            $table->string('signature_file', '255')->nullable();
            $table->text('reject_reason')->nullable();
            $table->text('director_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sign_transaction');
    }
};
