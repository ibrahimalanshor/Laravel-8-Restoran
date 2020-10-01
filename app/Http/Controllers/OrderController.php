<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

use Auth;

use App\Models\Menu;
use App\Models\Category;
use App\Models\Order;
use App\Models\Table;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tables = Table::whereHas('order', function (Builder $order)
        {
            $order->whereActive(true);
        })->latest()->get();

        $code = $request->code;

        if ($code) {
            $orders = Order::with('menu')->whereIn('id', $code)->whereActive(true)->paginate(10);
        } else {
            $orders = Order::with('menu')->whereActive(true)->latest()->paginate(10);
        }

        return view('order.index', compact('orders', 'tables', 'code'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::latest()->get();
        $tables = Table::whereDoesntHave('order', function (Builder $order)
        {
            $order->whereActive(true);
        })->orderBy('no', 'asc')->get();

        if ($request->page) {
            $menus = Menu::latest()->paginate(9);
            return $menus;
        } else {
            $menus = Menu::latest()->paginate(9);
        }
        return view('order.create', compact('menus', 'tables', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu' => 'required',
            'qty' => 'required',
            'table_id' => 'required'
        ]);

        $code = Str::random(6);

        $request->merge([
            'user_id' => Auth::id(),
            'code' => strtoupper(Auth::id().$code)
        ]);

        $menu = collect($request->menu);
        $qty = collect($request->qty);

        $qty = $qty->map(function ($item)
        {
            return ['qty' => $item];
        });

        $menu_order = $menu->combine($qty)->all();

        $order = Order::create($request->only('user_id', 'table_id', 'code'));
        $order->menu()->attach($menu_order);

        return redirect('order')->with('success', 'Success Order');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $order = Order::with('menu', 'user')->whereCode($code)->firstOrFail();

        return view('order.checkout', compact('order'));
    }

    public function checkout(Request $request)
    {
        $menus = explode(',', $request->menu);
        $qty = explode(',', $request->qty);

        $carts = Menu::whereIn('id', $menus)->get();

        return view('order.checkout', compact('carts', 'qty'));
    }

    public function print(Order $order)
    {
        return view('order.print', compact('order'));
    }

    public function pay(Order $order)
    {
        $order->update(['active' => false]);

        return redirect('order')->with('success', 'Success Checkout');
    }

    public function detail(Menu $menu)
    {
        return view('order.detail', compact('menu'));
    }

    public function search(Request $request)
    {
        $name = $request->name;
        $menus = Menu::where('name', 'like', '%'.$name.'%')->paginate(9);

        return compact('name', 'menus');
    }

    public function category(Request $request)
    {
        $id = $request->category;

        $menus = Menu::whereHas('categories', function (Builder $category) use ($id)
        {
            $category->whereIn('category_id', $id);
        })->paginate(9);

        return $menus;
    }
}
