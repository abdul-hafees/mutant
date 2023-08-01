@extends('admin::layouts.app')
@section('title', 'Admins')


@section('header')
    <h1 class="page-title">Admins</h1>
        <div class="page-header-actions">
            <a class="btn btn-sm btn-primary" href="{{ route('admin.admins.create') }}">
                <i class="icon fa fa-plus" aria-hidden="true"></i>
                <span class="text hidden-sm-down">Create</span>
            </a>
        </div>
@endsection

@section('content')
    {{--<h2>Admins</h2>--}}
    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-filter-temples" class="form-inline mb-0">
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
            {!! $html->table(['id' => 'tbl-admins'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
    {!! $html->scripts() !!}
@endpush

@push('scripts')
    <script>
        $(function() {
            var $table = $('#tbl-admins');

            $table.on('preXhr.dt', function ( e, settings, data ) {
                data.filter = {
                    search: $('#search-query').val(),

                };
            });

            $('#form-filter-temples').submit(function(e) {
                e.preventDefault();
                $table.DataTable().draw();
            });

            $('#btn-clear').click(function() {

                $('#search-query').val('');
                $table.DataTable().draw();
            });

        })
    </script>
@endpush
