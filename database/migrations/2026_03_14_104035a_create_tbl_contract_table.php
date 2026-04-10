<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_contract', function (Blueprint $table) {
            $table->bigInteger('id_contract')->primary()->unsigned()->autoIncrement();
            $table->bigInteger('id_user')->unsigned()->index();
            $table->bigInteger('id_company')->unsigned()->index();
            $table->bigInteger('id_departement')->unsigned()->index();
            $table->bigInteger('id_attachment')->unsigned()->index()->nullable();
            $table->string('contract_number', 100)->unique()->index();
            $table->text('description');
            $table->string('file_name', 255)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_contract');
    }
};
