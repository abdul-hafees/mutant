<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductAttributeValue
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $attribute_id
 * @property int|null $attribute_value_id
 * @property int|null $base_product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereAttributeValueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereBaseProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductAttributeValue extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
