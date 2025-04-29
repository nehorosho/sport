@extends('layout.layouts')
@section('title', 'Игры')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="puk">
    @if(Auth::check() && Auth::user()->role === 'Admin')
        <div class="btn-container">
            <a class="btn-new" href="{{ route('admin.games.create') }}">Создать матч</a>
        </div>    
    @endif
</div>

<div class="games">
    @foreach($data as $item)
        <a href="/game/{{ $item->game->id }}" class="game_link">
            <div class="game_item">
                <p class="game_date">{{ \Carbon\Carbon::parse($item->game->date)->translatedFormat('d F Y') }}</p>
                <h3 class="game_teams">{{ $item->first_team->name }} vs {{ $item->second_team->name }}</h3>
                <p class="game_score">{{ $item->first_team_points }} : {{ $item->second_team_points }}</p>
                @if ($item->last_point && $item->last_point->player && $item->last_point->scoringTeam)
                    <p class="last_point">
                        Последние очки: 
                        {{ $item->last_point->time }} мин - 
                        {{ $item->last_point->player->firstname }} {{ $item->last_point->player->lastname }} 
                        ({{ $item->last_point->scoringTeam->name }})
                    </p>
                @endif
            </div>
        </a>
    @endforeach      
</div>

@endsection