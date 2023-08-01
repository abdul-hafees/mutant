@extends('admin::layouts.app')
@section('title', 'Products')


@section('header')
    <h1 class="page-title">{{ $product->base_name }} - Variants</h1>
    <div class="page-header-actions">
{{--        <a class="btn btn-sm btn-primary" href="{{ route('admin.products.create') }}">--}}
{{--            <i class="icon fa fa-plus" aria-hidden="true"></i>--}}
{{--            <span class="text hidden-sm-down">Create</span>--}}
{{--        </a>--}}
    </div>
@endsection

@section('content')
    {{--<h2>Admins</h2>--}}
    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-filter" class="form-inline mb-0">
                <div class="form-group">
                    <label class="sr-only" for="inputUnlabelUsername">Search</label>
                    <input id="search-query" type="text" class="form-control w-full" placeholder="Search..." autocomplete="off">
                </div>
                <div class="form-group">
                    <button id="btn-filter-temples" type="submit" class="btn btn-primary btn-outline">Search</button>
                    <a id="btn-clear" class="btn btn-primary ml-2 text-white">Clear</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            {!! $html->table(['id' => 'tbl-products'], true) !!}
        </div>
    </div>

    <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{url('admin/product-stock-details/update')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title" id="exampleModalLabel">Manage Stock</h5>
                    </div>
                    <div class="modal-body">
                        <input id="product_id" class="form-control" name="product_id" type="hidden">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name</label>
                            <div class="col-md-6">
                                <input id="product_name" class="form-control" readonly disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Price
                                <span class="required">*</span> </label>
                            <div class="col-md-6">
                                <input id="product_price" name="price" type="text"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price') }}"
                                       autocomplete="off">
                                @error('price')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Discount Price </label>
                            <div class="col-md-6">
                                <input id="product_discount_price" name="discount_price" type="text"
                                       class="form-control @error('discount_price') is-invalid @enderror"
                                       value="{{ old('discount_price') }}"
                                       autocomplete="off">
                                @error('discount_price')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Quantity</label>
                            <div class="col-md-6">
                                <input id="product_qty" name="available_stock_qty" type="text"
                                       class="form-control @error('available_stock_qty') is-invalid @enderror"
                                       value="{{ old('available_stock_qty') }}"
                                       autocomplete="off">
                                @error('available_stock_qty')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    {!! $html->scripts() !!}
@endpush

@push('scripts')
    <script>
        $(function() {
            var $table = $('#tbl-products');

            $table.on('preXhr.dt', function ( e, settings, data ) {
                data.filter = {
                    search: $('#search-query').val(),

                };
            });

            $('#form-filter').submit(function(e) {
                e.preventDefault();
                $table.DataTable().draw();
            });

            $('#btn-clear').click(function() {

                $('#search-query').val('');
                $table.DataTable().draw();
            });

            $table.on('click', '.button-destroy', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var ladda = Ladda.create(this);
                ladda.start();

                alertify.okBtn("Delete")
                alertify.confirm("Are you sure?", function () {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}"
                        }
                    }).done(function (data, textStatus, jqXHR) {
                        $table.DataTable().draw();
                    }).fail(function (jqXHR, textStatus, errorThrown) {

                    }).always(function () {
                        ladda.stop();
                    });
                }, function () {
                    ladda.stop();
                });
            });

            @if($errors->any())
                $('#stockModal').modal('show');
            @endif

            $table.on('click', '.manage-stock', function (e) {
                e.preventDefault();
                let productId = $(this).attr('data-id');
                let productName = $(this).attr('data-name');
                let qty = $(this).attr('data-qty');
                let price = $(this).attr('data-price');
                let discountPrice = $(this).attr('data-discount-price');
                $("#product_id").val(productId);
                $("#product_price").val(price);
                $("#product_name").val(productName);
                $("#product_discount_price").val(discountPrice);
                $("#product_qty").val(qty);
                $('#stockModal').modal('show');
            });
        })
    </script>
@endpush
