<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$adminCpf = '01935806327';
$newPassword = '@Secur1t1@';

$admin = User::where('cpf', $adminCpf)
    ->where('role', 'admin')
    ->first();

if ($admin) {
    $admin->update([
        'password' => Hash::make($newPassword),
    ]);
    echo "Admin password updated successfully for CPF: $adminCpf\n";
} else {
    echo "Admin with CPF $adminCpf not found.\n";
}
