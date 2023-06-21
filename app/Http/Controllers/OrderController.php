<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
		if (Gate::allows('view-orders'))
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
		else abort(403);
	}
	
	public function create(string $rid, string $did)
	{
		if (Gate::allows('create-orders'))
		{
			$restaurant = Restaurant::findOrFail($rid);
			$dish = Dish::findOrFail($did);
			return view('create_order', compact('restaurant', 'dish'));
		}
		else abort(403);
	}
	
	public function store(Request $request)
	{
		if (Gate::allows('create-orders'))
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
		else abort(403);
	}
	
	public function restindex()
	{
		if (Gate::allows('view-rest-orders'))
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
		else abort(403);
	}
	
	public function setAsPrep (string $id)
	{
		if (Gate::allows('view-rest-orders'))
		{
			$order = Order::findOrFail($id);
			$order->status = 'preparation';
			$order->save();
			return redirect()->route('rest.index');
		}
		else abort(403);
	}
	
	public function setAsReady (string $id)
	{
		if (Gate::allows('view-rest-orders'))
		{
			$order = Order::findOrFail($id);
			$order->status = 'ready';
			$order->save();
			return redirect()->route('rest.index');
		}
		else abort(403);
	}

	public function courindex ()
	{
		if (Gate::allows('view-cour-orders'))
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
		else abort(403);
	}

	public function setAsEnroute (string $id)
	{
		if (Gate::allows('view-cour-orders'))
		{
			$order = Order::findOrFail($id);
			$order->courier_id = auth()->user()->id;
			$order->status = 'enroute';
			$order->save();
			return redirect()->route('courier.index');
		}
		else abort(403);
	}	
	
	public function setAsDelivered (string $id)
	{
		if (Gate::allows('view-cour-orders'))
		{
			$order = Order::findOrFail($id);
			$order->status = 'completed';
			$order->save();
			return redirect()->route('courier.index');
		}
		else abort(403);
	}	
}
