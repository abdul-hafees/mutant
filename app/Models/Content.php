<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Content extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    const TEXT = "TEXT";
    const IMAGE = "IMAGE";

    public function getImageUrlAttribute()
    {
        $lastImage = $this->getMedia('images')->last();

        if ($lastImage) {
            return $lastImage->getUrl();
        }

        return asset('sample/sample.jpeg');
    }
}
