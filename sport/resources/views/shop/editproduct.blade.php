@extends('layout.layouts')
@section('title', 'Редактирование товара')
@section('content')

<div class="content_row">
    <div class="content_column">

        <h2>Редактирование товара</h2>
        <br>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form_group">
                <label for="title">Название:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $product->title }}" required>
            </div>
            <br>
            <div class="form_group">
                <label for="price">Цена:</label>
                <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
            </div>
            <br>
            <div class="form_group">
                <label for="size">Размер:</label>
                <input type="text" name="size" id="size" class="form-control" value="{{ $product->size }}" required>
            </div>
            <br>
            <div class="form_group">
                <label for="image">Изображение:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            @if($product->image)
                <br>
                <img src="{{ asset('storage/app/public/images/' . $product->image) }}" alt="{{ $product->title }}" width="100">
            @endif
            <br>
            <div class="form_group">
                <label for="type">Категория:</label>
                <select name="type" id="type" class="form-control">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" @if($type->id == $product->id_type) selected @endif>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="button-container">
            <button type="submit" class="btn-new">Обновить товар</button>
            
            <a class="back" href="javascript:history.back()">Назад</a>
            </div>
        </form>
    </div>    
</div>

@endsection
