@extends('admin::layouts.app')
@section('title', 'Hubs')


@section('header')
    <h1 class="page-title">Hubs</h1>
    <div class="page-header-actions">
        <a class="btn btn-sm btn-primary" href="{{ route('admin.hubs.create') }}">
            <i class="icon fa fa-plus" aria-hidden="true"></i>
            <span class="text hidden-sm-down">Create</span>
        </a>
    </div>
@endsection

@section('content')
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
            {!! $html->table(['id' => 'tbl-coupons'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
    {!! $html->scripts() !!}
@endpush

@push('scripts')
    <script>
        $(function() {
            var $table = $('#tbl-coupons');

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

        })
    </script>
@endpush
