<?php

namespace App\Admin\Http\Controllers;


use App\Models\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin::pages.dashboard');
    }

    public function home(Request $request)
    {
        $contents = Content::all();
        return view('admin::pages.home', compact('contents'));

    }
    public function homeStore(Request $request)
    {
        if ($request->hasFile('wallpaper_1')) {
            $content = Content::where('key', 'wallpaper_1')->first();
            $content->addMedia($request->file('wallpaper_1'))->toMediaCollection('images');
        }
        if ($request->hasFile('wallpaper_2')) {
            $content = Content::where('key', 'wallpaper_2')->first();
            $content->addMedia($request->file('wallpaper_2'))->toMediaCollection('images');
        }
        if ($request->hasFile('wallpaper_3')) {
            $content = Content::where('key', 'wallpaper_3')->first();
            $content->addMedia($request->file('wallpaper_3'))->toMediaCollection('images');
        }
        if ($request->get('wallpaper_1_title')) {
            $content = Content::where('key', 'wallpaper_1_title')->first();
            $content->value = $request->get('wallpaper_1_title');
            $content->save();
        }
        if ($request->get('wallpaper_2_title')) {
            $content = Content::where('key', 'wallpaper_2_title')->first();
            $content->value = $request->get('wallpaper_2_title');
            $content->save();
        }
        if ($request->get('wallpaper_3_title')) {
            $content = Content::where('key', 'wallpaper_3_title')->first();
            $content->value = $request->get('wallpaper_3_title');
            $content->save();
        }
        if ($request->get('wallpaper_1_description')) {
            $content = Content::where('key', 'wallpaper_1_description')->first();
            $content->value = $request->get('wallpaper_1_description');
            $content->save();
        }
        if ($request->get('wallpaper_2_description')) {
            $content = Content::where('key', 'wallpaper_2_description')->first();
            $content->value = $request->get('wallpaper_2_description');
            $content->save();
        }
        if ($request->get('wallpaper_3_description')) {
            $content = Content::where('key', 'wallpaper_3_description')->first();
            $content->value = $request->get('wallpaper_3_description');
            $content->save();
        }


        if ($request->hasFile('gallery_1')) {
            $content = Content::where('key', 'gallery_1')->first();
            $content->addMedia($request->file('gallery_1'))->toMediaCollection('images');
        }
        if ($request->get('gallery_1_title')) {
            $content = Content::where('key', 'gallery_1_title')->first();
            $content->value = $request->get('gallery_1_title');
            $content->save();
        }


        if ($request->hasFile('gallery_2')) {
            $content = Content::where('key', 'gallery_2')->first();
            $content->addMedia($request->file('gallery_2'))->toMediaCollection('images');
        }
        if ($request->get('gallery_2_title')) {
            $content = Content::where('key', 'gallery_2_title')->first();
            $content->value = $request->get('gallery_2_title');
            $content->save();
        }

        if ($request->hasFile('gallery_3')) {
            $content = Content::where('key', 'gallery_3')->first();
            $content->addMedia($request->file('gallery_3'))->toMediaCollection('images');
        }
        if ($request->get('gallery_3_title')) {
            $content = Content::where('key', 'gallery_3_title')->first();
            $content->value = $request->get('gallery_3_title');
            $content->save();
        }


        if ($request->hasFile('gallery_4')) {
            $content = Content::where('key', 'gallery_4')->first();
            $content->addMedia($request->file('gallery_4'))->toMediaCollection('images');
        }
        if ($request->get('gallery_4_title')) {
            $content = Content::where('key', 'gallery_4_title')->first();
            $content->value = $request->get('gallery_4_title');
            $content->save();
        }


        if ($request->hasFile('gallery_5')) {
            $content = Content::where('key', 'gallery_5')->first();
            $content->addMedia($request->file('gallery_5'))->toMediaCollection('images');
        }
        if ($request->get('gallery_5_title')) {
            $content = Content::where('key', 'gallery_5_title')->first();
            $content->value = $request->get('gallery_5_title');
            $content->save();
        }


        if ($request->hasFile('gallery_6')) {
            $content = Content::where('key', 'gallery_6')->first();
            $content->addMedia($request->file('gallery_6'))->toMediaCollection('images');
        }
        if ($request->get('gallery_6_title')) {
            $content = Content::where('key', 'gallery_6_title')->first();
            $content->value = $request->get('gallery_6_title');
            $content->save();
        }


        if ($request->hasFile('gallery_7')) {
            $content = Content::where('key', 'gallery_7')->first();
            $content->addMedia($request->file('gallery_7'))->toMediaCollection('images');
        }
        if ($request->get('gallery_7_title')) {
            $content = Content::where('key', 'gallery_7_title')->first();
            $content->value = $request->get('gallery_7_title');
            $content->save();
        }

        if ($request->hasFile('gallery_8')) {
            $content = Content::where('key', 'gallery_8')->first();
            $content->addMedia($request->file('gallery_8'))->toMediaCollection('images');
        }
        if ($request->get('gallery_8_title')) {
            $content = Content::where('key', 'gallery_8_title')->first();
            $content->value = $request->get('gallery_8_title');
            $content->save();
        }

        if ($request->hasFile('gallery_9')) {
            $content = Content::where('key', 'gallery_9')->first();
            $content->addMedia($request->file('gallery_9'))->toMediaCollection('images');
        }
        if ($request->get('gallery_9_title')) {
            $content = Content::where('key', 'gallery_9_title')->first();
            $content->value = $request->get('gallery_9_title');
            $content->save();
        }

        return redirect()->route('admin.home');

    }
}
