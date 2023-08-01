<?php

namespace App\Admin\Http\Controllers;

use App\Models\Attribute;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $query = Banner::query()
                ->orderBy('updated_at', 'desc');
            return DataTables::of($query)
                ->addColumn('redirection', function ($query) {
                    $value = $query->url ?? $query->product->product_name;
                    $url = $query->url ?? '#';
                    return "<a href='$url'>$value</a>";
                })
                ->addColumn('image', function ($query) {
                    if ($query->image_url) {
                        return "<img src='$query->image_url' style='width: 100px; height: 100px' />";
                    }
                    return null;
                })
                ->addColumn('action', 'admin::pages.banners.action')
                ->rawColumns(['redirection', 'image', 'action'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'image', 'name' => 'image', 'title' => 'Image'],
            ['data' => 'redirection', 'name' => 'redirection', 'title' => 'Redirection'],
        ])
            ->parameters([
                'searching' => false,
                'ordering' => false,
                'pageLength' => 15
            ])
            ->addAction(['title' => '', 'class' => 'text-right p-3', 'width' => 70]);


        return view('admin::pages.banners.index', compact('html'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::query()->where('is_available', 1)->where('is_display', 1)->get();
        return view('admin::pages.banners.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
        ]);

        $banner = new Banner();
        $banner->redirection_type = $request->get('redirection_type');
        $banner->url = $request->get('url');
        $banner->product_id = $request->get('product_id');
        $banner->save();

        if ($request->hasFile('image')) {
            $banner->addMedia($request->file('image'))->toMediaCollection('images');
        }

        return redirect()->route('admin.banners.index')->with('success', "Successfully Created");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return view('admin::pages.categories.show', compact('banner'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $products = Product::query()->where('is_available', 1)->where('is_display', 1)->get();
        return view('admin::pages.banners.edit', compact('banner', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $banner->redirection_type = $request->get('redirection_type');
        $banner->url = $request->get('url');
        $banner->product_id = $request->get('product_id');
        $banner->save();

        if ($request->hasFile('image')) {
            $banner->addMedia($request->file('image'))->toMediaCollection('images');
        }

        return redirect()->route('admin.banners.index')->with('success', "Successfully Updated");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return response()->json(['message' => "Category deleted"], Response::HTTP_OK);
    }
}
