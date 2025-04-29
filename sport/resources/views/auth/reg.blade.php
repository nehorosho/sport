@extends('layout.layouts')
@section('title', 'Регистрация')
@section('content')

<div class="content_row">
	<div class="content_column">
		<h2>Регистрация</h2>
		<br>
		@if (session()->has('success'))
		<div class="content_row" style="color: rgb(255, 0, 0)">
			{{ session()->get('success')}}
		</div>
		@endif

		<form action="{{route('store')}}" method="post" name="login">
			@csrf
			<div class="form_group">
				<input type="text" name="firstname" placeholder="Введите имя" require value="">
			</div>
			<div class="form_group">
				<input type="text" name="lastname" placeholder="Введите фамилию" require value="">
			</div>
			<div class="form_group">
				<input type="text" name="patronymic" placeholder="Введите отчество" value="">
			</div>
			<div class="form_group">
				<input type="text" name="login" placeholder="Введите логин" require value="">
			</div>
			<div class="form_group">
				<input type="password" name="password" placeholder="Введите пароль" require value="">
			</div>
			<div class="form_group">
				<input type="password" name="password_confirmation" placeholder="Подтвердите пароль" value="">
			</div>
			<div class="form_group">
				<input class="auth" type="submit" value="Зарегистрироваться">
			</div>
		</form>
	</div>
</div>
@endsection