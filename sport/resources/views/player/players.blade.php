@extends('layout.layouts')
@section('title', 'Игроки')
@section('content')

<div class="container">
    <br>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if($data->role == 'Admin')
        <div class="btn-container">
            <a href="{{ route('player.create') }}" class="btn-new">Добавить игрока</a>
        </div>
    @endif
     
    <div class="players_container">
        @foreach($players as $player)
        <a href="{{ route('player.show', $player->id) }}" class="player_link">
            <div class="players">
                <div class="player_image">
                    <img src="{{ asset('storage/app/public/images/' . $player->image) }}" alt="{{ $player->lastname }}" width="125px" height="100px">
                </div>
                <h3 class="player_name">{{ $player->lastname }} {{ $player->firstname }}</h3>
                <h3 class="player_position">{{ $player->amplya }}</h3>
            </div>
        </a>
        
        @endforeach
    </div>
    <br>
</div>

@endsection
