<?php

namespace App\Enums;

use Closure;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self BASE_PRODUCT()
 * @method static self VARIANT_PRODUCT()
 */
final class ProductType extends Enum
{
    protected static function labels(): Closure
    {
        return function (string $name): string|int {
            return ucwords(strtolower(str_replace("_", " ", $name)));
        };
    }
}
