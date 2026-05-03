<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            '1.jpg' => 'Foto kegiatan sekolah 1',
            '2 (2).jpg' => 'Foto kegiatan sekolah 2',
            '3.jpg' => 'Foto kegiatan sekolah 3',
            '3pirime.jpg' => 'SMPN Pirime',
            '4.jpg' => 'Foto kegiatan sekolah 4',
            '4pirime.jpg' => 'Foto kegiatan sekolah Pirime 4',
            '5.jpg' => 'Foto kegiatan sekolah 5',
            '6.jpg' => 'Foto kegiatan sekolah 6',
            '7.jpg' => 'Foto kegiatan sekolah 7',
            '8pirimee.jpg' => 'Foto kegiatan sekolah Pirime 8',
            'bantuan seragam  pendiri sdn1 pirime 6 feb 2025 11-37-46.jpg' => 'Bantuan seragam pendiri SDN 1 Pirime',
            'gru.jpg' => 'Kegiatan GRU',
            'guru memberi pegumuman.jpg' => 'Guru memberikan pengumuman',
            'ijil masul2.jpg' => 'Ijil Masuk 2',
            'injil masuk.jpg' => 'Injil Masuk',
            'kegiatan sekolah bakar batu.jpg' => 'Kegiatan bakar batu',
            'kegiatang.jpg' => 'Kegiatan sekolah',
            'kep injil.jpg' => 'Kepala sekolah Injil',
            'lab3.jpg' => 'Laboratorium 3',
            'lapangan  sekolah baris.jpg' => 'Lapangan sekolah baris-berbaris',
            'leb1.jpg' => 'Kegiatan Lebaran 1',
            'leb2.jpg' => 'Kegiatan Lebaran 2',
            'n1.jpg' => 'Foto kegiatan N1',
            'ruang guru.jpg' => 'Ruang guru',
            'Ruang guru 2.jpg' => 'Ruang guru 2',
        ];

        foreach ($images as $filename => $title) {
            // Skip videos and if already exists
            if (pathinfo($filename, PATHINFO_EXTENSION) !== 'jpg' && pathinfo($filename, PATHINFO_EXTENSION) !== 'png' && pathinfo($filename, PATHINFO_EXTENSION) !== 'jpeg') {
                continue;
            }
            if (Storage::disk('public')->exists('gallery/' . $filename)) {
                echo "Skip: $filename (already exists)\n";
                continue;
            }

            $sourcePath = public_path("images/galeri/$filename");
            if (!file_exists($sourcePath)) {
                echo "Skip: $filename (source not found)\n";
                continue;
            }

            // Sanitize filename
            $sanitized = preg_replace('/[^A-Za-z0-9\-.]/', '_', $filename);
            $sanitized = time() . '_' . $sanitized;

            // Copy to storage
            $storagePath = storage_path("app/public/gallery/$sanitized");
            if (copy($sourcePath, $storagePath)) {
                // Create record
                Gallery::create([
                    'title' => $title,
                    'description' => 'Foto kegiatan SMPN 1 Pirime - ' . date('d M Y'),
                    'image' => $sanitized,
                ]);
                echo "Added: $filename -> $sanitized\n";
            } else {
                echo "Failed to copy: $filename\n";
            }
        }

        echo "Gallery import completed!";
    }
}
