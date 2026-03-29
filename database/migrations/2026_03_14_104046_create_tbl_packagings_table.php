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
        Schema::create('tbl_packagings', function (Blueprint $table) {
            $table->bigInteger('id_packaging')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_user')->unsigned()->index();
            $table->bigInteger('id_departement')->nullable()->unsigned()->index();
            $table->string('packaging', '255')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_packagings');
    }
};
