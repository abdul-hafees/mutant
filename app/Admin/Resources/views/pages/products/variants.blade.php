<div class="row">
    <input type="hidden" name="variant_product_id[]" value="">
    @if(count($data) > 0)
        <?php $x = 0 ?>
        @foreach($data as $attribute)
            <div class="col">
                <div class="form-group">
                    <label for="state">{{$attribute['name']}}</label>
                    <select class="form-control attribute-option"
                            id="attribute-option-{{$x}}"
                            name="attribute-option-{{$x}}[]">
                        @foreach($attribute['values'] as $attributeValue)
                            <option value="{{ $attributeValue['id'] }}">{{ $attributeValue['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        <?php $x++ ?>
        @endforeach
    @endif

    <div class="col">
        <div class="form-group">
            <label for="state">Variant Name</label>
            <input class="form-control" required
                   name="variant_name[]"
                   maxlength="250" >
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="state">Qty</label>
            <input class="form-control"
                   required
                   name="variant_qty[]"
                   maxlength="250" >
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="state">Price</label>
            <input class="form-control variant_price" required
                   name="variant_price[]"
                   maxlength="250" >
        </div>
    </div>

    <div class="col-3">
        <div class="form-group">
            <label for="state">Discount Price</label>
            <div class="input-group">
                <input class="form-control col-12"
                       name="variant_discount[]"
                       maxlength="250" >
                <div class="input-group-append">
                    <button class="btn btn-success button-add-variant" type="button">
                        <i class="fa fa-plus"></i>
                    </button>
                    <button class="btn btn-danger button-remove-variant" type="button">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
