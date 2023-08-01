<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded=[];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}