<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
	
	protected $fillable = [
        'ordered_at',
        'ordered_by',
        'made_by',
        'dish_id',
        'courier_id',
		'address',
        'status',
    ];

    public function orderedBy()
    {
        return $this->belongsTo(User::class, 'ordered_by');
    }

    public function madeBy()
    {
        return $this->belongsTo(Restaurant::class, 'made_by');
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function courier()
    {
        return $this->belongsTo(User::class, 'courier_id');
    }
	
	public function rating()
    {
        return $this->hasOne(Rating::class, 'order_id');
    }
}
