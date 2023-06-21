<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Restaurant;

class RatingController extends Controller
{
    public function create(string $id)
	{
		if(Gate::allows('create-ratings'))
		{
			$order = Order::findOrFail($id);
			return view('create_rating', compact('order'));
		}
		else abort(403);
	}
	
	public function store(Request $request)
	{
		if(Gate::allows('create-ratings'))
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
		else abort(403);
	}
	
	public function viewRestRating (string $id)
	{
		if (Gate::allows('view-rest-rating'))
		{
			$user = User::findOrFail($id);
			
			$restaurant = Restaurant::where('manager', $user->id)->pluck('id');
			$orders = Order::whereIn('made_by', $restaurant)->pluck('id');
			$ratings = Rating::whereIn('order_id', $orders)->get();
			
			$avgrat = 0.0;
			$countord = count($orders);
			$countrat = count($ratings);
			
			foreach ($ratings as $rating) {
				$avgrat = $avgrat + $rating->order_rating;
			}
			
			if ($countrat > 0)
			{
				$avgrat = $avgrat / $countrat;
				$avgratf = number_format($avgrat, 2);
			}
			else
			{
				$avgrat = 0;
				$avgratf = number_format($avgrat, 2);
			}
			
			return view('view_rating_rest', compact('avgratf', 'countord', 'countrat'));
		}
		else abort(403);
	}
	
	public function viewCourRating (string $id)
	{
		if (Gate::allows('view-cour-rating'))
		{
			$user = User::findOrFail($id);
			$orders = Order::where('courier_id', $user->id)->pluck('id');
			$ratings = Rating::whereIn('order_id', $orders)->get();
			
			$avgrat = 0.0;
			$countord = count($orders);
			$countrat = count($ratings);
			
			foreach ($ratings as $rating) $avgrat = $avgrat + $rating->courier_rating;
			
			if ($countrat > 0)
			{
				$avgrat = $avgrat / $countrat;
				$avgratf = number_format($avgrat, 2);
			}
			else
			{
				$avgrat = 0;
				$avgratf = number_format($avgrat, 2);
			}
			
			return view('view_rating_cour', compact('avgratf','countord','countrat'));
		}
		else abort(403);
	}
}
