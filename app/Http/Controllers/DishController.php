<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;

class DishController extends Controller
{
	public function index()
	{
		if (Gate::allows('view-dishes'))
		{
			$dishes = Dish::leftJoin('restaurants', 'dishes.maker', '=', 'restaurants.id')
				   ->select('dishes.*', 'restaurants.name as maker_name')
				   ->get();
			return view('search_dish', ['dishes' => $dishes]);
		}
		else abort(403);
	}
	
	public function search(Request $request)
	{
		if (Gate::allows('view-dishes'))
		{
			$query = $request->input('query');

			$dishes = Dish::leftJoin('restaurants', 'dishes.maker', '=', 'restaurants.id')
				->select('dishes.*', 'restaurants.name as maker_name')
				->when($query, function ($queryBuilder) use ($query) {
					$queryBuilder->where('dishes.name', 'LIKE', '%' . $query . '%');
				})
				->get();

			return view('search_dish', ['dishes' => $dishes, 'query' => $query]);
		}
		else abort(403);
	}
	
	public function create()
	{
		if(Gate::allows('ced-dishes'))
		{
			$restaurants = Restaurant::all();
			return view('create_dish', compact('restaurants'));
		}
		else abort(403);
	}
	
	public function store(Request $request)
	{
		if(Gate::allows('ced-dishes'))
		{
		$request->validate([
				'name' => 'required',
				'price' => 'required|numeric|gt:0',
				'maker' => 'required',
			], [
				'name' => __('dish.cr_nameerr'),
				'price.required' => __('dish.cr_priceerr'),
				'price.numeric' => __('dish.cr_pricenum'),
				'price.gt' => __('dish.cr_pricepos'),
				'maker' => __('dish.cr_makererr'),
			]);
			
			$dish = new Dish();
			$dish->name = $request->input('name');
			$dish->price = $request->input('price');
			$dish->maker = $request->input('maker');
			$dish->save();
			
			return redirect()->route('dishes.index');
		}
		else abort(403);
	}
	
	public function edit(string $id)
	{
		if(Gate::allows('ced-dishes'))
		{
			$dish = Dish::findOrFail($id);
			$restaurants = Restaurant::all();
			return view('edit_dish', ['dish' => $dish, 'restaurants' => $restaurants]);
		}
		else abort(403);
	}
	
	public function update(Request $request, string $id)
	{
		if(Gate::allows('ced-dishes'))
		{
			$dish = Dish::findOrFail($id);
			$request->validate([
				'name' => 'required',
				'price' => 'required|numeric|gt:0',
				'maker' => 'required',
			], [
				'name' => __('dish.cr_nameerr'),
				'price.required' => __('dish.cr_priceerr'),
				'price.numeric' => __('dish.cr_pricenum'),
				'price.gt' => __('dish.cr_pricepos'),
				'maker' => __('dish.cr_makererr'),
			]);
			
			$dish->name = $request->input('name');
			$dish->price = $request->input('price');
			$dish->maker = $request->input('maker');
			$dish->save();
			
			return redirect()->route('dishes.index');
		}
		else abort(403);
	}
	
	public function del(string $id)
	{
		if(Gate::allows('ced-dishes'))
		{
			$dish = Dish::findOrFail($id);
			return view('delete_dish', ['dish' => $dish]);
		}
		else abort(403);
	}
	
	public function destroy(string $id)
	{
		if(Gate::allows('ced-dishes'))
		{
			$dish = Dish::findOrFail($id);
			
			$orderIds = Order::where('dish_id', $dish->id)->pluck('id');
			Rating::whereIn('order_id', $orderIds)->delete();
			Order::whereIn('id', $orderIds)->delete();
			
			$dish->delete();
			return redirect()->route('dishes.index');
		}
		else abort(403);
	}
}
