<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'player_id',
        'scoring_team_id',
        'time',
        'value'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function scoringTeam()
    {
        return $this->belongsTo(Team::class, 'scoring_team_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
