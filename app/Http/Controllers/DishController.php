<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class DishController extends Controller
{
	public function index()
	{
		$dishes = Dish::leftJoin('restaurants', 'dishes.maker', '=', 'restaurants.id')
               ->select('dishes.*', 'restaurants.name as maker_name')
               ->get();
		return view('search_dish', ['dishes' => $dishes]);
	}
	
	public function create()
	{
		$restaurants = Restaurant::all();
		return view('create_dish', compact('restaurants'));
	}
	
	public function store(Request $request)
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
}
