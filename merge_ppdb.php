<?php
// Gabungkan file PPDB
$out = file_get_contents('tmp_ppdb_1.blade') . "\n\n" . file_get_contents('tmp_ppdb_2.js') . "\n\n@endpush\n";
file_put_contents('resources/views/siswa/ppdb/create.blade.php', $out);
echo "Merge selesai! File: " . strlen($out) . " karakter\n";

