<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_order extends Model
{
    use HasFactory;
    protected $fillable = [
        'qty', 
        'id_order', 
        'id_product'
    ];
    
    public function products()
	{
		return $this->belongsTo(Product::class);
	}
    public function orders()
	{
		return $this->belongsTo(Order::class);
	}
}
