@extends('admin::layouts.app')
@section('title', 'Products')

@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.products.index')}}">Products</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="panel">
        <form class="confirm" id="form-attribute-create" method="POST"
              action="{{ route('admin.products.update', $product->id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name
                                <span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="base_name" name="base_name" type="text"
                                       class="form-control @error('base_name') is-invalid @enderror"
                                       @if($product->type == \App\Enums\ProductType::BASE_PRODUCT()->value)
                                           value="{{ old('base_name', $product->base_name) }}"
                                       @else
                                           value="{{ old('base_name', $product->variant_name) }}"
                                       @endif

                                       autocomplete="off">
                                @error('base_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if(!$product->variants()->count() > 0)
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
                                <label class="col-md-3 col-form-label">Price
                                    <span class="required">*</span> </label>
                                <div class="col-md-9">
                                    <input id="price" name="price" type="text"
                                           class="form-control @error('price')
                                                is-invalid @enderror"
                                           value="{{ old('price', $product->price) }}"
                                           autocomplete="off">
                                    @error('price')
                                    <span class="invalid-feedback"
                                          role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Discount?</label>
                                <div class="col-md-9">
                                    <input id="is_discount"
                                           @if($product->discount_price) checked @endif
                                           type="checkbox"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class=" d-none" id="discount_component">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Discount Price </label>
                                    <div class="col-md-9">
                                        <input id="discount_price" name="discount_price" type="text"
                                               class="form-control @error('discount_price')
                                               is-invalid @enderror"
                                               value="{{ old('discount_price', $product->discount_price) }}"
                                               autocomplete="off">
                                        @error('discount_price')
                                        <span class="invalid-feedback"
                                              role="alert">{{ $message }}</span>
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
                                           name="available_stock_qty" type="number"
                                           class="form-control @error('available_stock_qty')
                                               is-invalid @enderror"
                                           value="{{ old('available_stock_qty',
                                                        $product->available_stock_qty) }}"
                                           autocomplete="off">
                                    @error('available_stock_qty')
                                    <span class="invalid-feedback"
                                          role="alert">{{ $message }}</span>
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
                                        >{{$product->description}}</textarea>
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="hub_id" class="col-md-3 col-form-label">Hub
                                <span class="required">*</span> </label>
                            <div class="col-md-9">
                                <select
                                    id="hub_id"
                                    name="hub_id"
                                    class="form-control @error('hub_id')
                                             is-invalid @enderror"
                                >
                                    @foreach($hubs as $hub)
                                        <option value="{{$hub->id}}"
                                                @if($hub->id == $product->hub_id)
                                                    selected @endif>
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
                                <select readonly disabled
                                    id="category_id"
                                    name="category_id"
                                    class="form-control disabled @error('category_id')
                                             is-invalid @enderror"
                                >
                                    <option>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                                @if($category->id == $product->category_id)
                                                    selected @endif>
                                            {{$category->name}}</option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                <span class="invalid-feedback"
                                      role="alert">{{ $message }}</span>
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
{{--                                        class="form-control @error('sub_category_id')--}}
{{--                                            is-invalid @enderror"--}}
{{--                                    >--}}
{{--                                        <option>Select Sub Category</option>--}}
{{--                                        @foreach($categories as $category)--}}
{{--                                            <option value="{{$category->id}}">--}}
{{--                                                {{$category->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}

{{--                                    @error('sub_category_id')--}}
{{--                                    <span class="invalid-feedback"--}}
{{--                                          role="alert">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Available?</label>
                            <div class="col-md-9">
                                <input id="is_available"
                                       @if($product->is_available == 1) checked @endif
                                       name="is_available"
                                       type="checkbox"
                                       autocomplete="off">
                            </div>
                        </div>
                        @if($product->type == \App\Enums\ProductType::VARIANT_PRODUCT()->value)
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Display?</label>
                                <div class="col-md-9">
                                    <input id="is_display"
                                           @if($product->is_display == 1) checked @endif
                                           name="is_display"
                                           type="checkbox"
                                           autocomplete="off">
                                </div>
                            </div>
                        @endif
                        @if($product->is_display == 0)
                            <div class="form-group row d-none">
                                <label class="col-md-3 col-form-label">Variants?</label>
                                <div class="col-md-9">
                                    <input id="is_variants"
                                           @if($product->is_display == null) checked @endif
                                           name="is_variants"
                                           type="checkbox"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="row d-none" id="attribute_container">
                                <input type="hidden" name="selectedAttributeIds"
                                       id="selectedValuesField">

                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Attributes</label>
                                        <div class="col-md-9">
                                            <select
                                                name="attributeIds[]"
                                                id="attributesIds"
                                                class="form-control"
                                                disabled
                                                multiple
                                            >
                                                @foreach($attributes as $attribute)
                                                    <option selected
                                                            value="{{$attribute->id}}">
                                                        {{$attribute->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                    <div class="col-3">
                        @foreach ($product->getMedia('images') as $image)
                            <div class="image-container">
                                <img width="150"
                                     height="150"
                                     class="m-5 product-image"
                                     src="{{ $image->getUrl() }}"
                                     alt="Product Image">
                                <div class="delete-icon">
                                    <a href="#" class="delete-product-image text-danger"
                                       data-id="{{$image->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                                {{--                                <div class="view-icon text-primary"><i class="fa fa-eye"></i></div>--}}
                            </div>
                        @endforeach
                        <div id="image-preview-container"></div>
                    </div>
                </div>
                @foreach($selectedProductVariants as $productVariant)
                    <div class="row">
                        <input type="hidden" name="variant_product_id[]"
                               value="{{$productVariant['product_id']}}">
                        @foreach($productVariant['attributes'] as $x => $attribute)
                            <div class="col">
                                <div class="form-group">
                                    <label for="state">{{$attribute['attribute_name']}}</label>
                                    <select class="form-control attribute-option"
                                            id="attribute-option-{{$x}}"
                                            name="attribute-option-{{$x}}[]">
                                        @foreach($attribute['attribute_values'] as $value)
                                            <option value="{{ $value['id'] }}"
                                                    @if($value['id'] == $attribute['attribute_value_id'])
                                                        selected @endif>{{ $value['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endforeach
                        <div class="col">
                            <div class="form-group">
                                <label for="state">Variant Name</label>
                                <input class="form-control" required
                                       name="variant_name[]"
                                       value="{{$productVariant['variant_name']}}"
                                       maxlength="250">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="state">Qty</label>
                                <input class="form-control"
                                       required
                                       value="{{$productVariant['available_stock_qty']}}"
                                       name="variant_qty[]"
                                       maxlength="250">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="state">Price</label>
                                <input class="form-control variant_price" required
                                       name="variant_price[]"
                                       value="{{$productVariant['price']}}"
                                       maxlength="250">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="state">Discount Price</label>
                                <div class="input-group">
                                    <input class="form-control"
                                           value="{{$productVariant['discount_price']}}"
                                           name="variant_discount[]"
                                           maxlength="250">
                                    <div class="input-group-append">
                                        <button class="btn btn-success button-add-variant"
                                                type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

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
                            return ! $('#is_variants').is(':checked');
                        }
                    },
                    available_stock_qty: {
                        required: function () {
                            return ! $('#is_variants').is(':checked');
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

            $(".delete-product-image").click(function () {
                let imageId = $(this).attr('data-id');
                if (confirm("Are you sure you want to delete this image?")) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ url('admin/products/delete-image') }}' + '/' + imageId,
                        success: function (response) {
                            toastr.success('Image deleted successfully');
                            window.location.reload();
                        }
                    });
                }
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

            $('#attributesIds').select2({
                placeholder: 'Select Attributes',
                allowClear: true
            });

            $('#hub_id').select2({
                placeholder: 'Select Hub',
            });

            var subCategoryId = '';
            var categoryId = $('#category_id').val();

            @if($product->sub_category_id)
                subCategoryId = {{ $product->sub_category_id ?? '' }};
            @endif

            var discountPrice = {{ $product->discount_price ?? 0 }};
            var isVariantAvailable = $('#is_variants').val();

            if (isVariantAvailable) {
                $("#attribute_container").removeClass('d-none');
                $("#attributesIds").prop("readonly", true);
            }

            if (discountPrice) {
                $("#discount_component").removeClass('d-none');
            }

            if (categoryId) {
                $("#sub_category_component").removeClass('d-none');
                getSubCategories(categoryId, subCategoryId);
            }

            $('#category_id').change(function () {
                var categoryId = $(this).val();
                $("#sub_category_component").removeClass('d-none');

                getSubCategories(categoryId, null);
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
                    $("#attributesIds").prop("readonly", false);
                } else {
                    $("#attribute_container").addClass('d-none');
                    $('.variant-product-template').addClass('d-none');
                    $("#attributesIds").prop("readonly", false);
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

            function getSubCategories(categoryId, subCategoryId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ url('admin/categories') }}' + '/' + categoryId + '/sub-categories',
                    success: function (response) {
                        $('#sub_category_id').empty();
                        $.each(response, function (index, subcategory) {
                            var option = $('<option>', {
                                value: subcategory.id,
                                text: subcategory.name
                            });

                            if (subcategory.id == subCategoryId) {
                                option.attr('selected', 'selected');
                            }

                            $('#sub_category_id').append(option);
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

            selectedAttributeIds = $("#attributesIds").val();

            if (selectedAttributeIds.length > 0) {
                $("#selectedValuesField").val(JSON.stringify(selectedAttributeIds));
                $("#attributesIds").prop("readonly", false);
                $.ajax({
                    type: 'GET',
                    url: "{{ url('admin/get-all-attribute-values') }}",
                    data: {
                        attributeIds: selectedAttributeIds,
                    },
                    success: function (data) {
                        $('.variant-product-template').html(data);
                    }
                });
            }
        });
    </script>
@endpush
