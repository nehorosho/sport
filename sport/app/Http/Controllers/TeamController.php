<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public $user_id;
	public $user_role;

	public function authUser()
	{
		if (Auth::check()) {
			$user = Auth::user();
			$this->user_id = $user->id;
			$this->user_role = $user->role;
		} else {
			$this->user_role = 'guest';
		}
	}

    public function index()
    {
        $this->authUser();
		$data = (object)[
			'role' => $this->user_role
		];

        $teams = Team::all();

        return view('team.index', compact('teams','data'));
    }

    public function create()
    {
        return view('team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            // Другие правила валидации по необходимости
        ]);

        Team::create($request->all());

        return redirect()->route('teams.index')->with('success', 'Команда успешно добавлена');
    }

    public function show($id)
    {
        $team = Team::findOrFail($id);

        return view('team.show', compact('team'));
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);

        return view('team.edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:250',
        ]);

        $team = Team::findOrFail($id);
        $team->update($request->all());

        return redirect()->route('teams.index')->with('success', 'Команда успешно обновлена');
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Команда успешно удалена');
    }
}
