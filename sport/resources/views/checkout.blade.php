@extends('layout.layouts')
@section('title', 'Оформление заказа')
@section('content')

<div class="content_row">
    <div class="content_column">
        <h2>Оформление заказа</h2>
        <br>
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <div class="form_group">
                <label for="payment_method">Выберите метод оплаты:</label>
                <select name="payment_method" id="payment_method">
                    <option value="cash">Наличные</option>
                    <option value="card">Безналичный расчет</option>
                </select>
            </div>
            <div class="form_group">
                <label for="delivery_address">Адрес доставки:</label>
                <input type="text" name="delivery_address" id="delivery_address">
            </div>
            <div class="form_group">
                <label for="comment">Комментарий к заказу:</label>
                <textarea name="comment" id="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn-new">Оформить заказ</button>
        </form>
        
        <a class="back" href="javascript:history.back()">Назад</a>
    </div>
</div>
@endsection
