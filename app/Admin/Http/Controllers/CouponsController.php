<?php

namespace App\Admin\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if(request()->ajax()) {
            $query = Coupon::query()
                ->with('product')
                ->orderBy('updated_at','desc');
            return DataTables::of($query)
                ->filter(function ($query) {
                    if (request()->filled('filter.search')) {
                        $query->where(function ($query) {
                            $query->where('code', 'like', "%" . request('filter.search') . "%");
                        });
                    }
                })
                ->editColumn('product_id', function ($query) {
                    if($query->product) {
                       return $query->product->base_name.' '.$query->product->variant_name;
                    }
                    return '-';
                })
                ->editColumn('is_active', function ($query) {
                    if($query->is_active) {
                        return 'Active';
                    }
                    return 'Inactive';
                })
                ->addColumn('action', 'admin::pages.coupons.action')
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'code', 'name' => 'code', 'title' => 'Code'],
            ['data' => 'type', 'name' => 'type', 'title' => 'Type'],
            ['data' => 'value', 'name' => 'value', 'title' => 'Value'],
            ['data' => 'product_id', 'name' => 'product_id', 'title' => 'Product'],
            ['data' => 'minimum_purchase_amount', 'name' => 'minimum_purchase_amount', 'title' => 'Minimum Purchase Amount'],
            ['data' => 'is_active', 'name' => 'is_active', 'title' => 'Status'],
        ])
            ->parameters([
                'searching' => false,
                'ordering' => false,
                'pageLength' => 15
            ])
            ->addAction(['title' => '', 'class' => 'text-right p-3', 'width' => 70]);


        return view('admin::pages.coupons.index', compact('html'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::whereIsDisplay(true)->cursor();

        return view('admin::pages.coupons.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'type' => 'required',
            'value' => 'required',
            'minimum_purchase_amount' => 'required',
        ]);

        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->code = 'ZDO'.Str::random('6').Coupon::count();
        $coupon->value = $request->value;
        $coupon->type = $request->type;
        $coupon->minimum_purchase_amount = $request->minimum_purchase_amount;
        $coupon->product_id = $request->product_id;
        $coupon->save();

        return redirect()->route('admin.coupons.index')->with('success', "Successfully Created");
    }


    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $products = Product::whereIsDisplay(true)->cursor();

        return view('admin::pages.coupons.edit',
            compact('coupon', 'products'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'name' => 'required|max:191',
            'type' => 'required',
            'value' => 'required',
            'minimum_purchase_amount' => 'required',
        ]);

        $coupon->name = $request->name;
        $coupon->value = $request->value;
        $coupon->type = $request->type;
        $coupon->minimum_purchase_amount = $request->minimum_purchase_amount;
        $coupon->product_id = $request->product_id;
        $coupon->is_active = $request->filled('is_active') ? true : false;
        $coupon->save();

        return redirect()->route('admin.coupons.index')->with('success', "Successfully Updated");
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json(['message' => "Coupon deleted"], Response::HTTP_OK);
    }
}
