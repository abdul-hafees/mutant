@extends('admin::layouts.app')
@section('title', 'Hubs')

@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.hubs.index')}}">Hubs</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="panel">
        <form class="confirm" id="form-attribute-create" method="POST"
              action="{{ route('admin.hubs.store') }}">
            @csrf
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
                                               value="{{ old('name') }}"
                                               autocomplete="off">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="phone" class="col-md-3 col-form-label">Phone
                                        <span class="required">*</span> </label>
                                    <div class="col-md-9">
                                        <input id="phone" name="phone" type="text"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone') }}"
                                               autocomplete="off">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="description" class="col-md-3 col-form-label">Description
                                         </label>
                                    <div class="col-md-9">
                                        <textarea  id="description"
                                                   name="description"
                                                   class="form-control
                                                   @error('description') is-invalid @enderror"
                                                   autocomplete="off"></textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="address" class="col-md-3 col-form-label">Address
                                        <span class="required">*</span> </label>
                                    <div class="col-md-9">
                                        <textarea  id="address"
                                                   name="address"
                                                   class="form-control
                                                   @error('address') is-invalid @enderror"
                                                   autocomplete="off"></textarea>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="pincode" class="col-md-3 col-form-label">Pincode
                                        <span class="required">*</span> </label>
                                    <div class="col-md-9">
                                        <input id="pincode" name="pincode" type="text"
                                               class="form-control @error('pincode') is-invalid @enderror"
                                               value="{{ old('pincode') }}"
                                               autocomplete="off">
                                        @error('pincode')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-lg-12">--}}
{{--                                <div class="form-group row">--}}
{{--                                    <label for="latitude" class="col-md-3 col-form-label">Latitude--}}
{{--                                        <span class="required">*</span> </label>--}}
{{--                                    <div class="col-md-9">--}}
{{--                                        <input id="latitude" name="latitude" type="text"--}}
{{--                                               class="form-control @error('latitude') is-invalid @enderror"--}}
{{--                                               value="{{ old('latitude') }}"--}}
{{--                                               autocomplete="off">--}}
{{--                                        @error('latitude')--}}
{{--                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-lg-12">--}}
{{--                                <div class="form-group row">--}}
{{--                                    <label for="longitude" class="col-md-3 col-form-label">Longitude--}}
{{--                                        <span class="required">*</span> </label>--}}
{{--                                    <div class="col-md-9">--}}
{{--                                        <input id="longitude" name="longitude" type="text"--}}
{{--                                               class="form-control @error('longitude')--}}
{{--                                                is-invalid @enderror"--}}
{{--                                               value="{{ old('longitude') }}"--}}
{{--                                               autocomplete="off">--}}
{{--                                        @error('longitude')--}}
{{--                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
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
            $('#form-attribute-create').validate({

                rules: {
                    name: {
                        required: true
                    },
                    phone: {
                        required: true,
                        number: true
                    },
                    pincode: {
                        required: true,
                        number: true,
                        pattern: /^\d{6}$/
                    },
                    address: {
                        required: true
                    },
                    // latitude: {
                    //     required: true
                    // },
                    // longitude: {
                    //     required: true
                    // },
                },
                messages: {
                    pincode: {
                        required: "Please enter a pin code",
                        number: 'Please enter a valid pin code',
                        pattern: "Please enter a valid pin code"
                    },
                    phone: {
                        number: 'Please enter a valid phone number',
                    },
                }
            });
        });
    </script>
@endpush
