<?php

namespace App\Enums;

use Closure;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self URL()
 * @method static self PRODUCT()
 */
final class BannerRedirectionType extends Enum
{
    protected static function labels(): Closure
    {
        return function (string $name): string|int {
            return ucwords(strtolower(str_replace("_", " ", $name)));
        };
    }
}
