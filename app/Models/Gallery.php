<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'kategori',
    ];

    public function scopeTerbaru($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}

