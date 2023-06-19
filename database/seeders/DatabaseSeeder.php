<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Rating;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
			'name' => 'Admin',
			'email' => 'admin@delivery.lv',
			'password' => bcrypt('admin'),
			'role' => 'admin',
		]);
		
        User::create([
			'name' => 'Kafejnīca Panna',
			'email' => 'info@panna.lv',
			'password' => bcrypt('panna'),
			'role' => 'restaurant',
		]);
		
        User::create([
			'name' => 'Krogs Rūdolfs',
			'email' => 'info@rudolfs.lv',
			'password' => bcrypt('rudolfs'),
			'role' => 'restaurant',
		]);
		
        User::create([
			'name' => 'Anna Ozola',
			'email' => 'a.ozola@inbox.lv',
			'password' => bcrypt('ozola'),
			'role' => 'courier',
		]);
		
        User::create([
			'name' => 'Jānis Bērziņš',
			'email' => 'j.berzins@gmail.com',
			'password' => bcrypt('berzins'),
			'role' => 'courier',
		]);
		
        User::create([
			'name' => 'Kate Siliņa',
			'email' => 'k.silina@inbox.lv',
			'password' => bcrypt('silina'),
			'role' => 'user',
		]);
		
		User::create([
			'name' => 'Matīss Ansons',
			'email' => 'm.ansons@inbox.lv',
			'password' => bcrypt('ansons'),
			'role' => 'user',
		]);
		
		User::create([
			'name' => 'Daniels Laurinavičs',
			'email' => '15daniels02@gmail.com',
			'password' => bcrypt('daniels'),
			'role' => 'user',
		]);
		
		Restaurant::create([
			'name' => 'Kafejnīca Panna',
			'address' => 'Blaumaņa iela 30, Koknese',
			'manager' => 2,
		]);
		
		Restaurant::create([
			'name' => 'Krogs Rūdolfs',
			'address' => 'Blaumaņa iela 15, Koknese',
			'manager' => 3,
		]);
		
		Dish::create([
			'name' => 'Pīles krāsnī',
			'price' => 7.50,
			'maker' => 2,
		]);
		
		Dish::create([
			'name' => 'Skāba zupa',
			'price' => 3.25,
			'maker' => 1,
		]);
		
		Dish::create([
			'name' => 'Kartupeļu pankūkas',
			'price' => 4.80,
			'maker' => 1,
		]);
		
		Dish::create([
			'name' => 'Sildeņu kotletes',
			'price' => 6.90,
			'maker' => 2,
		]);
		
		Dish::create([
			'name' => 'Siermaizes salāti',
			'price' => 5.10,
			'maker' => 2,
		]);
		
		Dish::create([
			'name' => 'Saldējuma panna cotta',
			'price' => 4.50,
			'maker' => 1,
		]);
		
		Order::create([
			'ordered_by' => 6,
			'made_by' => 1,
			'dish_id' => 3,
			'courier_id' => 4,
			'status' => 'completed',
		]);
		
		Order::create([
			'ordered_by' => 7,
			'made_by' => 1,
			'dish_id' => 6,
			'courier_id' => 3,
			'status' => 'completed',
		]);
		
		Order::create([
			'ordered_by' => 7,
			'made_by' => 2,
			'dish_id' => 1,
			'courier_id' => 4,
			'status' => 'completed',
		]);
		
		Order::create([
			'ordered_by' => 6,
			'made_by' => 2,
			'dish_id' => 5,
			'courier_id' => 5,
			'status' => 'completed',
		]);
		
		Order::create([
			'ordered_by' => 8,
			'made_by' => 1,
			'dish_id' => 6,
			'courier_id' => 5,
			'status' => 'completed',
		]);
		
		Order::create([
			'ordered_by' => 7,
			'made_by' => 1,
			'dish_id' => 2,
			'courier_id' => 4,
			'status' => 'completed',
		]);
		
		Order::create([
			'ordered_by' => 6,
			'made_by' => 1,
			'dish_id' => 6,
			'courier_id' => 4,
			'status' => 'completed',
		]);
		
		Order::create([
			'ordered_by' => 7,
			'made_by' => 2,
			'dish_id' => 5,
			'courier_id' => 4,
			'status' => 'completed',
		]);
		
		Order::create([
			'ordered_by' => 8,
			'made_by' => 2,
			'dish_id' => 4,
			'courier_id' => 5,
			'status' => 'completed',
		]);
		
		Order::create([
			'ordered_by' => 6,
			'made_by' => 1,
			'dish_id' => 6,
			'courier_id' => 5,
			'status' => 'completed',
		]);
		
		Rating::create([
			'user_id' => 6,
			'order_id' => 1,
			'order_rating' => 4,
			'courier_rating' => 2,
		]);
		
		Rating::create([
			'user_id' => 7,
			'order_id' => 2,
			'order_rating' => 5,
			'courier_rating' => 4,
		]);
		
		Rating::create([
			'user_id' => 7,
			'order_id' => 3,
			'order_rating' => 5,
			'courier_rating' => 3,
		]);
		
		Rating::create([
			'user_id' => 6,
			'order_id' => 4,
			'order_rating' => 5,
			'courier_rating' => 2,
		]);
		
		Rating::create([
			'user_id' => 8,
			'order_id' => 5,
			'order_rating' => 4,
			'courier_rating' => 3,
		]);
		
		Rating::create([
			'user_id' => 7,
			'order_id' => 6,
			'order_rating' => 3,
			'courier_rating' => 5,
		]);
		
		Rating::create([
			'user_id' => 6,
			'order_id' => 7,
			'order_rating' => 4,
			'courier_rating' => 3,
		]);
		
		Rating::create([
			'user_id' => 7,
			'order_id' => 8,
			'order_rating' => 4,
			'courier_rating' => 5,
		]);
		
		Rating::create([
			'user_id' => 8,
			'order_id' => 9,
			'order_rating' => 5,
			'courier_rating' => 5,
		]);
		
		Rating::create([
			'user_id' => 6,
			'order_id' => 10,
			'order_rating' => 5,
			'courier_rating' => 4,
		]);
    }
}
