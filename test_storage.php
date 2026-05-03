<?php
// Test script to check storage paths
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Storage;

// Check storage disk
echo "Storage disk exists: " . (Storage::disk('public')->exists('/') ? 'yes' : 'no') . "\n";

// Check profiles directory
echo "Profiles dir exists: " . (Storage::disk('public')->exists('profiles') ? 'yes' : 'no') . "\n";

// List files in profiles
$files = Storage::disk('public')->files('profiles');
echo "Files in profiles: " . count($files) . "\n";
foreach($files as $f) {
    echo " - " . $f . "\n";
}

// List all in public
echo "\nAll public files:\n";
$all = Storage::disk('public')->allFiles('');
foreach($all as $f) {
    echo " - " . $f . "\n";
}
