@extends('admin::layouts.app')
@section('title', 'Admins')

@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.admins.index')}}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="panel">
        <form class="confirm" id="form-user-create" method="POST" action="{{ route('admin.admins.store') }}">
            @csrf
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Name"  value="{{ old('name') }}" autocomplete="off">
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Email<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="email" name="email" type="text"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Email"  value="{{ old('email') }}" autocomplete="off">
                                @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3 col-form-label">Role<span class="required">*</span> </label>--}}
{{--                            <div class="col-md-9">--}}
{{--                                <select data-plugin="select2" multiple="multiple" data-placeholder="Select Roles" name="roles[]" id="roles" class="multi-select-validation col-md-5 @error('role') is-invalid @enderror">--}}
{{--                                    @foreach($roles as $role)--}}
{{--                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <small class="text-danger select-error" data-value="Role value" style="display: none">At least one role required.</small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
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
            $('#form-user-create').validate({

                rules: {
                    name: {
                        required: true
                    },
                    email:{
                        required: true
                    },
                    phone:{
                        required: true
                    }
                }
            });


        });
    </script>
@endpush
