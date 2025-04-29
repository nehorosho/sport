@extends('layout.layouts')
@section('title', 'Добавить товар')
@section('content')


<div class="content_row">
    <div class="content_column">
        <h2>Добавить новый товар</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form_group">
                <label for="title">Название</label>
                <input type="text" name="title" id="title" class="form-control" required>
                @error('title')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form_group">
                <label for="description">Описание</label>
                <input type="text" name="description" id="description" class="form-control" required>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form_group">
                <label for="price">Цена</label>
                <input type="text" name="price" id="price" class="form-control" required>
                @error('price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form_group">
                <label for="image">Изображение</label>
                <input type="file" name="image" id="image" class="form-control" required>
                @error('image')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form_group">
                <label for="id_type">Категория</label>
                <select name="id_type" id="id_type" class="form-control" required>
                    <option value="">Выберите категорию</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('id_type')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form_group">
                <button class="auth" type="submit">Добавить товар</button>
            </div>
            <a class="back" href="javascript:history.back()">Назад</a>
        </form>
    </div>
</div>
@endsection
