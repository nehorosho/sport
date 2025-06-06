<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'qty_players'
    ];
    
    public function games()
	{
		return $this->hasMany(Game::class);
	}
}
