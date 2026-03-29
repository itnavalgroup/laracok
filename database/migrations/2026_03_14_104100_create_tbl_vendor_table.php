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
        Schema::create('tbl_vendor', function (Blueprint $table) {
            $table->bigInteger('id_vendor')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_departement')->nullable()->unsigned()->index();
            $table->bigInteger('id_user')->unsigned()->index();
            $table->string('vendor', '255');
            $table->string('npwp', '255')->nullable();
            $table->string('nik', '255')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('file_name', '255')->nullable();
            $table->text('address')->nullable();
            $table->string('phone', '255')->nullable();
            $table->string('email', '255')->nullable();
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_vendor');
    }
};
