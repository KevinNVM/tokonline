<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>order list</title>
</head>

<body>
    @foreach ($orders as $order)
        <ul>
            <li>Order ID : {{ $order->number }}</li>
            <li>Total Price : {{ $order->total_price }}</li>
            <li>
                <a href="/orders/{{ $order->number }}">
                    Details
                </a>
            </li>
        </ul>
    @endforeach
</body>

</html>
