<?php
$lines = file('resources/views/siswa/ppdb/create.blade.php');
for ($i = 290; $i < count($lines); $i++) {
    echo ($i+1) . ': ' . $lines[$i];
}

