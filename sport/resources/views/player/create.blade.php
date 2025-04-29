@extends('layout.layouts')
@section('title', 'Добавить игрока')
@section('content')


<div class="content_row">
    <div class="content_column">
        <h2>Добавить нового игрока</h2>
        <br>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('player.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form_group">
                <label for="lastname" class="form-label">Фамилия:</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
            <div class="form_group">
                <label for="firstname" class="form-label">Имя:</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>
            <div class="form_group">
                <label for="amplya" class="form-label">Амплуа:</label>
                <select class="styled-select" id="amplya" name="amplya" required
                        oninvalid="this.setCustomValidity('Пожалуйста, выберите амплуа')"
                        oninput="this.setCustomValidity('')">
                    <option value="" disabled selected>Выберите амплуа</option>
                    <option value="Нападающий">Нападающий</option>
                    <option value="Центровой">Центровой</option>
                    <option value="Защитник">Защитник</option>
                </select>
            </div>
            <div class="form_group">
                <label for="height" class="form-label">Рост (см):</label>
                <input type="number" id="height" name="height" required>
            </div>
            <div class="form_group">
                <label for="weight" class="form-label">Вес (кг):</label>
                <input type="number" id="weight" name="weight" required>
            </div>
            <div class="form_group">
                <label for="birthday" class="form-label">Дата рождения:</label>
                <input type="date" id="birthday" name="birthday" required>
            </div>
            <div class="form_group">
                <label for="debute" class="form-label">Дата дебюта:</label>
                <input type="date" id="debute" name="debute" required>
            </div>
            <div class="form_group">
                <label for="qty_game" class="form-label">Количество игр:</label>
                <input type="number" id="qty_game" name="qty_game" required>
            </div>
            <div class="form_group">
                <label for="qty_goal" class="form-label">Количество голов:</label>
                <input type="number" id="qty_goal" name="qty_goal" required>
            </div>
            <div class="form_group">
                <label for="win" class="form-label">Количество побед:</label>
                <input type="number" id="win" name="win" required>
            </div>
            <div class="form_group">
                <label for="loss" class="form-label">Количество поражений:</label>
                <input type="number" id="loss" name="loss" required>
            </div>
            <div class="form_group">
                <label for="image" class="form-label">Изображение:</label>
                <input type="file" id="image" name="image" required accept="image/*">
            </div>

            <div class="button-container">
                <button type="submit" class="auth">Добавить игрока</button>
                <a class="back" href="javascript:history.back()">Назад</a>
            </div>
        </form>
    </div>
</div>

@endsection
