<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'lastname', 
        'firstname', 
        'amplya', 
        'birthday', 
        'debute', 
        'height', 
        'weight', 
        'qty_game', 
        'qty_goal', 
        'win', 
        'loss', 
        'image'
    ];
    
    public function goals()
    {
        return $this->hasMany(Goal::class, 'id_player');
    }
    
}
