<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'game_id', 
        'player_id', 
        'scoring_team_id', 
        'time'
    ];

    public function games()
	{
		return $this->belongsTo(Game::class);
	}
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function scoring_team()
    {
        return $this->belongsTo(Team::class, 'scoring_team_id');
    }
}
