@extends('layout.layouts')
@section('title', 'Создать команду')
@section('content')

<div class="container mt-5">
    <h1 class="text-center">Создать команду</h1>

    <form action="{{ route('teams.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Название команды</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="qty_players">Количество игроков</label>
            <input type="text" name="qty_players" id="qty_players" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Создать команду</button>
        <a href="{{ route('teams.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>

@endsection
