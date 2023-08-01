<?php

namespace App\Admin\Http\Controllers;

use App\Models\Order;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if(request()->ajax()) {
            $query = Order::query()
                ->orderBy('updated_at','desc');
            return DataTables::of($query)
                ->filter(function ($query) {
                    if (request()->filled('filter.order_status')) {
                        $query->where(function ($query) {
                            $query->where('order_status', request('filter.order_status'));
                        });
                    }
                })
                ->editColumn('order_status', function ($query) {
                    return $query->order_status->label;
                })
                ->addColumn('customer', function ($query) {
                    return optional($query->user)->name;
                })
                ->addColumn('action', 'admin::pages.orders.action')
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'customer', 'name' => 'customer', 'title' => 'Customer'],
            ['data' => 'order_status', 'name' => 'order_status', 'title' => 'Order Status'],
            ['data' => 'total_amount', 'name' => 'total_amount', 'title' => 'Total Amount'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
        ])
            ->parameters([
                'searching' => false,
                'ordering' => false,
                'pageLength' => 15
            ])
            ->addAction(['title' => '', 'class' => 'text-right p-3', 'width' => 70]);


        return view('admin::pages.orders.index', compact('html'));
    }

    public function show($id)
    {
        $order = Order::query()->with('orderDetails.product')->findOrFail($id);
        return view('admin::pages.orders.show', compact('order'));
    }
}
