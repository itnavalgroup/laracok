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
        Schema::create('tbl_production_attachments', function (Blueprint $table) {
            $table->bigIncrements('id_production_attachment');
            $table->unsignedBigInteger('id_production');
            $table->unsignedBigInteger('id_attachment')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('filename')->nullable();
            $table->integer('upload_status')->default(0);
            $table->string('file_path')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_production_attachments');
    }
};
