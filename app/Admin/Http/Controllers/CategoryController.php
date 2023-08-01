<?php

namespace App\Admin\Http\Controllers;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $query = Category::query()->whereNull('parent_id')
                ->orderBy('updated_at', 'desc');
            return DataTables::of($query)
                ->filter(function ($query) {
                    if (request()->filled('filter.search')) {
                        $query->where(function ($query) {
                            $query->where('name', 'like', "%" . request('filter.search') . "%");
                        });
                    }
                })
                ->addColumn('image', function ($query) {
                    if ($query->image_url) {
                        return "<img src='$query->image_url' style='width: 100px; height: 100px' />";
                    }
                    return null;
                })
                ->addColumn('action', 'admin::pages.categories.action')
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'image', 'name' => 'image', 'title' => 'Image'],
        ])
            ->parameters([
                'searching' => false,
                'ordering' => false,
                'pageLength' => 15
            ])
            ->addAction(['title' => '', 'class' => 'text-right p-3', 'width' => 70]);


        return view('admin::pages.categories.index', compact('html'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::pages.categories.create');
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
            'name' => 'required|max:191',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        if ($request->hasFile('image')) {
            $category->addMedia($request->file('image'))->toMediaCollection('images');
        }

        return redirect()->route('admin.categories.index')->with('success', "Successfully Created");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, Builder $builder)
    {
        if (request()->ajax()) {
            $query = $category->sub_categories()
                ->orderBy('updated_at', 'desc');
            return DataTables::of($query)
                ->filter(function ($query) {
                    if (request()->filled('filter.search')) {
                        $query->where(function ($query) {
                            $query->where('name', 'like', "%" . request('filter.search') . "%");
                        });
                    }
                })
                ->addColumn('image', function ($query) {
                    if ($query->image_url) {
                        return "<img src='$query->image_url' style='width: 100px; height: 100px' />";
                    }
                    return null;
                })
                ->addColumn('action', 'admin::pages.categories.action')
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'image', 'name' => 'image', 'title' => 'Image'],
        ])
            ->parameters([
                'searching' => false,
                'ordering' => false,
                'pageLength' => 15
            ])
            ->addAction(['title' => '', 'class' => 'text-right p-3', 'width' => 70]);


        return view('admin::pages.categories.show', compact('html', 'category'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin::pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
        ]);

        $category->name = $request->input('name');
        $category->save();

        if ($request->hasFile('image')) {
            info("IMAGE");
            $category->addMedia($request->file('image'))->toMediaCollection('images');
        }

        if ($category->parent_id) {
            return redirect()->route('admin.categories.show', $category->parent_id)->with('success', "Successfully Updated");
        }

        return redirect()->route('admin.categories.index')->with('success', "Successfully Updated");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => "Category deleted"], Response::HTTP_OK);
    }

    public function getSubCategoriesByParent($categoryId)
    {
        $subCategories = Category::query()
            ->whereParentId($categoryId)
            ->get();

        return response()->json($subCategories);
    }

    public function getAttributeByCategory($categoryId)
    {
        $attributes = Attribute::query()
            ->whereHas('category', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            })
            ->get();

        if (count($attributes) <= 0) {
            $parentCategory = Category::find($categoryId);

            if ($parentCategory && $parentCategory->parent_id) {
                $attributes = $this->getAttributeByCategory($parentCategory->parent_id);
            }
        }

       return $attributes;
    }


}
