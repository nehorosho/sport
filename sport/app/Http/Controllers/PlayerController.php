<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
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

    public function catalog()
    {
        $this->authUser();
		$data = (object)[
			'role' => $this->user_role
		];

        $players = Player::all();

        return view('player.players', compact('players','data'));
    }
    public function show($id)
    { 
        $this->authUser();
        $player = Player::findOrFail($id);
    
        $data = (object) [
            'id' => $player->id,
            'lastname' => $player->lastname,
            'firstname' => $player->firstname,
            'amplya' => $player->amplya,
            'birthday' => $player->birthday,
            'debute' => $player->debute,
            'height' => $player->height,
            'weight' => $player->weight,
            'qty_game' => $player->qty_game,
            'qty_goal' => $player->qty_goal,
            'win' => $player->win,
            'loss' => $player->loss,
            'image' => $player->image,
			'role' => $this->user_role
        ];
    
        return view('player.show', compact('data'));
    }

    public function create()
    {
        return view('player.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lastname' => 'required|string|max:250',
            'firstname' => 'required|string|max:250',
            'amplya' => 'required|string|max:250',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'birthday' => 'required|date',
            'debute' => 'required|date',
            'qty_game' => 'required|numeric',
            'qty_goal' => 'required|numeric',
            'win' => 'required|integer',
            'loss' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName(); 
            $file->storeAs('public/images', $fileName);
        }

        Player::create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'amplya' => $request->amplya,
            'height' => $request->height,
            'weight' => $request->weight,
            'birthday' => $request->birthday,
            'debute' => $request->debute,
            'qty_game' => $request->qty_game,
            'qty_goal' => $request->qty_goal,
            'win' => $request->win,
            'loss' => $request->loss,
            'image' => $fileName,
        ]);

        return redirect()->route('catalog.player')->with('success', 'Игрок успешно добавлен');
    }

    public function edit($id)
    {
        $player = Player::findOrFail($id);
        
        return view('player.edit', compact('player'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lastname' => 'required|string|max:250',
            'firstname' => 'required|string|max:250',
            'amplya' => 'string|max:250',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'birthday' => 'required|date',
            'debute' => 'required|date',
            'qty_game' => 'required|numeric',
            'qty_goal' => 'required|numeric',
            'win' => 'required|integer',
            'loss' => 'required|integer',
          
        ]);
        $player = Player::findOrFail($id);

        $data = $request->except(['_token', '_method']);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/images', $fileName);
            $data['image'] = $fileName;
        }
    
        $player->update($data);
    
        return redirect()->route('catalog.player')->with('success', 'Игрок успешно обновлен');
    }

    public function destroy($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();

        return redirect()->route('catalog.player')->with('success', 'Игрок успешно удален');
    }
}

    