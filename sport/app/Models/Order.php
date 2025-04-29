<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'date',
        'sum',
        'status'
    ];
    
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
