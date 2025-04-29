@extends('layout.layouts')
@section('title', 'Редактировать профиль')
@section('content')

<div class="content_row">
<div class="content_column">
<h2>Личный кабинет</h2>
<br>
<div class="profile-container">
    <div class="profile-header">
        <h2>Редактировать профиль</h2>
    </div>
   @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
        @csrf
        @method('PUT')
        <div class="form_group">
            <label for="firstname">Имя</label>
            <input type="text" id="firstname" name="firstname" value="{{ $data->user->firstname }}" required>
        </div>
        <div class="form_group">
            <label for="lastname">Фамилия</label>
            <input type="text" id="lastname" name="lastname" value="{{ $data->user->lastname }}" required>
        </div>
        <div class="form_group">
            <label for="patronymic">Отчество</label>
            <input type="text" id="patronymic" name="patronymic" value="{{ $data->user->patronymic }}">
        </div>
        <div class="form_group">
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" value="{{ $data->user->login }}" required>
        </div>
        <button class="auth" type="submit">Сохранить изменения</button>
    </form>

    <div class="profile-header">
        <h2>Изменить пароль</h2>
    </div>

    <form action="{{ route('profile.change-password') }}" method="POST" class="profile-form">
        @csrf
        <div class="form_group">
            <label for="current_password">Текущий пароль</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>
        <div class="form_group">
            <label for="new_password">Новый пароль</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div class="form_group">
            <label for="new_password_confirmation">Подтвердите новый пароль</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>
        <button class="auth" type="submit">Изменить пароль</button>
    </form>
    <a class="back" href="javascript:history.back()">Назад</a>
</div>
</div>
</div>
@endsection
