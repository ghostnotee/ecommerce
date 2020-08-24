<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function index()
    {
        $mostSellingProducts = DB::select("
        SELECT p.product_name, sum(sp.quantity) quantity
        FROM orders o
        INNER JOIN shoppingcarts s ON o.id = o.shoppingcart_id
        INNER JOIN shoppingcart_products sp ON o.id = sp.shoppingcart_id
        INNER JOIN products p ON p.id=sp.product_id
        GROUP BY p.product_name
        ORDER BY SUM(sp.quantity) DESC
        ");

        $salesByMonth = DB::select("
        select
        date_format(o.created_at,'%Y-%m') month, sum(sp.quantity) quantity
        from orders o
        inner join shoppingcarts s on s.id=o.shoppingcart_id
        inner join shoppingcart_products sp on o.id = sp.shoppingcart_id
        group by date_format(o.created_at,'%Y-%m')
        order by date_format(o.created_at,'%Y-%m')
        ");

        return view('admin.homepage', compact('mostSellingProducts','salesByMonth'));
    }
}
