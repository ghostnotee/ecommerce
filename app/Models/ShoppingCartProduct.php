<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingCartProduct extends Model
{
    use SoftDeletes;

    protected $table = 'shoppingcart_products';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
