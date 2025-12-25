<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$user = \App\Models\User::where('login', 'admin')->first();
if ($user) {
    $pass = 'admin@2026';
    $user->password = \Hash::make($pass);
    $user->role = 'admin';
    $user->save();
    echo "Admin reset done.\n";
    echo "Testing verification: " . (\Hash::check($pass, $user->password) ? "YES" : "NO") . "\n";
} else {
    echo "Admin not found.\n";
}
