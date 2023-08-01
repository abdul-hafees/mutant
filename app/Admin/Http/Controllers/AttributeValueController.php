<?php

namespace App\Admin\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if(request()->ajax()) {
            $query = AttributeValue::query()
                ->orderBy('updated_at','desc');
            return DataTables::of($query)
                ->filter(function ($query) {
                    if (request()->filled('filter.search')) {
                        $query->where(function ($query) {
                            $query->where('name', 'like', "%" . request('filter.search') . "%")
                                ->orWhereHas('attribute', function ($query) {
                                    $query->where('name', 'like', "%" . request('filter.search') . "%");
                                });
                        });
                    }
                })
                ->addColumn('attribute', function ($query) {
                    return optional($query->attribute)->name;
                })
                ->addColumn('action', 'admin::pages.attribute-values.action')
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'attribute', 'name' => 'attribute', 'title' => 'Attribute'],
        ])
            ->parameters([
                'searching' => false,
                'ordering' => false,
                'pageLength' => 15
            ])
            ->addAction(['title' => '', 'class' => 'text-right p-3', 'width' => 70]);


        return view('admin::pages.attribute-values.index', compact('html'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::query()->whereNull('parent_id')->get();

//        $attributes = Attribute::all();
        return view('admin::pages.attribute-values.create', compact( 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'attribute_id' => 'required|exists:attributes,id,deleted_at,NULL',
        ]);

        $attributeValue = new AttributeValue();
        $attributeValue->name = $request->input('name');
        $attributeValue->attribute_id = $request->input('attribute_id');
        $attributeValue->save();

        return redirect()->route('admin.attribute-values.index')->with('success', "Successfully Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        return view('admin::pages.categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeValue $attributeValue)
    {
        $categories = Category::query()->whereNull('parent_id')->get();

        $attributes = Attribute::query()->where('category_id', $attributeValue->attribute->category_id)->get();
        return view('admin::pages.attribute-values.edit', compact('attributeValue', 'attributes', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeValue $attributeValue)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'attribute_id' => 'required|exists:attributes,id,deleted_at,NULL',
        ]);

        $attributeValue->name = $request->input('name');
        $attributeValue->attribute_id = $request->input('attribute_id');
        $attributeValue->save();

        return redirect()->route('admin.attribute-values.index')->with('success', "Successfully Updated");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeValue $attributeValue)
    {
        $attributeValue->delete();

        return response()->json(['message' => "Subcategory deleted"], Response::HTTP_OK);
    }
}
