@extends('layout.layouts')
@section('title', $product->title)
@section('content')

<div class="product-info-container">
    <div class="product-details">
        <div class="product-image">
            <img src="{{ asset('storage/app/public/images/' . $product->image) }}" alt="{{ $product->title }}" class="product-img">
        </div>
        <h2 class="product-title">{{ $product->title }}</h2>
        <h3 class="product-price">{{ $product->price }} руб.</h3>
        <hr class="divider">
        <p class="product-description">{{ $product->description }}</p>
        @if($data->role == 'User' || $data->role == 'Admin')
            <form action="{{ route('add-to-cart', ['id' => $product->id]) }}" method="POST" class="cart-form">
                @csrf
                <button type="submit" class="btn-add-to-cart">Добавить в корзину</button>
            </form>
        @endif
        @if($data->role == 'Admin')
            <a href="{{ route('product.edit', $product->id) }}" class="btn-edit">Редактировать</a>
            <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Удалить</button>
            </form>
        @endif
        <a href="javascript:history.back()" class="back">Назад</a>
    </div>
</div>

@endsection