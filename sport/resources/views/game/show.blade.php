@extends('layout.layouts')
@section('title', 'Игра')
@section('content')

<div class="content_row">
    <!-- Уведомление об успехе -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Кнопка "Добавить очки" -->
    @if(Auth::check() && Auth::user()->role === 'Admin')
        <div class="btn-container">
            <a class="btn-new" href="{{ route('add.point.form', ['id' => $data->game->id]) }}">Добавить очки</a>
        </div> 
    @endif

    <!-- Информация о матче -->
    <div class="player_item">
        <p class="player_date">Дата: {{ \Carbon\Carbon::parse($data->game->date)->translatedFormat('d F Y') }}</p>
        <h3 class="player_teams">{{ $data->first_team->name }} - {{ $data->second_team->name }}</h3>
        <p class="game_score">
            {{ isset($data->first_team_points) ? $data->first_team_points : 0 }} :
            {{ isset($data->second_team_points) ? $data->second_team_points : 0 }}
        </p>
        <div class="text_content">
            @if(isset($data->last_point))
                <p class="player_goals">Последние очки: {{ $data->last_point->time }} мин</p>
                    @if(isset($data->last_point->player))
                        <p class="player_scorer">
                            Забил: {{ $data->last_point->player->firstname }} {{ $data->last_point->player->lastname }}
                        </p>
                    @else
                        <p class="player_scorer">Имя игрока не найдено</p>
                    @endif
                    @else
                        <p class="player_goals">Очков пока нет</p>
            @endif
            <a class="back-show" href="javascript:history.back()">Назад</a>
        </div>
    </div>

    <div class="button-container">
        
    </div>
</div>

@endsection
