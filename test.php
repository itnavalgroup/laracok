<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$admin = App\Models\User::where('level', 1)->first();
Illuminate\Support\Facades\Auth::loginUsingId($admin->id_user);

$index = app(App\Livewire\Permissions\Index::class);
$index->selectedUserId = $admin->id_user; // Granting to self to test
$index->userPermissions = [];

try {
    $index->grantAll();
    echo "grantAll Success\n";
} catch (\Exception $e) {
    echo "grantAll Exception: " . $e->getMessage() . "\n";
}

try {
    $index->toggleModule('Production');
    echo "toggleModule Success\n";
} catch (\Exception $e) {
    echo "toggleModule Exception: " . $e->getMessage() . "\n";
}
