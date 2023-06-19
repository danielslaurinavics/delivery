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
		$dishes = Dish::pluck('name', 'id');
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
}
