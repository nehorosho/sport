<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

		return view('layout.layouts')->with(['data' => $data]);
	}


	public function info()
	{
		$this->authUser();

		$data = (object)[
			'role' => $this->user_role
		];

		return view('layout.info')->with(['data' => $data]);;
	}
	public function create()
	{
		$this->authUser();

		$data = (object)[
			'role' => $this->user_role
		];

		return view('auth.reg')->with(['data' => $data]);
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'firstname' => ['required', 'alpha'],
			'lastname' => ['required', 'alpha'],
			'patronymic' => ['nullable'],
			'login' => ['unique:users'],
			'password' => ['required', 'min:6', 'confirmed']
		]);

		if ($validator->fails()) {
			return redirect()->route('create')->with('success', 'Ошибка регистрации');
		} else {
			User::create([
				'password' => Hash::make($request->password)
			] + $request->all());
			return redirect()->route('login')->with('success', 'Регистрация прошла успешно');
		}
	}

	public function login()
	{
		$this->authUser();

		$data = (object)[
			'role' => $this->user_role
		];

		return view('auth.auth')->with(['data' => $data]);
	}

	public function signup(Request $request)
	{
		if (Auth::attempt($request->only(['login', 'password']))) {
			return redirect()->route('shop.index')->with('success', 'Вы авторизовались!');
		} else {
			return redirect()->route('login')->with('success', 'Неверный логин или пароль');
		}
	}

	public function logout()
	{
		if (Auth::check()) {
			Auth::logout();
		}

		return redirect()->route('login');
	}


	public function editProfile()
	{
	    $this->authUser();

	    if (Auth::check()) {
	        $user = Auth::user();
	        $data = (object)[
	            'role' => $this->user_role,
	            'user' => $user
	        ];
	        return view('profile.edit')->with(['data' => $data]);
	    } else {
	        return redirect()->route('login')->with('success', 'Пожалуйста, войдите в систему');
	    }
	}

	public function updateProfile(Request $request)
	{
	    $this->authUser();

	    if (Auth::check()) {
	        $user = Auth::user();

	        $validator = Validator::make($request->all(), [
	            'firstname' => ['required', 'alpha'],
	            'lastname' => ['required', 'alpha'],
	            'patronymic' => ['nullable', 'alpha'],
	            'login' => ['required', 'unique:users,login,' . $user->id]
	        ]);

	        if ($validator->fails()) {
	            return redirect()->route('profile.edit')->withErrors($validator)->withInput();
	        }

	        $user->update($request->all());
	        return redirect()->route('profile.edit')->with('success', 'Профиль успешно обновлен');
	    } else {
	        return redirect()->route('login')->with('success', 'Пожалуйста, войдите в систему');
	    }
	}

	public function changePassword(Request $request)
	{
	    $this->authUser();

	    if (Auth::check()) {
	        $user = Auth::user();

	        $validator = Validator::make($request->all(), [
	            'current_password' => ['required'],
	            'new_password' => ['required', 'min:6', 'confirmed']
	        ]);

	        if ($validator->fails()) {
	            return redirect()->route('profile.edit')->withErrors($validator)->withInput();
	        }

	        if (!Hash::check($request->current_password, $user->password)) {
	            return redirect()->route('profile.edit')->with('errors', 'Неверный текущий пароль');
	        }

	        $user->password = Hash::make($request->new_password);
	        $user->save();

	        return redirect()->route('profile.edit')->with('success', 'Пароль успешно изменен');
	    } else {
	        return redirect()->route('login')->with('success', 'Пожалуйста, войдите в систему');
	    }
	}
}
