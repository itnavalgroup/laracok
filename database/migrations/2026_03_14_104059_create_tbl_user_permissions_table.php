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
        Schema::create('tbl_user_permissions', function (Blueprint $table) {
            $table->bigInteger('id_user_permission')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_permission')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user_permissions');
    }
};
