@extends('layout.layouts')
@section('title', 'Добавить новую игру')
@section('content')

<div class="content_row">
    <div class="content_column">
        <h2>Добавить новую игру</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.games.store') }}" method="POST">
            @csrf

            <div class="form_group">
                <label for="date" class="form-label">Дата:</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>

            <div class="form_group">
                <label for="id_first_team" class="form-label">Первая команда:</label>
                <select name="id_first_team" id="id_first_team" class="form-control" required>
                    <option value="">Выберите команду</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form_group">
                <label for="id_second_team" class="form-label">Вторая команда:</label>
                <select name="id_second_team" id="id_second_team" class="form-control" required>
                    <option value="">Выберите команду</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="button-container">
                <button type="submit" class="auth">Добавить игру</button>
                <a class="back" href="javascript:history.back()">Назад</a>
            </div>
        </form>
    </div>
</div>
@endsection
