<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
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
		$types = Type::all();

		$data = (object)[
			'role' => $this->user_role,
			'type' => $types
		];

		return view('shop.shops')->with(['data' => $data]);
	}

	public function show(Request $request, $id)
	{
		$this->authUser();
		$category = Type::find($id);
		$product = Product::where('id_type', $id)->get();

		$data = (object)[
			'id' => $category->id,
			'name' => $category->name,
			'products' => $product,
			'role' => $this->user_role
		];

		return view('shop.show')->with(['data' => $data]);
	}

	public function create()
	{
		$this->authUser();

		$data = (object)[
			'role' => $this->user_role
		];

		$category = Type::all();

		return view('shop.createt')->with(['category' => $category, 'data' => $data]);
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => ['required', 'max:125'],
		]);

		if ($validator->fails()) {
			return redirect()->route('createt')->with('success', 'Ошибки при заполнении формы');
		} else {
			Type::create($validator->validated());
			return redirect()->route('shop.index')->with('success', 'Категория добавлена');
		}
	}

	public function edit(string $id)
	{
		$this->authUser();

		$data = (object)[
			'role' => $this->user_role
		];

		$pro = Type::find($id);
		
		return view('shop.editt', compact('pro'))->with(['data' => $data]);
	}

	public function update(Request $request, $id)
	{
		$category = Type::findOrFail($id);
		$category->update($request->all());

		return redirect()->route('types.index')->with('success', 'Категория обновлена');
	}

	public function destroy(string $id)
	{
		$category = Type::find($id);
		$category->delete();
		
		return redirect()->route('types.index')->with('success', 'Категория удален');
	}
}
