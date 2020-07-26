<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingCart extends Model
{
    use SoftDeletes;

    protected $table = 'shoppingcarts';
    protected $guarded = [];

    public function order()
    {
        return $this->hasOne('App\Models\Order');
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
