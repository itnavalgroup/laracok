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
        Schema::create('tbl_attachment_ikb', function (Blueprint $table) {
            $table->bigInteger('id_attachment_ikb')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_ikb')->unsigned()->index();
            $table->bigInteger('id_attachment')->unsigned()->index();
            $table->bigInteger('id_user')->unsigned()->index();
            $table->text('note')->nullable();
            $table->string('filename', '255');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_attachment_ikb');
    }
};
