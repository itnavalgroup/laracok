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
        Schema::create('tbl_permissions', function (Blueprint $table) {
            $table->bigInteger('id_permission')->primary()->unsigned()->autoIncrement();
            $table->string('permission_name', '255');
            $table->string('permission_description', '255');
            $table->string('module', '255');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_permissions');
    }
};
