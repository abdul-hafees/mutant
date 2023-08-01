<?php

namespace App\Admin\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if(request()->ajax()) {
            $query = Attribute::query()
                ->orderBy('updated_at','desc');
            return DataTables::of($query)
                ->filter(function ($query) {
                    if (request()->filled('filter.search')) {
                        $query->where(function ($query) {
                            $query->where('name', 'like', "%" . request('filter.search') . "%");
                        });
                    }
                })
                ->addColumn('category', function ($query) {
                    return optional($query->category)->name;
                })
                ->addColumn('action', 'admin::pages.attributes.action')
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'category', 'name' => 'category', 'title' => 'Category'],
        ])
            ->parameters([
                'searching' => false,
                'ordering' => false,
                'pageLength' => 15
            ])
            ->addAction(['title' => '', 'class' => 'text-right p-3', 'width' => 70]);


        return view('admin::pages.attributes.index', compact('html'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::query()->whereNull('parent_id')->get();

        return view('admin::pages.attributes.create', compact('categories'));
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
            'category_id' => 'required|exists:categories,id,deleted_at,NULL',
        ]);

        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->category_id = $request->category_id;
        $attribute->save();

        return redirect()->route('admin.attributes.index')->with('success', "Successfully Created");
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
    public function edit(Attribute $attribute)
    {
        $categories = Category::query()->whereNull('parent_id')->get();

        return view('admin::pages.attributes.edit', compact('attribute', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'category_id' => 'required|exists:categories,id,deleted_at,NULL',
        ]);

        $attribute->name = $request->input('name');
        $attribute->category_id = $request->input('category_id');
        $attribute->save();

        return redirect()->route('admin.attributes.index')->with('success', "Successfully Updated");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return response()->json(['message' => "Attribute deleted"], Response::HTTP_OK);
    }

    public function getAllAttributeValues(Request $request)
    {
        $attributeIds = $request->attributeIds;
        $data = [];

        if (!empty($attributeIds)) {
            $attributeValues = AttributeValue::with('attribute')
                ->whereIn('attribute_id', $attributeIds)
                ->get();

            foreach ($attributeIds as $index => $attributeId) {
                $group = [
                    'id' => $attributeId,
                    'name' => '',
                    'values' => []
                ];

                foreach ($attributeValues as $attributeValue) {
                    if ($attributeValue->attribute_id == $attributeId) {
                        $group['name'] = $attributeValue->attribute->name;
                        $group['values'][] = [
                            'id' => $attributeValue->id,
                            'name' => $attributeValue->name
                        ];
                    }
                }

                $data[$index] = $group;
            }
        }

        return view('admin::pages.products.variants',
            compact('data'))->render();
    }
}
