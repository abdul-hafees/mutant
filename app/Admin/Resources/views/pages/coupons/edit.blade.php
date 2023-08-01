@extends('admin::layouts.app')
@section('title', 'Coupons')

@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.coupons.index')}}">Coupons</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="panel">
        <form class="confirm" id="form-attribute-create" method="POST"
              action="{{ route('admin.coupons.update', $coupon->id) }}">
            @csrf
            @method('PUT')
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Name
                                        <span class="required">*</span> </label>
                                    <div class="col-md-9">
                                        <input id="name" name="name" type="text"

                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name', $coupon->name) }}"
                                               autocomplete="off">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-lg-12">--}}
{{--                                <div class="form-group row">--}}
{{--                                    <label for="code" class="col-md-3 col-form-label">Code--}}
{{--                                        <span class="required">*</span> </label>--}}
{{--                                    <div class="col-md-9">--}}
{{--                                        <input id="code"--}}
{{--                                               name="code"--}}
{{--                                               type="text"--}}
{{--                                               class="form-control @error('code') is-invalid @enderror"--}}
{{--                                               value="{{ old('code', $coupon->code) }}"--}}
{{--                                               autocomplete="off">--}}
{{--                                        @error('code')--}}
{{--                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="type" class="col-md-3 col-form-label">Type
                                        <span class="required">*</span> </label>
                                    <div class="col-md-9">
                                        <select
                                            id="type"
                                            name="type"
                                            class="form-control @error('type') is-invalid @enderror"
                                        >
                                            <option>Select Type</option>
                                            <option
                                                @if(\App\Enums\CouponType::PERCENTAGE()->value == $coupon->type )
                                                    selected
                                                @endif
                                                value="{{\App\Enums\CouponType::PERCENTAGE()->value}}">
                                                {{\App\Enums\CouponType::PERCENTAGE()->value}}</option>
                                            <option
                                                @if(\App\Enums\CouponType::AMOUNT()->value == $coupon->type )
                                                    selected
                                                @endif
                                                value="{{\App\Enums\CouponType::AMOUNT()->value}}">
                                                {{\App\Enums\CouponType::AMOUNT()->value}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Is Product?</label>
                                    <div class="col-md-9">
                                        <input id="is_product" @if($coupon->product_id) checked @endif
                                               type="checkbox"
                                               autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none" id="product">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="type" class="col-md-3 col-form-label">Product
                                        <span class="required">*</span> </label>
                                    <div class="col-md-9">
                                        <select
                                            id="product_id"
                                            name="product_id"
                                            class="form-control @error('product_id') is-invalid @enderror"
                                        >
                                            <option disabled selected>Select Product</option>
                                            @foreach($products as $product)
                                                <option @if($coupon->product_id == $product->id) selected @endif
                                                value="{{$product->id}}">
                                                    {{$product->base_name}} {{$product->variant_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="value" class="col-md-3 col-form-label">Percentage/Amount
                                        <span class="required">*</span> </label>
                                    <div class="col-md-9">
                                        <input id="value" name="value" type="text"
                                               class="form-control @error('value') is-invalid @enderror"
                                               value="{{ old('value', $coupon->value) }}"
                                               autocomplete="off">
                                        @error('value')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="minimum_purchase_amount" class="col-md-3 col-form-label">Minimum Purchase Amount
                                        <span class="required">*</span> </label>
                                    <div class="col-md-9">
                                        <input id="minimum_purchase_amount" name="minimum_purchase_amount" type="text"
                                               class="form-control @error('minimum_purchase_amount') is-invalid @enderror"
                                               value="{{ old('minimum_purchase_amount', $coupon->minimum_purchase_amount) }}"
                                               autocomplete="off">
                                        @error('minimum_purchase_amount')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Is Active?</label>
                                    <div class="col-md-9">
                                        <input name="is_active" @if($coupon->is_active) checked @endif
                                        type="checkbox"
                                               autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-9">
                        <button id="btn-submit" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            'use strict';
            $('#form-attribute-create').validate({

                rules: {
                    name: {
                        required: true
                    },
                    // code: {
                    //     required: true
                    // },
                    type: {
                        required: true
                    },
                    value: {
                        required: true
                    },
                    minimum_purchase_amount: {
                        required: true
                    },
                }
            });

            var productId = {{ $coupon->product_id }} ?? '';

            if(productId) {
                $("#product").removeClass('d-none');
            }

            $('#is_product').change(function() {
                if ($(this).is(":checked")) {
                    $("#product").removeClass('d-none');
                } else {
                    $("#product").addClass('d-none');
                }
            });
        });
    </script>
@endpush
