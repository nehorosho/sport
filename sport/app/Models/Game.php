<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'date',
        'id_first_team',
        'id_second_team'
    ];

    public function firstTeam()
    {
        return $this->belongsTo(Team::class, 'id_first_team');
    }

    public function secondTeam()
    {
        return $this->belongsTo(Team::class, 'id_second_team');
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }
}
