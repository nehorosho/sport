<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Team;
use App\Models\Point;
use App\Models\Player;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function catalog()
    {
        $games = Game::with(['points', 'firstTeam', 'secondTeam'])->orderByDesc('id')->get();
        $data = [];

        foreach ($games as $game) {
            $firstTeamPoints = $game->points->where('scoring_team_id', $game->id_first_team)->sum('value');
            $secondTeamPoints = $game->points->where('scoring_team_id', $game->id_second_team)->sum('value');

            $lastPoint = $game->points->sortByDesc('time')->first();

            $data[] = (object)[
                'game' => $game,
                'first_team' => $game->firstTeam,
                'second_team' => $game->secondTeam,
                'first_team_points' => $firstTeamPoints, // Убедитесь, что это свойство существует
                'second_team_points' => $secondTeamPoints,
                'last_point' => $lastPoint
            ];
        }

        return view('game.games')->with(['data' => $data]);
    }

    public function show(Request $request, $id)
    {
        $game = Game::with(['points.player', 'points.scoringTeam', 'firstTeam', 'secondTeam'])->findOrFail($id);

        $firstTeamPoints = $game->points->where('scoring_team_id', $game->id_first_team)->sum('value');
        $secondTeamPoints = $game->points->where('scoring_team_id', $game->id_second_team)->sum('value');

        $lastPoint = $game->points->sortByDesc('time')->first();

        $data = (object)[
            'game' => $game,
            'first_team' => $game->firstTeam,
            'second_team' => $game->secondTeam,
            'first_team_points' => $firstTeamPoints,
            'second_team_points' => $secondTeamPoints,
            'last_point' => $lastPoint
        ];

        return view('game.show')->with(['data' => $data]);
    }

    public function addPoint(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'scorer' => 'required|string',
            'team' => 'required|string',
            'time' => 'required|numeric|min:0',
            'value' => 'required|in:1,2,3'
        ]);

        // Найдем игрока и команду
        $scorer = Player::where('lastname', $validated['scorer'])->firstOrFail();
        $scoringTeam = Team::where('name', $validated['team'])->firstOrFail();

        // Создаем новое очко
        $point = new Point();
        $point->game_id = $validated['game_id'];
        $point->player_id = $scorer->id;
        $point->scoring_team_id = $scoringTeam->id;
        $point->time = $validated['time'];
        $point->value = $validated['value'];
        $point->save();

        return redirect()->route('show', ['id' => $validated['game_id']])->with('success', 'Очки успешно добавлены!');
    }

    public function showAddPointForm($id)
    {
        $game = Game::findOrFail($id);
        $players = Player::all();
        $teams = [$game->firstTeam->name, $game->secondTeam->name];

        return view('game.add_point', compact('game', 'players', 'teams'));
    }

    public function create()
    {
        $teams = Team::all();
        
        return view('game.store', compact('teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'id_first_team' => 'required|exists:teams,id',
            'id_second_team' => 'required|exists:teams,id|different:id_first_team',
        ]);

        Game::create($validated);

        return redirect()->back()->with('success', 'Матч успешно создан!');
    }
}
