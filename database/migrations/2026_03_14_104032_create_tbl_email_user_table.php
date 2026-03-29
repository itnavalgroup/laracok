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
        Schema::create('tbl_email_user', function (Blueprint $table) {
            $table->bigInteger('id_email_user')->primary()->unsigned()->autoIncrement();
            $table->string('email', '255')->nullable();
            $table->bigInteger('id_user')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_email_user');
    }
};
