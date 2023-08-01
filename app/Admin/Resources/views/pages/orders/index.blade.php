@extends('admin::layouts.app')
@section('title', 'Orders')


@section('header')
    <h1 class="page-title">Orders</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-filter" class="form-inline mb-0">
                <div class="form-group">
                    <select name="order_status" id="order_status"
                            class="form-control select2 @error('order_status') is-invalid @enderror"
                            autocomplete=" off">
                        <option value="">Select status</option>
                        @foreach (\App\Enums\OrderStatus::toArray() as $key => $status)
                            <option value="{{ old('order_status', $key) }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button id="btn-filter-temples" type="submit" class="btn btn-primary btn-outline">Search</button>
                    <a id="btn-clear" class="btn btn-primary ml-2 text-white">Clear</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            {!! $html->table(['id' => 'tbl-orders'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
    {!! $html->scripts() !!}
@endpush

@push('scripts')
    <script>
        $(function () {
            var $table = $('#tbl-orders');

            $table.on('preXhr.dt', function (e, settings, data) {
                data.filter = {
                    order_status: $('#order_status').val(),
                };
            });

            $('#form-filter').submit(function (e) {
                e.preventDefault();
                $table.DataTable().draw();
            });

            $('#btn-clear').click(function () {

                $('#order_status').val('').trigger('change.select2');

                $table.DataTable().draw();
            });

        })
    </script>
@endpush
