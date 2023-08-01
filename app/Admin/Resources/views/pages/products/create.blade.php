@extends('admin::layouts.app')
@section('title', 'Products')

@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.products.index')}}">Products</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="panel">
        <form class="confirm" id="form-attribute-create" method="POST"
              action="{{ route('admin.products.store') }}"
              enctype="multipart/form-data">
            @csrf
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name
                                <span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="base_name" name="base_name" type="text"
                                       class="form-control @error('base_name') is-invalid @enderror"
                                       value="{{ old('base_name') }}"
                                       autocomplete="off">
                                @error('base_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Variants?</label>
                            <div class="col-md-9">
                                <input id="is_variants"
                                       name="is_variants"
                                       type="checkbox"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="base">

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Price
                                    <span class="required">*</span> </label>
                                <div class="col-md-9">
                                    <input id="price" name="price" type="text"
                                           class="form-control @error('price') is-invalid @enderror"
                                           value="{{ old('price') }}"
                                           autocomplete="off">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Image<span class="required">*</span> </label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="images[]" id="images"
                                               aria-describedby="images" accept="image/*" multiple>
                                        <label class="custom-file-label" for="images">Choose file</label>
                                    </div>
                                    @error('images')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Discount?</label>
                                <div class="col-md-9">
                                    <input id="is_discount"
                                           type="checkbox"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class=" d-none" id="discount_component">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Discount Price </label>
                                    <div class="col-md-9">
                                        <input id="discount_price" name="discount_price" type="text"
                                               class="form-control @error('discount_price') is-invalid @enderror"
                                               value="{{ old('discount_price') }}"
                                               autocomplete="off">
                                        @error('discount_price')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="available_stock_qty"
                                       class="col-md-3 col-form-label">Available Quantity
                                    <span class="required">*</span> </label>
                                <div class="col-md-9">
                                    <input id="available_stock_qty"
                                           name="available_stock_qty" type="number" min="0"
                                           class="form-control @error('available_stock_qty')
                                       is-invalid @enderror"
                                           value="{{ old('available_stock_qty') }}"
                                           autocomplete="off">
                                    @error('available_stock_qty')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Description</label>
                                <div class="col-md-9">
                                <textarea
                                    rows="4"
                                    name="description"
                                    class="form-control"
                                    placeholder="Product Description"
                                ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hub_id" class="col-md-3 col-form-label">Hub
                                <span class="required">*</span> </label>
                            <div class="col-md-9">
                                <select
                                    id="hub_id"
                                    name="hub_id"
                                    class="form-control select2
                                             @error('hub_id') is-invalid @enderror"
                                >
                                    <option value="">Select Hub</option>
                                    @foreach($hubs as $hub)
                                        <option value="{{$hub->id}}">
                                            {{$hub->name}}</option>
                                    @endforeach
                                </select>

                                @error('hub_id')
                                <span class="invalid-feedback"
                                      role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Category
                                <span class="required">*</span> </label>
                            <div class="col-md-9">
                                <div class="form-group d-flex">
                                    <input type="text" class="form-control" id="selectedValue" name="selectedValue"
                                           readonly>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#valueModal">Choose
                                    </button>
                                </div>
                                <input type="hidden" name="category_id" id="category_id">
                                {{--                                <select--}}
                                {{--                                    id="category_id"--}}
                                {{--                                    name="category_id"--}}
                                {{--                                    class="form-control select2 @error('category_id') is-invalid @enderror"--}}
                                {{--                                >--}}
                                {{--                                    <option>Select Category</option>--}}
                                {{--                                    @foreach($categories as $category)--}}
                                {{--                                        <option value="{{$category->id}}">{{$category->name}}</option>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </select>--}}

                                @error('category_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

{{--                        <div class=" d-none" id="sub_category_component">--}}
{{--                            <div class="form-group row">--}}
{{--                                <label class="col-md-3 col-form-label">Sub Category</label>--}}
{{--                                <div class="col-md-9">--}}
{{--                                    <select--}}
{{--                                        id="sub_category_id"--}}
{{--                                        name="sub_category_id"--}}
{{--                                        class="form-control select2 @error('sub_category_id') is-invalid @enderror"--}}
{{--                                    >--}}
{{--                                        <option>Select Sub Category</option>--}}
{{--                                        @foreach($categories as $category)--}}
{{--                                            <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}

{{--                                    @error('sub_category_id')--}}
{{--                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Weight
                                <span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="weight" name="weight" type="text"
                                       class="form-control @error('weight') is-invalid @enderror"
                                       value="{{ old('weight') }}"
                                       autocomplete="off">
                                @error('weight')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Available?</label>
                            <div class="col-md-9">
                                <input id="is_available"
                                       name="is_available"
                                       type="checkbox"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class=" d-none" id="attribute_container">
                            <input type="hidden" name="selectedAttributeIds" id="selectedValuesField">

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Attributes</label>
                                <div class="col-md-9">
                                    <select
                                        name="attributeIds[]"
                                        id="attributesIds"
                                        class="form-control select2"
                                        multiple
                                    >

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 col-lg-1">
                                <button class="btn-primary btn btn-sm d-none"
                                        type="button"
                                        id="create_variants">Create Variants
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="col-3">
                        <div id="image-preview-container"></div>
                    </div>
                </div>

                <div class="variant-container">

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

    <div class="d-none variant-product-template">
        @include('admin::pages.products.variants', ['data' => []])
    </div>

    <div class="modal fade"  id="valueModal" tabindex="-1" role="dialog" aria-labelledby="valueModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="valueModalLabel">Choose Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-5" style="height: 35rem;  overflow-y: auto;">
                    @include('admin::pages.products.category', ['categories' => $categories])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            'use strict';
            $('#form-attribute-create').validate({

                rules: {
                    base_name: {
                        required: true
                    },
                    weight: {
                        required: true
                    },
                    price: {
                        required: function () {
                            return !$('#is_variants').is(':checked');
                        }
                    },
                    available_stock_qty: {
                        required: function () {
                            return !$('#is_variants').is(':checked');
                        }
                    },
                    category_id: {
                        required: true
                    }
                }
            });

            $('input[name="images[]"]').on('change', function (event) {
                previewImages(event);
            });

            function previewImages(event) {
                const files = event.target.files;
                const container = $('#image-preview-container');

                container.empty();

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        const img = $('<img>').attr('src', e.target.result)
                            .css('width', '150px').css('margin', '5px')
                            .css('height', '150px');

                        const removeBtn = $('<button>').text('Remove').addClass('btn btn-danger btn-sm');
                        const imageContainer = $('<div>').addClass('image-container');
                        imageContainer.append(img).append(removeBtn);

                        container.append(imageContainer);

                        removeBtn.on('click', function () {
                            imageContainer.remove();
                            $('input[name="images[]"]').val('');
                        });
                    };

                    reader.readAsDataURL(file);
                }
            }

            // $('#attributesIds').select2({
            //     placeholder: 'Select Attributes',
            //     allowClear: true
            // });
            //
            // $('#hub_id').select2({
            //     placeholder: 'Select Hub',
            //     allowClear: true
            // });

            $('#category_id').change(function () {
                var categoryId = $(this).val();
                alert(categoryId);
                // $("#sub_category_component").removeClass('d-none');
                // getSubCategories(categoryId);
                getAttributes(categoryId);

            });

            $('#is_discount').change(function () {
                if ($(this).is(":checked")) {
                    $("#discount_component").removeClass('d-none');
                } else {
                    $("#discount_component").addClass('d-none');
                }
            });

            $('#is_variants').change(function () {
                if ($(this).is(":checked")) {
                    $("#attribute_container").removeClass('d-none');
                    $(".base").addClass('d-none');
                    $("#attributesIds").prop("readonly", false);
                } else {
                    $("#attribute_container").addClass('d-none');
                    $('.variant-product-template').addClass('d-none');
                    $("#attributesIds").prop("readonly", false);
                    $(".base").removeClass('d-none');
                }
            });

            let variantIndex = 0;

            function cloneVariantSection() {
                variantIndex++;
                let template = $('.variant-product-template').clone();

                template = $(template.html().replaceAll('{button}',
                    '<button class="btn btn-success button-add-variant" type="button">' +
                    '<i class="fa fa-plus"></i>' +
                    '</button>' +
                    '<button class="btn btn-danger button-remove-variant" type="button">' +
                    '<i class="fa fa-trash"></i>' +
                    '</button>'));

                template.removeClass('variant-product-template');
                template.removeClass('d-none');
                $('.variant-container').append(template);


                template.find('.variant_product_price').each(function () {
                    $(this).prop('required', true);
                });
            }

            $(document).on('click', '.button-add-variant', function () {
                cloneVariantSection();
            });

            $(document).on('click', '.button-remove-variant', function () {
                $(this).closest('.row').remove();
                variantIndex--;

                if (variantIndex <= 0) {
                    $('#is_variants').prop('checked', false);
                }
            });

            //get all subcategories based on category field change

            function getSubCategories(categoryId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ url('admin/categories') }}' + '/' + categoryId + '/sub-categories',
                    success: function (response) {
                        $('#sub_category_id').empty();
                        $.each(response, function (index, subcategory) {
                            $('#sub_category_id')
                                .append('' +
                                    '<option value="' + subcategory.id + '">'
                                    + subcategory.name +
                                    '</option>');
                        });
                    }
                });
            }

            //end get all subcategories based on category field change

            //get all attributes based on category field change
            function getAttributes(categoryId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ url('admin/categories') }}' + '/' + categoryId + '/get-attributes',
                    success: function (response) {
                        var selectElement = $('#attributesIds');
                        selectElement.empty();
                        for (var i = 0; i < response.length; i++) {
                            $('<option value=' + response[i].id + '>')
                                .text(response[i].name).appendTo(selectElement);
                        }
                    }
                });
            }

            //end get all attributes based on category field change

            var selectedAttributeIds = [];

            $(document).on('change', 'select[name="attributeIds[]"]', function () {
                var selectedValues = $(this).val();
                var unselectedValue = $(this).find('option:selected').val();

                if (selectedValues) {
                    selectedAttributeIds = [...new Set([...selectedAttributeIds, ...selectedValues.map(Number)])];
                    $("#selectedValuesField").val(JSON.stringify(selectedAttributeIds));
                } else {
                    selectedAttributeIds = selectedAttributeIds.filter(value => value !== unselectedValue);
                    $("#selectedValuesField").val(JSON.stringify(selectedAttributeIds));
                }

                if (selectedAttributeIds.length > 0) {
                    $('#create_variants').removeClass('d-none');
                } else {
                    $('#create_variants').addClass('d-none');
                }
            });

            $("#create_variants").click(function () {
                if (selectedAttributeIds.length > 0) {
                    $("#attributesIds").prop("readonly", false);
                    $.ajax({
                        type: 'GET',
                        url: "{{ url('admin/get-all-attribute-values') }}",
                        data: {
                            attributeIds: selectedAttributeIds,
                        },
                        success: function (data) {
                            $('.variant-product-template').html(data);
                            cloneVariantSection();
                        }
                    });
                }
            });

            $('#valueModal .category-name').on('click', function() {
                var selectedValue = $(this).closest('.list-group-item').attr('data-value');
                var selectedName = $(this).closest('.list-group-item').attr('data-name');
                $('#selectedValue').val(selectedName);
                $('#category_id').val(selectedValue);
                getAttributes(selectedValue);
                $('#valueModal').modal('hide');
            });

            $('.fa-plus').click(function () {
                var subCategories = $(this).closest('.list-group-item').next('ul.list-group');
                $(this).closest('.list-group-item').find('.fa-minus').removeClass('d-none');
                $(this).closest('.list-group-item').find('.fa-plus').addClass('d-none');
                subCategories.removeClass('d-none');
            });

            $('.fa-minus').click(function () {
                var subCategories = $(this).closest('.list-group-item').next('ul.list-group');
                $(this).closest('.list-group-item').find('.fa-minus').addClass('d-none');
                $(this).closest('.list-group-item').find('.fa-plus').removeClass('d-none');
                subCategories.addClass('d-none');

            });
        });
    </script>
@endpush
