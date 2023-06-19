<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
	
	protected $fillable = [
        'name',
        'price',
        'maker_id',
    ];

    public function maker()
    {
        return $this->belongsTo(Restaurant::class, 'maker_id', 'id');
    }
}
