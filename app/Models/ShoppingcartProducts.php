<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ShoppingcartProducts
 *
 * @property int $id
 * @property int $shoppingcart_id
 * @property int $product_id
 * @property int $quantity
 * @property float $price
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingcartProducts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingcartProducts newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ShoppingcartProducts onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingcartProducts query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingcartProducts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingcartProducts whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingcartProducts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingcartProducts wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingcartProducts whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingcartProducts whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingcartProducts whereShoppingcartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingcartProducts whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingcartProducts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ShoppingcartProducts withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ShoppingcartProducts withoutTrashed()
 * @mixin \Eloquent
 */
class ShoppingcartProducts extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
