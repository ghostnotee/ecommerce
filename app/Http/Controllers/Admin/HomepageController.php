<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function index()
    {
        /*if (!Cache::has('statistics')) {
            $statistics = [
                'pendingOrder' => Order::where('status', 'Siparişiniz alındı')->count()
            ];
            $endTime = now()->addMinutes(10);
            Cache::put('statistics', $statistics, $endTime);
            //Cache::add('statistics', $statistics, $endTime);
        } else {
            $statistics = Cache::get('statistics');
        }*/

        //Cache::forget('statistics');
        //Cache::flush();

        /*$endTime = now()->addMinutes(10);
        $statistics = Cache::remember('statistics', $endTime, function () {
            return ['pendingOrder' => Order::where('status', 'Siparişiniz alındı')->count()];
        });*/

        return view('admin.homepage');
    }
}
