@extends('admin::layouts.app')
@section('title', 'Banners')

@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.banners.index')}}">Banners</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="panel">
        <form class="confirm" id="form-banner-create" method="POST" action="{{ route('admin.banners.store') }}"
              enctype="multipart/form-data">
            @csrf
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-6 col-lg-6">

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Image<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image"
                                           aria-describedby="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                @error('image')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Redirection Type<span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="redirection_type" checked
                                           id="product-checkbox"
                                           value="{{ \App\Enums\BannerRedirectionType::PRODUCT() }}">
                                    <label class="form-check-label" for="product-checkbox">Product</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="redirection_type"
                                           id="url-checkbox"
                                           value="{{ \App\Enums\BannerRedirectionType::URL() }}">
                                    <label class="form-check-label" for="url-checkbox">URL</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row url-section d-none">
                            <label class="col-md-3 col-form-label">URL </label>
                            <div class="col-md-9">
                                <input id="url" name="url" type="text"
                                       class="form-control @error('url') is-invalid @enderror"
                                       placeholder="URL" value="{{ old('url') }}" autocomplete="off">
                                @error('url')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row product-section">
                            <label class="col-md-3 col-form-label">Product</label>
                            <div class="col-md-9">
                                <select name="product_id" id="product_id"
                                        class="form-control select2 @error('product_id') is-invalid @enderror"
                                        autocomplete=" off">
                                    <option value="">Select product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                                @if (old('product_id') == $product->id) selected @endif>{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
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
        $(function () {
            'use strict';
            $('#form-banner-create').validate({

                rules: {
                    image: {
                        required: true
                    }
                }
            });

            $('input[type="radio"]').change(function () {
                let redirection_type = $('input[name="redirection_type"]:checked').val();
                if (redirection_type === '{{ \App\Enums\BannerRedirectionType::PRODUCT() }}') {
                    $('.product-section').removeClass('d-none');
                    $('.url-section').addClass('d-none');
                    $("#url").val('');
                } else {
                    $('.product-section').addClass('d-none');
                    $('.url-section').removeClass('d-none');
                    $('#product_id').val('').trigger('change.select2');
                }
            });


        });
    </script>
@endpush
