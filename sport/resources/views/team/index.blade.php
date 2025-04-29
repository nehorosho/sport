@extends('layout.layouts')
@section('title', 'Команды')
@section('content')

<div class="container mt-5">
    <h1 class="text-center">Команды</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($data->role == 'Admin')
        <a href="{{ route('teams.create') }}" class="btn btn-primary mb-3">Добавить команду</a>
    @endif

    <div class="row">
        @foreach($teams as $team)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $team->name }}</h5>
                    <a href="{{ route('teams.show', $team->id) }}" class="btn btn-info btn-sm">Подробнее</a>
                    @if($data->role == 'Admin')
                        <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-primary btn-sm">Редактировать</a>
                        <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
