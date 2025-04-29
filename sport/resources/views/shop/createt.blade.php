@extends('layout.layouts')
@section('title', 'Добавить категорию')
@section('content')


<div class="content_row">
	<div class="content_column">
		<h2>Добавление категории</h2>
        <br>
		@if(session()->has('success'))
		<div class="content_row" style="color: red">
			{{session()->get('success')}}
		</div>

		@endif
		<form action="{{route('types.store')}}" method="post">
			@csrf
			<div class="form_group">
				<input type="text" name="name" placeholder="Введите название" require value="">
			</div>
			<div class="form_group">
				<input class="auth" type="submit" value="Добавить">
			</div>

			<a class="back" href="javascript:history.back()">Назад</a>
		</form>
	</div>
</div>

@endsection