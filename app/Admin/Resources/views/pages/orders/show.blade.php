@extends('admin::layouts.app')
@section('title', 'Orders')

@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.orders.index')}}">Orders</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="panel">
        <div class="card">
            <div class="card-header" style="background-color: #ededed">
                <h3>Order Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-4">
                        <div class="row pb-4">
                            <strong class="col-6 col-lg-4 ">Order Status :</strong>
                            <span class="col-6 col-lg-8 ">{{ $order->order_status->label }}</span>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="row pb-4">
                            <strong class="col-6 col-lg-4">Payment Method :</strong>
                            <span class="col-6 col-lg-8 ">{{ $order->payment_method }}</span>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="row pb-4">
                            <strong class="col-6 col-lg-4">Coupon Code :</strong>
                            <span class="col-6 col-lg-8 ">{{ $order->coupon_code }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-4">
                        <div class="row pb-4">
                            <strong class="col-6 col-lg-4">Payment Status :</strong>
                            <span class="col-6 col-lg-8 ">{{ $order->payment_status }}</span>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="row pb-4">
                            <strong class="col-6 col-lg-4">Customer Name :</strong>
                            <span class="col-6 col-lg-8 ">{{ optional($order->user)->name }}</span>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="row pb-4">
                            <strong class="col-6 col-lg-4">Razorpay Order ID :</strong>
                            <span class="col-6 col-lg-8 ">{{ $order->razorpay_order_id }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-4">
                        <div class="row pb-4">
                            <strong class="col-6 col-lg-4">Customer Email :</strong>
                            <span class="col-6 col-lg-8 ">{{ optional($order->user)->email }}</span>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="row pb-4">
                            <strong class="col-6 col-lg-4">Customer Phone :</strong>
                            <span class="col-6 col-lg-8 ">{{ optional($order->user)->phone }}</span>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="row pb-4">
                            <strong class="col-6 col-lg-4">Order Status :</strong>
                            <span class="col-6 col-lg-8 ">{{ $order->order_status->label }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-4">
                        <div class="row pb-4">
                            <strong class="col-6 col-lg-4">Address :</strong>
                            <span class="col-6 col-lg-8 ">{{ optional($order->deliveryAddress)->address }}</span>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="row pb-4">
                            <strong class="col-6 col-lg-4">Contact Phone :</strong>
                            <span class="col-6 col-lg-8 ">{{ optional($order->deliveryAddress)->phone }}</span>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="row pb-4">
                            <strong class="col-6 col-lg-4">Pin Code :</strong>
                            <span class="col-6 col-lg-8 ">{{ optional($order->deliveryAddress)->pincode }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderDetails as $key => $detail)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ optional($detail->product)->product_name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->price }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right"><strong>Sub Total :</strong></td>
                        <td>{{ number_format($order->sub_total, 2, '.', '') }}</td>
                    </tr>
                    <tr>
                        <td class="border-top-0"></td>
                        <td class="border-top-0"></td>
                        <td class="text-right"><strong>Total Tax :</strong></td>
                        <td>{{ number_format($order->total_tax_amount, 2, '.', '') }}</td>
                    </tr>
                    <tr>
                        <td class="border-top-0"></td>
                        <td class="border-top-0"></td>
                        <td class="text-right"><strong>Delivery Fee :</strong></td>
                        <td>{{ number_format($order->delivery_fee, 2, '.', '') }}</td>
                    </tr>
                    <tr>
                        <td class="border-top-0"></td>
                        <td class="border-top-0"></td>
                        <td class="text-right"><strong>Coupon Discount :</strong></td>
                        <td>{{ number_format($order->coupon_discount_amount, 2, '.', '') }}</td>
                    </tr>
                    <tr>
                        <td class="border-top-0"></td>
                        <td class="border-top-0"></td>
                        <td class="text-right"><strong>Total Amount :</strong></td>
                        <td><strong>{{ number_format($order->total_amount, 2, '.', '') }}</strong></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
@endpush
