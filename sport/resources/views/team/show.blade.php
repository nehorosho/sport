@extends('layout.layouts')
@section('title', 'Информация о команде')
@section('content')

<div class="container mt-5">
    <h1 class="text-center">{{ $team->name }}</h1>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Информация о команде</h5>
            <p class="card-text">Название: {{ $team->name }}</p>
        </div>
    </div>

    <a href="{{ route('teams.index') }}" class="btn btn-secondary mt-3">Назад к списку команд</a>
</div>

@endsection
