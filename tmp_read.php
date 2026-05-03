<?php
$lines = file('resources/views/siswa/ppdb/create.blade.php');
for ($i = 50; $i < 60; $i++) {
    echo ($i+1) . ': ' . rtrim($lines[$i]) . PHP_EOL;
}

