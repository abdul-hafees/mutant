<?php
namespace App\Helpers;

use App\Models\Content;

class Helper
{
    public static function getValue($key)
    {
        $content = Content::query()->where('key', $key)->first();
        if(! $content) {
            return null;
        }

        if ($content->type == Content::IMAGE) {
            return $content->image_url;
        }

        return $content->value;
    }
}


