<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

use App\Models\Order;
use App\Models\Menu;
use App\Models\Table;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalOrders = Order::count();
        $totalMenus = Menu::count();
        $totalTables = Table::count();
        $activeOrders = Order::whereActive(true)->count();

        $orders = Order::with('menu', 'table')->limit(10)->latest()->get();

        return view('home', compact('totalOrders', 'totalMenus', 'totalTables', 'activeOrders', 'orders'));
    }

    public function topMenu()
    {
        $menus = Menu::select('name')->whereHas('order', function (Builder $order)
        {
            $order->whereActive(false);
        })->withCount('order')->orderBy('order_count', 'desc')->take(5)->get();

        $label = collect([]);
        $data = collect([]);

        $menus->each(function ($item, $key) use($label, $data)
        {
            $label->push($item->name);
            $data->push($item->order_count);
        });

        return compact('label', 'data');
    }

    public function totalRevenue()
    {
        $orders = collect([]);
        for ($i=0; $i <= 7; $i++) { 
            $day = Carbon::now()->startOfWeek()->addDays($i);
            $orders->push(Order::whereDate('created_at', $day)->count());
        }

        return $orders;
    }
}
