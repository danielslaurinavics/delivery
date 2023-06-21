<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Rating;

class CourierController extends Controller
{
    public function index ()
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
}
