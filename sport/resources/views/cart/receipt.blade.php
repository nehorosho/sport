<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Чек заказа</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ public_path('fonts/DejaVuSans.ttf') }}') format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .header h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Чек заказа</h1>
            <p>Дата: {{ $order->date }}</p>
        </div>
        <div class="order-details">
            <h2>Детали заказа</h2>
            <p>Номер заказа: {{ $order->id }}</p>
            <p>Способ оплаты: {{ $paymentMethod }}</p>
            <p>Адрес: {{ $address }}</p>
            <p>Комментарий: {{ $comment }}</p>
        </div>
        <table class="order-items">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Итого</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->title }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }} ₽</td>
                        <td>{{ $item->quantity * $item->price }} ₽</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>Спасибо за ваш заказ!</p>
        </div>
    </div>
</body>
</html>