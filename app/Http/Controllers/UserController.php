<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Order;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
	{
		if (Gate::allows('manage-users'))
		{
			$users = User::with('restaurants')->get();
			return view('manage_users', ['users' => $users]);
		}
		else abort(403);
	}
	
	public function blo(string $id)
	{
		if (Gate::allows('block-users'))
		{
			$user = User::findOrFail($id);
			return view('block_user', ['user' => $user]);
		}
		else abort(403);
	}
	
	public function block(string $id)
	{
		if (Gate::allows('block-users'))
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
		else abort(403);
	}
	
	public function unblock (string $id)
	{
		if (Gate::allows('block-users'))
		{
			$user = User::findOrFail($id);
			$user->is_blocked = false;
			$user->save();
			return redirect()->route('users.index');
		}
		else abort(403);
	}
	
	public function chrole (string $id)
	{
		if(Gate::allows('change-role'))
		{
			$userr = User::findOrFail($id);
			if ($userr->role !== 'admin' && $userr->role !== 'restaurant') return view('chrole_user', ['userr'=>$userr]);
			else redirect()->back();
		}
		else abort(403);
	}
	
	public function assignToUser (string $id)
	{
		if(Gate::allows('change-role'))
		{
			$user = User::findOrFail($id);
			if ($user->role = 'courier')
			{
				$user->role = 'user';
				$user->save();
			}
			return redirect()->route('users.index');
		}
		else abort(403);
	}
	
	public function assignToCourier (string $id)
	{
		if(Gate::allows('change-role'))
		{
			$user = User::findOrFail($id);
			if ($user->role = 'user')
			{
				$user->role = 'courier';
				$user->save();
			}
			return redirect()->route('users.index');
		}
		else abort(403);
	}

	
	public function crtRest (string $id)
	{
		if(Gate::allows('change-role'))
		{
			$userr = User::findOrFail($id);
			if ($userr->role === 'courier' || $userr->role === 'user') return view('create_restaurant', ['userr' => $userr]);
			else redirect()->route('users.index');
		}
		else abort(403);
	}
	
	public function assignToRestaurant (Request $request, string $id)
	{
		if(Gate::allows('change-role'))
		{
			$user = User::findOrFail($id);
			
			if ($user->role === 'courier' || $userr->role === 'user')
			{
			
			$request->validate([
				'name' => 'required',
				'address' => 'required',
			],[
				'name' => __('users.rnamereq'),
				'address' => __('users.radrreq'),
			]);
			
			$rest = new Restaurant();
			$rest->name = $request->input('name');
			$rest->address = $request->input('address');
			$rest->manager = $user->id;
			$rest->save();
			
			$user->role = 'restaurant';
			$user->save();
			}
			
			return redirect()->route('users.index');
		}
		else abort(403);
	}
	
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
	
	public function changePassword (Request $request)
	{
		$request->validate([
			'op' => 'required',
			'np' => 'required|confirmed|min:8',
		],[
			'op' => __('users.opreq'),
			'np' => __('users.npreq'),
			'np.confirmed' => __('users.npconf'),
			'np.min' => __('users.npmin'),
		]);
		
		$user = Auth::user();
		
		if (!Hash::check($request->op, $user->password)) return back()->withErrors(['error' => __('users.opw')]);
		
		$user->password = Hash::make($request->np);
		$user->save();
		
		return redirect()->route('welcome');
	}
	
}
