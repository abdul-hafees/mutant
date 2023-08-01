<?php

namespace App\Admin\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class SubCategoryController extends Controller
{
    public function create(Category $category)
    {
        return view('admin::pages.categories.subcategories.create', compact('category'));
    }
    public function store(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
        ]);

        $subCategory = new Category();
        $subCategory->name = $request->input('name');
        $subCategory->parent_id = $category->id;
        $subCategory->save();

        return redirect()->route('admin.categories.show', $category->id)->with('success', "Successfully Created");
    }
}
