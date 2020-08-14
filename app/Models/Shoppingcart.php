<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Shoppingcart
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Order|null $order
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ShoppingcartProducts[] $shoppingcartProducts
 * @property-read int|null $shoppingcart_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shoppingcart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shoppingcart newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoppingcart onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shoppingcart query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shoppingcart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shoppingcart whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shoppingcart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shoppingcart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shoppingcart whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoppingcart withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoppingcart withoutTrashed()
 * @mixin \Eloquent
 */
class Shoppingcart extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }

    public function shoppingcartProducts()
    {
        return $this->hasMany('App\Models\ShoppingcartProducts');
    }

    public static function activeCartId()
    {
        $activeCart = DB::table('shoppingcarts as s')
            ->leftJoin('orders as o', 'o.shoppingcart_id', '=', 's.id')
            ->where('s.user_id', Auth::id())
            ->whereRaw('o.id is null')
            ->orderByDesc('s.created_at')
            ->select('s.id')
            ->first();

        if (!is_null($activeCart)) return $activeCart->id;
    }

    public function shoppingcartProductQuantity()
    {
        return DB::table('shoppingcart_products')
            ->where('shoppingcart_id', $this->id)
            ->whereRaw('deleted_at is null')
            ->sum('quantity');
    }
}
