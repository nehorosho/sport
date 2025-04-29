<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class CartController extends Controller
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

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'title' => $product->title,
                'price' => $product->price,
                'size' => $product->size,
                'image' => $product->image,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    public function showCart()
    {
        $this->authUser();
        $user_id = $this->user_id;

        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $orders = Order::where('id_user', $user_id)->with('orderItems.product')->get();

        return view('cart.cart', compact('cart', 'total', 'orders'));
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Товар успешно удален из корзины!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Корзина успешно обновлена');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Корзина пуста!');
        }

        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $order = new Order([
            'id_user' => auth()->id(),
            'date' => now()->toDateTimeString(),
            'sum' => $total
        ]);
        $order->save();

        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        session()->forget('cart');
        session(['order_id' => $order->id]);

        return redirect()->route('cart')->with('success', 'Заказ успешно оформлен!');
    }

    public function check()
    {
        return view('checkout');
    }

    public function downloadReceipt($orderId)
    {
        $paymentMethod = session('payment_method');
        $address = session('delivery_address');
        $comment = session('comment');

        $order = Order::findOrFail($orderId);
        $pdf = PDF::loadView('cart.receipt', compact('order', 'paymentMethod', 'address', 'comment'));
        session()->forget('payment_method');
        session()->forget('delivery_address');
        session()->forget('comment');
        session()->forget('order_id');

        return $pdf->download('receipt.pdf');
    }

    public function redirectToHome()
    {
        return redirect()->route('home')->with('success', 'Заказ успешно оформлен.');
    }
}
