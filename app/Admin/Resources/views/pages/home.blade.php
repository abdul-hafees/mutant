@extends('admin::layouts.app')
@section('title', 'CMS')

@section('content')
    <div class="panel">
        <form class="confirm" id="form-banner-create" method="POST" action="{{ route('admin.home.store') }}"
              enctype="multipart/form-data">
            @csrf
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-6 col-lg-6">

                        @foreach($contents as $content)
                            @if($content->type == \App\Models\Content::IMAGE)
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">{{ ucwords(str_replace("_", " ", $content->key)) }}</label>
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="{{ $content->key }}"
                                                   id="{{ $content->key }}"
                                                   aria-describedby="{{ $content->key }}">
                                            <label class="custom-file-label" for="{{ $content->key }}">Choose
                                                file</label>
                                        </div>
                                        <img src="{{ asset($content->image_url) }}" style="height: 100px; width: 100px; object-fit: cover">
                                        @error($content->key)
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            @if($content->type == \App\Models\Content::TEXT)
                                <div class="form-group row ">
                                    <label class="col-md-3 col-form-label">{{ ucwords(str_replace("_", " ", $content->key)) }}</label>
                                    <div class="col-md-9">
                                        <input id="{{ $content->key }}" name="{{ $content->key }}" type="text"
                                               class="form-control @error($content->key) is-invalid @enderror"
                                               placeholder="{{ ucwords(str_replace("_", " ", $content->key)) }}" value="{{ $content->value }}"
                                               autocomplete="off">
                                        @error($content->key)
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            @endif

                        @endforeach

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
@endpush
