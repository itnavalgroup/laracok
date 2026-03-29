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
        Schema::create('tbl_attachment', function (Blueprint $table) {
            $table->bigInteger('id_attachment')->primary()->unsigned()->autoIncrement();
            $table->unsignedBigInteger('id_departement')->index();
            $table->unsignedBigInteger('id_user')->index();
            $table->string('attachment', '255');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_attachment');
    }
};
