@extends('layout.layouts')
@section('title', 'Категории')
@section('content')

<div class="content_row">
    <nav class="navigation">
        <ul>
            <li>
                @if($data->role == 'guest')
                    
                    <a href="/cart">Корзина</a>
                    <a href="/login">Вход</a>
                    <a href="/create">Регистрация</a>
                @endif
                @if($data->role == 'User' || $data->role == 'Admin')
                    
                    <a href="{{ route('cart') }}">Корзина</a>
                    <a href="/logout">Выход</a>
                @endif
            </li>
        </ul>
    </nav>
    <form action="{{ route('sort-products', $data->products->first()->id_type) }}" method="GET">
        @csrf
        <label for="sort">Сортировать по:</label>
        <select name="sort" id="sort">
            <option value="name">Наименованию</option>
            <option value="price_asc">Цене (по возрастанию)</option>
            <option value="price_desc">Цене (по убыванию)</option>
        </select>
        <button type="submit">Применить</button>
    </form>
    
    @foreach($data->products as $prod)
        <form action="{{ route('add-to-cart', ['id' => $prod->id]) }}" method="POST" class="product-form">
            @csrf
            <div>
                <img src="{{ asset('storage/app/public/images/' . $prod->image) }}" alt="{{ $prod->title }}" width="100px" height="100px">
            </div>
            <h2>{{ $prod->title }}</h2>
            @if($data->role == 'User' || $data->role == 'Admin')
            <button type="submit" class="btn">Купить</button>   @endif 
            <a href="{{ route('product.show', $prod->id) }}" class="btn btn-info">Подробнее</a>
        </form>
      
    @endforeach
</div>

@endsection
