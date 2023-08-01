@extends('admin::layouts.app')
@section('title', 'Attributes')

@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.attributes.index')}}">Attributes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="panel">
        <form class="confirm" id="form-attribute-edit" method="POST" action="{{ route('admin.attributes.update', $attribute->id) }}">
            @csrf
            @method('PUT')
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Category<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <select name="category_id" id="category_id"
                                        class="form-control select2 @error('category_id') is-invalid @enderror" autocomplete=" off"
                                        required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if (old('category_id', $attribute->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="" value="{{ old('name', $attribute->name) }}"
                                       autocomplete="off">

                                @error('name')
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
        $(function() {
            'use strict';
            $('#form-attribute-edit').validate({

                rules: {
                    name: {
                        required: true
                    },
                    category_id: {
                        required: true
                    }
                }
            });


        });
    </script>
@endpush
