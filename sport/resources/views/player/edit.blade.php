@extends('layout.layouts')
@section('title', 'Редактирование игрока')
@section('content')

<div class="content_row">
    <div class="content_column">
        <h2>Редактирование игрока</h2>
        <br>
        <form action="{{ route('player.update', ['id' => $player->id]) }}" method="POST" class="edit-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form_group">
                <label for="lastname">Фамилия:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $player->lastname }}" required>
            </div>

            <div class="form_group">
                <label for="firstname">Имя:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $player->firstname }}" required>
            </div>

            <div class="form_group">
                <label for="birthday">Дата рождения:</label>
                <input type="date" name="birthday" id="birthday" class="form-control" value="{{ $player->birthday }}" required>
            </div>

            <div class="form_group">
                <label for="debute">Дата дебюта:</label>
                <input type="date" name="debute" id="debute" class="form-control" value="{{ $player->debute }}" required>
            </div>

            <div class="form_group">
                <label for="height">Рост:</label>
                <input type="number" name="height" id="height" class="form-control" value="{{ $player->height }}" required>
            </div>

            <div class="form_group">
                <label for="weight">Вес:</label>
                <input type="number" name="weight" id="weight" class="form-control" value="{{ $player->weight }}" required>
            </div>

            <div class="form_group">
                <label for="qty_game">Игр сыграно:</label>
                <input type="number" name="qty_game" id="qty_game" class="form-control" value="{{ $player->qty_game }}" required>
            </div>

            <div class="form_group">
                <label for="qty_goal">Забито голов:</label>
                <input type="number" name="qty_goal" id="qty_goal" class="form-control" value="{{ $player->qty_goal }}" required>
            </div>

            <div class="form_group">
                <label for="win">Побед:</label>
                <input type="number" name="win" id="win" class="form-control" value="{{ $player->win }}" required>
            </div>

            <div class="form_group">
                <label for="loss">Поражений:</label>
                <input type="number" name="loss" id="loss" class="form-control" value="{{ $player->loss }}" required>
            </div>

            <div class="button-container">
                <button type="submit" class="auth">Сохранить изменения</button>
                <a class="back" href="javascript:history.back()">Назад</a>
            </div>
        </form>
    </div>    
</div>

@endsection
