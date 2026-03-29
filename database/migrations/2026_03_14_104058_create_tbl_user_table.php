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
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->bigInteger('id_user')->primary()->unsigned()->autoIncrement();
            $table->string('id_employee', '32')->index();
            $table->bigInteger('id_company')->unsigned()->index();
            $table->bigInteger('id_branch')->nullable()->unsigned()->index();
            $table->bigInteger('id_departement')->unsigned()->index();
            $table->bigInteger('id_position')->unsigned()->index();
            $table->bigInteger('id_warehouse')->nullable()->unsigned()->index();
            $table->bigInteger('supervisor')->nullable()->unsigned()->index();
            $table->string('name', '255');
            $table->string('nik', '255')->nullable();
            $table->string('npwp', '255')->nullable();
            $table->integer('level');
            $table->string('password', '255');
            $table->string('photo', '255')->nullable();
            $table->string('phone', '20')->nullable();
            $table->integer('is_active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user');
    }
};
