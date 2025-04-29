<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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

    public function create()
    {
        $types = Type::all();

        return view('shop.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string|max:250',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_type' => 'required|exists:types,id',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName(); 
            $file->storeAs('public/images', $fileName);
        }

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $fileName;
        $product->id_type = $request->id_type;
        $product->save();

        return redirect()->route('shop.index')->with('success', 'Товар успешно добавлен');
    }

    public function edit(Product $product)
    {
        $types = Type::all();
        return view('shop.editproduct', compact('product', 'types'));
    }

    public function show(Product $product)
    {
        $this->authUser();

        $data = (object)[
            'role' => $this->user_role
        ];

        return view('shop.product', compact('product', 'data'));
    }

    public function index(Request $request)
    {
        $this->authUser();
        $query = Product::query();
        
        if ($request->has('category_id')) {
            $query->where('id_type', $request->input('category_id'));
        }

        if ($request->has('sort')) {
            $sortBy = $request->input('sort');
            if ($sortBy == 'name') {
                $query->orderBy('title');
            } elseif ($sortBy == 'price_asc') {
                $query->orderBy('price');
            } elseif ($sortBy == 'price_desc') {
                $query->orderByDesc('price');
            }
        }

        $products = $query->get();
        $categories = Type::all();

        $data = (object)[
            'role' => $this->user_role,
            'products' => $products,
            'categories' => $categories
        ];

        return view('shop.index', compact('data'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'price' => 'required|numeric',
            'size' => 'required|string|max:250',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|exists:types,id',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists('images/' . $product->image)) {
                Storage::disk('public')->delete('images/' . $product->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = basename($imagePath);
        }

        $product->title = $request->title;
        $product->price = $request->price;
        $product->size = $request->size;
        $product->id_type = $request->type;
        $product->save();

        return redirect()->route('shop.index')->with('success', 'Товар успешно обновлен');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('shop.index')->with('success', 'Товар успешно удален');
    }

    public function sort(Request $request)
    {
        $this->authUser();
        
        $sortBy = $request->input('sort');
        $categoryId = $request->input('category_id');

        $query = Product::query();
        
        if ($categoryId) {
            $query->where('id_type', $categoryId);
        }

        if ($sortBy == 'name') {
            $query->orderBy('title');
        } elseif ($sortBy == 'price_asc') {
            $query->orderBy('price');
        } elseif ($sortBy == 'price_desc') {
            $query->orderByDesc('price');
        }

        $products = $query->get();
        $categories = Type::all();

        $data = (object)[
            'role' => $this->user_role,
            'products' => $products,
            'categories' => $categories
        ];

        return view('shop.index', compact('data'));
    }

}
