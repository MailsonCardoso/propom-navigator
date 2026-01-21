<?php
$files = [
    'beck/database/seeders/Module10Seeder.php',
    'beck/database/seeders/Module08Seeder.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        // Remove 'topic' key and value, handles spaces and both line endings
        $content = preg_replace("/\s+'topic' => '.*',\r?\n/", "\n", $content);
        file_put_contents($file, $content);
        echo "Cleaned $file\n";
    }
}
