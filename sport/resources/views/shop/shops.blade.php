@extends('layout.layouts')
@section('title', 'Магазин')
@section('content')

<div class="shop-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($data->role == 'Admin')
        <a class="admin-link" href="{{route('shop.index')}}">Товары</a>
    @endif

    <div class="content_row">
        <div class="content_column">
            @foreach($data->type as $type)
                <a href="/shops/{{ $type->id }}" class="category-card">
                    <div class="card-content">
                        <h2>{{ $type->name }}</h2>
                        @if($data->role == 'Admin')
                            <a class="btn btn-edit" href="{{ route('types.edit', $type->id) }}">Редактировать</a>
                            <form action="{{ route('types.destroy', $type->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить категорию?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Удалить</button>
                            </form>
                        @endif
                    </div>
                </a>
                <br>
            @endforeach
        </div>
    </div>
</div>

@endsection