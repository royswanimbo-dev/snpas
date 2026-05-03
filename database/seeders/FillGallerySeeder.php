<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FillGallerySeeder extends Seeder
{
    public function run()
    {
        $sourceDir = public_path('images/galeri');
        $targetDir = storage_path('app/public/gallery');
        
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $images = File::files($sourceDir);
        
        foreach ($images as $imageFile) {
            if (in_array(strtolower($imageFile->getExtension()), ['jpg', 'jpeg', 'png', 'gif'])) {
                $filename = $imageFile->getFilename();
                $targetPath = $targetDir . '/' . $filename;
                
                if (!File::exists($targetPath)) {
                    File::copy($imageFile->getRealPath(), $targetPath);
                }
                
                Gallery::updateOrCreate(
                    ['image' => 'gallery/' . $filename],
                    [
                        'title' => pathinfo($filename, PATHINFO_FILENAME),
                        'description' => 'Momen indah kegiatan sekolah SMPN 1 Pirime',
                        'created_at' => now()->subDays(rand(0, 365))
                    ]
                );
            }
        }
        
        echo "Gallery seeded with " . Gallery::count() . " images!\n";
    }
}

