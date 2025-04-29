@extends('layout.layouts')
@section('title', 'Добавить очко')
@section('content')

<div class="content_row">
<div class="content_column">
    <h2>Добавить очки в матч: {{ \Carbon\Carbon::parse($game->date)->translatedFormat('d F Y') }}</h2>

    <form action="{{ route('add.point') }}" method="POST">
        @csrf

        <input type="hidden" name="game_id" value="{{ $game->id }}">

        <div class="form_group">
            <label for="scorer" class="form-label">Игрок:</label>
            <select class="form-control gradient-select" name="scorer" id="scorer" required>
                @foreach($players as $player)
                    <option value="{{ $player->lastname }}">{{ $player->firstname }} {{ $player->lastname }}</option>
                @endforeach
            </select>
        </div>

        <div class="form_group">
            <label for="team" class="form-label">Команда:</label>
            <select class="form-control gradient-select" name="team" id="team" required>
                @foreach($teams as $team)
                    <option value="{{ $team }}">{{ $team }}</option>
                @endforeach
            </select>
        </div>

        <div class="form_group">
            <label for="time" class="form-label">Время (минуты):</label>
            <input class="form-control" type="number" step="0.01" name="time" id="time" required>
        </div>

        <div class="form_group">
            <label for="value" class="form-label">Тип очков:</label>
            <select class="form-control gradient-select" name="value" id="value" required>
                <option value="1">1 очко (штрафной)</option>
                <option value="2">2 очка</option>
                <option value="3">3 очка</option>
            </select>
        </div>
        <div class="button-container">
            <button type="submit" class="auth">Добавить очки</button>
            <a class="back" href="javascript:history.back()">Назад</a>
        </div>
    </form>
</div>

@endsection