@extends('layout.layouts')
@section('title', 'Магазин')
@section('content')

<div class="shop-container">
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('sort-products') }}" method="GET" class="filter-form">
        @csrf
        <label for="category" class="filter-label">Категория:</label>
        <select name="category_id" id="category" class="filter-select">
            <option value="">Все категории</option>
            @foreach($data->categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <label for="sort" class="filter-label">Сортировать по:</label>
        <select name="sort" id="sort" class="filter-select">
            <option value="name">Наименованию</option>
            <option value="price_asc">Цене (по возрастанию)</option>
            <option value="price_desc">Цене (по убыванию)</option>
        </select>
        <button type="submit" class="filter-button">Применить</button>
    </form>

    <!-- Ссылка на категории (для админа) -->
    <!-- @if($data->role == 'Admin')
        <a href="{{route('types.index')}}" class="admin-link">Категории</a>
    @endif -->

    <div class="products-grid">
        @foreach($data->products as $prod)
        <form action="{{ route('add-to-cart', ['id' => $prod->id]) }}" method="POST" class="product-card">
            @csrf
            <div class="product-image">
                <img src="{{ asset('storage/app/public/images/' . $prod->image) }}" alt="{{ $prod->title }}">
            </div>
            <h2 class="product-title">{{ $prod->title }}</h2>
            <h3 class="product-price">{{$prod->price}} руб.</h3>
            @if($data->role == 'User' || $data->role == 'Admin')
                <button type="submit" class="buy-button">В корзину</button>
            @endif
            <br>
            <a href="{{ route('product.show', $prod->id) }}" class="details-link">Подробнее</a>
        </form>
        @endforeach
    </div>
</div>

@endsection
