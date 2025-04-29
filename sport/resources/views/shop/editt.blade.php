@extends('layout.layouts')
@section('title', 'Редактирование категории')
@section('content')

<div class="content_row">
    <div class="content_column">
        <h2>Изменение категории</h2>
       
        <form action="{{route('types.update',$pro->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form_group">
                <input type="text" name="name" placeholder="Введите название" required value="{{$pro->name}}">
            </div>
            <div class="form_group">
                <input type="submit" value="Изменить">
            </div>
        </form>
    </div>
</div>
@endsection
