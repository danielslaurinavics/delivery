<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Rating;

class OrderController extends Controller
{
    public function index()
	{
		$user = Auth::user();
        $orders = Order::where('ordered_by', $user->id)->get();
		$restaurants = Restaurant::pluck('name', 'id');
		$dishes = Dish::all()->keyBy('id');
		$couriers = User::pluck('name', 'id');
		
		$orderIds = $orders->pluck('id');
		$ratings = Rating::whereIn('order_id', $orderIds)->get()->keyBy('order_id');
		
		return view('order', [
		'orders' => $orders,
		'restaurants' => $restaurants,
		'dishes' => $dishes,
		'couriers' => $couriers,
		'ratings' => $ratings,
		]);
	}
	
	public function create(string $rid, string $did)
	{
		$restaurant = Restaurant::findOrFail($rid);
		$dish = Dish::findOrFail($did);
		return view('create_order', compact('restaurant', 'dish'));
	}
	
	public function store(Request $request)
	{
		$request->validate([
			'address' => 'required',
		], [
			'address' => __('order.addresserr'),
		]);
		
		$order = new Order();
		$order->ordered_by = auth()->user()->id;
		$order->made_by = $request->input('restaurant-id');
		$order->dish_id = $request->input('dish-id');
		$order->address = $request->input('address');
		$order->save();
		
		return redirect()->route('orders.index');		
	}
	
	public function restindex()
	{
		$user = Auth::user();
		$rest = Restaurant::where('manager', $user->id)->pluck('id');
		$statuses = ['pending','preparation','ready'];
		$orders = Order::where(function ($query) use ($rest, $statuses) {$query->whereIn('status', $statuses)->where('made_by', $rest);})->get();
		$restaurants = Restaurant::pluck('name', 'id');
		$dishes = Dish::all()->keyBy('id');
		$couriers = User::pluck('name', 'id');
		
		$orderIds = $orders->pluck('id');
		$ratings = Rating::whereIn('order_id', $orderIds)->get()->keyBy('order_id');
		
		return view('order_rest', [
		'orders' => $orders,
		'restaurants' => $restaurants,
		'dishes' => $dishes,
		'couriers' => $couriers,
		'ratings' => $ratings,
		]);
	}
	
	public function setAsPrep (string $id)
	{
		$order = Order::findOrFail($id);
		$order->status = 'preparation';
		$order->save();
		return redirect()->route('rest.index');
	}
	
	public function setAsReady (string $id)
	{
		$order = Order::findOrFail($id);
		$order->status = 'ready';
		$order->save();
		return redirect()->route('rest.index');
	}

	public function courindex ()
	{
		$user = Auth::user();
		$orders = Order::where(function ($query) use ($user) {$query->where('status', 'enroute')->where('courier_id', $user->id);})->orWhere('status', 'ready')->get();
		$restaurants = Restaurant::pluck('name', 'id');
		$dishes = Dish::all()->keyBy('id');
		$couriers = User::pluck('name', 'id');
		
		$orderIds = $orders->pluck('id');
		$ratings = Rating::whereIn('order_id', $orderIds)->get()->keyBy('order_id');
		
		return view('order_courier', [
		'orders' => $orders,
		'restaurants' => $restaurants,
		'dishes' => $dishes,
		'couriers' => $couriers,
		'ratings' => $ratings,
		]);
	}

	public function setAsEnroute (string $id)
	{
		$order = Order::findOrFail($id);
		$order->courier_id = auth()->user()->id;
		$order->status = 'enroute';
		$order->save();
		return redirect()->route('courier.index');
	}	
	
	public function setAsDelivered (string $id)
	{
		$order = Order::findOrFail($id);
		$order->status = 'completed';
		$order->save();
		return redirect()->route('courier.index');
	}	
}
