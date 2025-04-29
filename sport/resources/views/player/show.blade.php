@extends('layout.layouts')
@section('title', 'Игрок')
@section('content')

<div class="content_row player_info_container">
	<div class="product_item">
		  <div class="player_image_card">
			  <img class="player_card" src="{{ asset('storage/app/public/images/'.$data->image) }}" alt="{{ $data->lastname }}" width="300px">
		  </div>
		  <h2 class="player_lastname">{{$data->lastname}}</h2>
		  <h3 class="player_firstname">{{$data->firstname}}</h3>
		  <h3 class="player_birthday"><h3 class="player_birthday">Дата рождения:
      {{ \Carbon\Carbon::parse($data->birthday)->format('d.m.Y') }} 
      </h3></h3>
		  <br>
		  <br>
		  @if($data->role == 'Admin')
			  <a href="{{ route('player.edit', ['id' => $data->id]) }}" class="btn-new">Редактировать</a>
			  <form action="{{ route('admin.players.destroy', ['id' => $data->id]) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить игрока?')">
					@csrf
					<br>
					@method('DELETE')
				  	<button type="submit" class="btn-danger">Удалить игрока</button>
				  @endif
	        <br> <br>
	        <a class="back" href="javascript:history.back()">Назад</a>
				</form>
	</div>

	<div class="content_column player_details">
		 <div class="text_content">  
			  <p class="player_info">Рост: {{$data->height}}</p>
			  <p class="player_info">Вес: {{$data->weight}}</p>
			  <p class="player_info">Дебют: {{ \Carbon\Carbon::parse($data->debute)->format('d.m.Y') }}</p>
			  <p class="player_info">Позиция: {{$data->amplya}}</p>
			  <p class="player_info">Игр сыграно: {{$data->qty_game}}</p>
			  <p class="player_info">Забито голов: {{$data->qty_goal}}</p>
			  <p class="player_info">Побед: {{$data->win}} - Поражений: {{$data->loss}}</p>
		 </div>
	</div>

</div>
    
@endsection
