@extends('admin::layouts.app')
@section('title', 'Categories')

@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.categories.index')}}">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="panel">
        <form class="confirm" id="form-category-create" method="POST" action="{{ route('admin.categories.store') }}"
              enctype="multipart/form-data">
            @csrf
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Name" value="{{ old('name') }}" autocomplete="off">
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Image</label>
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
            $('#form-category-create').validate({

                rules: {
                    name: {
                        required: true
                    }
                }
            });


        });
    </script>
@endpush
