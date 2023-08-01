<?php

namespace App\Admin\Http\Controllers;

use App\Models\Hub;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class HubsController extends Controller
{
    public function index(Builder $builder)
    {
        if(request()->ajax()) {
            $query = Hub::query()
                ->orderBy('updated_at','desc');
            return DataTables::of($query)
                ->filter(function ($query) {
                    if (request()->filled('filter.search')) {
                        $query->where(function ($query) {
                            $query->where('name', 'like', "%" . request('filter.search') . "%");
                        });
                    }
                })
                ->editColumn('is_active', function ($query) {
                    if($query->is_active) {
                        return 'Active';
                    }
                    return 'Inactive';
                })
                ->addColumn('action', 'admin::pages.hubs.action')
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'pincode', 'name' => 'pincode', 'title' => 'Pincode'],
            ['data' => 'address', 'name' => 'address', 'title' => 'Address'],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'is_active', 'name' => 'is_active', 'title' => 'Status'],
        ])
            ->parameters([
                'searching' => false,
                'ordering' => false,
                'pageLength' => 15
            ])
            ->addAction(['title' => '', 'class' => 'text-right p-3', 'width' => 70]);


        return view('admin::pages.hubs.index', compact('html'));
    }

    public function create()
    {
        return view('admin::pages.hubs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'address' => 'required',
            'pincode' => 'required',
//            'latitude' => 'required',
//            'longitude' => 'required',
            'phone' => 'required',
        ]);

        $hub = new Hub();
        $hub->name = $request->name;
        $hub->address = $request->address;
        $hub->pincode = $request->pincode;
        $hub->latitude = $request->latitude;
        $hub->longitude = $request->longitude;
        $hub->phone = $request->phone;
        $hub->description = $request->description;
        $hub->is_active = true;
        $hub->save();

        return redirect()->route('admin.hubs.index')->with('success', "Successfully Created");
    }


    public function edit($id)
    {
        $hub = Hub::findOrFail($id);

        return view('admin::pages.hubs.edit',
            compact('hub'));
    }

    public function update(Request $request, Hub $hub)
    {
        $request->validate([
            'name' => 'required|max:191',
            'address' => 'required',
            'pincode' => 'required',
//            'latitude' => 'required',
//            'longitude' => 'required',
            'phone' => 'required',
        ]);

        $hub->name = $request->name;
        $hub->address = $request->address;
        $hub->pincode = $request->pincode;
        $hub->latitude = $request->latitude;
        $hub->longitude = $request->longitude;
        $hub->phone = $request->phone;
        $hub->description = $request->description;
        $hub->is_active = $request->is_active;
        $hub->save();

        return redirect()->route('admin.hubs.index')->with('success', "Successfully Updated");
    }

    public function destroy(Hub $hub)
    {
        $hub->delete();
        return response()->json(['message' => "Hub deleted"], Response::HTTP_OK);
    }
}
