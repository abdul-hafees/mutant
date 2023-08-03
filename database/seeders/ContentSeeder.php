<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('contents')->truncate();

        Content::create([
           "key" => "wallpaper_1",
            "value" => null,
            "type" => Content::IMAGE
        ]);

        Content::create([
           "key" => "wallpaper_1_title",
            "value" => "Welcome! We Are Waldo",
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "wallpaper_1_description",
            "value" => "We are a creative design company that creates a really cool projects. :)",
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "wallpaper_2",
            "value" => null,
            "type" => Content::IMAGE
        ]);

        Content::create([
           "key" => "wallpaper_2_title",
            "value" => null,
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "wallpaper_2_description",
            "value" => null,
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "wallpaper_3",
            "value" => null,
            "type" => Content::IMAGE
        ]);

        Content::create([
           "key" => "wallpaper_3_title",
            "value" => null,
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "wallpaper_3_description",
            "value" => null,
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "gallery_1",
            "value" => null,
            "type" => Content::IMAGE
        ]);

        Content::create([
           "key" => "gallery_1_title",
            "value" => null,
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "gallery_2",
            "value" => null,
            "type" => Content::IMAGE
        ]);

        Content::create([
           "key" => "gallery_2_title",
            "value" => null,
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "gallery_3",
            "value" => null,
            "type" => Content::IMAGE
        ]);

        Content::create([
           "key" => "gallery_3_title",
            "value" => null,
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "gallery_4",
            "value" => null,
            "type" => Content::IMAGE
        ]);

        Content::create([
           "key" => "gallery_5",
            "value" => null,
            "type" => Content::IMAGE
        ]);

        Content::create([
           "key" => "gallery_5_title",
            "value" => null,
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "gallery_6",
            "value" => null,
            "type" => Content::IMAGE
        ]);

        Content::create([
           "key" => "gallery_6_title",
            "value" => null,
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "gallery_7",
            "value" => null,
            "type" => Content::IMAGE
        ]);

        Content::create([
           "key" => "gallery_7_title",
            "value" => null,
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "gallery_8",
            "value" => null,
            "type" => Content::IMAGE
        ]);

        Content::create([
           "key" => "gallery_8_title",
            "value" => null,
            "type" => Content::TEXT
        ]);

        Content::create([
           "key" => "gallery_9",
            "value" => null,
            "type" => Content::IMAGE
        ]);

        Content::create([
           "key" => "gallery_9_title",
            "value" => null,
            "type" => Content::TEXT
        ]);
    }
}
