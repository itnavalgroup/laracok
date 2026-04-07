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
        $permissions = [
            ['permission_name' => 'production.view.all', 'permission_description' => 'View all production'],
            ['permission_name' => 'production.view.dept', 'permission_description' => 'View department production'],
            ['permission_name' => 'production.view.warehouse', 'permission_description' => 'View warehouse production'],
            ['permission_name' => 'production.create', 'permission_description' => 'Create production'],
            ['permission_name' => 'production.edit', 'permission_description' => 'Edit production'],
            ['permission_name' => 'production.delete', 'permission_description' => 'Delete production'],
        ];

        foreach ($permissions as $p) {
            \Illuminate\Support\Facades\DB::table('tbl_permissions')->insert(array_merge($p, ['module' => 'production', 'created_at' => now(), 'updated_at' => now()]));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Illuminate\Support\Facades\DB::table('tbl_permissions')->where('module', 'production')->delete();
    }
};
