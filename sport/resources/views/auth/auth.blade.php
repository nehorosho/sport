@extends('layout.layouts')
@section('title', 'Авторизация')
@section('content')

<div class="content_row">
	<div class="content_column">
		<h2>Авторизация</h2>
		<br>
			@if (session()->has('success'))
				<div class="content_row"">
					{{ session()->get('success')}}
				</div>
			@endif
			<form action="{{route('signup')}}" method="post" name="signup">
				@csrf
				<div class="form_group">
					<input type="text" name="login" placeholder="Введите логин" required value="">
				</div>
				<div class="form_group">
					<input type="password" name="password" placeholder="Введите пароль" required value="">
				</div>
				<div class="form_group">
					<input class="auth" type="submit" value="Авторизоваться">
				</div>
			</form>
	</div>
</div>

@endsection