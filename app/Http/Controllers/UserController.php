<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Order;

class UserController extends Controller
{
    public function index()
	{
		$users = User::with('restaurants')->get();
		return view('manage_users', ['users' => $users]);
	}
	
	public function blo(string $id)
	{
		$user = User::findOrFail($id);
		return view('block_user', ['user' => $user]);
	}
	
	public function block(string $id)
	{
		$user = User::findOrFail($id);
		
		if ($user->role === 'user')
		{
			$user->is_blocked = true;
			$user->save();
			return redirect()->route('users.index');
		}
		else if ($user->role === 'restaurant')
		{
			$restaurant = Restaurant::where('manager', $id)->pluck('id');
			$statuses = ['pending','preparation','ready'];
			$orders = Order::where('made_by', $restaurant)->where('status', $statuses)->get();
			
			foreach ($orders as $order) {
				$order->delete();
			}
			
			$user->is_blocked = true;
			$user->save();
			return redirect()->route('users.index');
		}
		else if ($user->role === 'courier')
		{
			$status = 'enroute';
			$changeto = 'ready';
			$orders = Order::where('courier_id', $id)->where('status', $status)->get();
			
			foreach ($orders as $order) {
				$order->courier_id = null;
				$order->status = $changeto;
				$order->save();
			}
			
			$user->is_blocked = true;
			$user->save();
			return redirect()->route('users.index');
		}
		else return redirect()->route('users.index');
	}
	
	public function unblock (string $id)
	{
		$user = User::findOrFail($id);
		$user->is_blocked = false;
		$user->save();
		return redirect()->route('users.index');
	}
	
	//public function assignToCourier (string $id)
	//{
		//$user = User::findOrFail($id)
		//$user->role = 'courier';
		//$user->save();
	//}
	
	//public function assignToRestaurant (Request $request)
	//{
		//$user = User::findOrFail($id)
		
		//$restaurant = new Restaurant();
		//$restaurant->name = ;
		//$restaurant->address = ;
		//$restaurant->manager = ;
		
	//}
	
	public function edit (string $id)
	{
		$user = User::findOrFail($id);
		return view('user_edit', compact('user'));
	}
	
	public function update (Request $request, string $id)
	{
		$user = User::findOrFail($id);
		$request->validate([
			'name' => 'required',
		], [
			'name' => __('users.namereq'),
		]);
		
		$user->name = $request->input('name');
		$user->save();
		
		return redirect()->route('welcome');
		
	}
	
}
