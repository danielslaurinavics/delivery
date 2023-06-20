<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;

class RatingController extends Controller
{
    public function create(string $id)
	{
		$order = Order::findOrFail($id);
		return view('create_rating', compact('order'));
	}
	
	public function store(Request $request)
	{
		$request->validate([
			'order-rating' => 'required|integer|gte:0|lte:5',
			'courier-rating' => 'required|integer|gte:0|lte:5'
		] , [
			'order-rating.required' => __('order.orrerr'),
			'courier-rating.required' => __('order.orrerr'),
			'order-rating.integer' => __('order.orierr'),
			'courier-rating.integer' => __('order.crierr'),	
			'order-rating.gte' => __('order.orgte'),
			'courier-rating.gte' => __('order.crgte'),
			'order-rating.lte' => __('order.orlte'),
			'courier-rating.lte' => __('order.crlte'),
		]);
		
		$rating = new Rating();
		$rating->user_id = auth()->user()->id;
		$rating->order_id = $request->input('order-id');
		$rating->order_rating = $request->input('order-rating');
		$rating->courier_rating = $request->input('courier-rating');
		$rating->save();
		
		return redirect()->route('orders.index');
	}
}
