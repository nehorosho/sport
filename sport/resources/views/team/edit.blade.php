@extends('layout.layouts')
@section('title', 'Редактировать команду')
@section('content')

<div class="container mt-5">
    <h1 class="text-center">Редактировать команду</h1>

    <form action="{{ route('teams.update', ['id' => $team->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Название команды</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $team->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="{{ route('teams.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>

@endsection
