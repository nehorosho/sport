@extends('layout.layouts')
@section('title', 'Корзина')
@section('content')

<div class="cart-page">
    <h2 class="cart-header">Ваша корзина</h2>
    @if(session('order_id'))
        <div class="download-receipt">
            <a href="{{ route('download-receipt', ['orderId' => session('order_id')]) }}" class="btn-download">Скачать чек</a>
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <div class="cart-items">
            @foreach (session('cart') as $id => $details)
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="{{ asset('storage/app/public/images/'.$details['image']) }}" alt="{{ $details['title'] }}" width="100px" height="100px">
                    </div>
                    <div class="cart-item-details">
                        <h4 class="cart-item-title">{{ $details['title'] }}</h4>
                        <p class="cart-item-price">{{ $details['price'] }} руб</p>
                        <p class="cart-item-size">Размер: {{ $details['size'] }}</p>
                        <form action="{{ route('update-cart', $id) }}" method="POST" class="cart-item-form">
                            @csrf
                            <label for="quantity" class="cart-item-label">Количество:</label>
                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" max="10" class="cart-item-quantity">
                            <button type="submit" class="btn-update">Обновить</button>
                        </form>
                        <form action="{{ route('remove-from-cart', $id) }}" method="POST" class="cart-item-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-remove">Удалить</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="cart-summary">
            <h3 class="cart-total">Итоговая цена: {{ $total }} руб</h3>
            <form action="{{ url('/check') }}" method="POST" class="checkout-form">
                @csrf
                <button type="submit" class="btn-checkout">Оформить заказ</button>
            </form>
        </div>
    @else
        <p class="cart-empty">Ваша корзина пуста.</p>
    @endif

    <hr class="divider">

    <h3 class="cart-header">Ваши предыдущие заказы</h3>
    @foreach($orders as $order)
        <div class="order-item">
            <h4 class="order-date">Заказ от {{ \Carbon\Carbon::parse($order->date)->format('d.m.Y H:i') }}</h4>
            <p class="order-status"><b>Статус:</b> {{ $order->status }}</p>
            @foreach($order->orderItems as $item)
                <p class="order-product">
                    <b>Товар:</b> {{ $item->product->title }}<br>
                    <b>Количество:</b> {{ $item->quantity }}<br>
                    <b>Цена:</b> {{ $item->price }} руб
                </p>
            @endforeach
            <p class="order-total"><b>Сумма заказа:</b> {{ $order->sum }} руб</p>
        </div>
    @endforeach

    <a href="javascript:history.back()" class="back">Назад</a>
</div>

@endsection