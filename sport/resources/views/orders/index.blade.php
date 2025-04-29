@extends('layout.layouts')
@section('title', 'Все заказы')
@section('content')


<div class="content_row">
    <div class="content_column">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="orders">Все заказы</h1>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>№ заказа</th>
                    <th>Дата</th>
                    <th>Пользователь</th>
                    <th>Статус</th>
                    <th>Товары</th>
                    <th>Сумма</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->date)->format('d.m.Y H:i') }}</td>
                        <td>{{ $order->user->lastname }} {{ $order->user->firstname }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            @foreach($order->orderItems as $item)
                                {{ $item->product->title }} ({{ $item->quantity }} шт.)<br>
                            @endforeach
                        </td>
                        <td>{{ $order->sum }} руб</td>
                        <td>
                            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                                @csrf
                                <select name="status" class="form-control mb-2">
                                    <option value="новое" @if($order->status == 'новое') selected @endif>Новое</option>
                                    <option value="подтверждено" @if($order->status == 'подтверждено') selected @endif>Подтверждено</option>
                                    <option value="отклонено" @if($order->status == 'отклонено') selected @endif>Отклонено</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Обновить статус</button>
                            </form>
                        </td>
                    </tr>
                    
                    
                @endforeach
            </tbody>
        </table>
        <a class="back" href="javascript:history.back()">Назад</a>
    </div>
</div>

@endsection
