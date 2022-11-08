<html>

<head>

</head>

<body>
    <h2>Tracking No: {{ $order_data['tracking_no'] }}</h2>
    <h4>Name: {{ $order_data['name'] }}</h4>
    <h4>Phone: {{ $order_data['phone'] }}</h4>
    <h4>Address: {{ $order_data['address'] }}</h4>
    <h4>District: {{ $order_data['district'] }}</h4>
    <h4>Province: {{ $order_data['province'] }}</h4>
    <h4>City: {{ $order_data['city'] }}</h4>
    <h4>Payment: {{ $order_data['payment_mode'] }}</h4>
    <hr>
    <table cellpadding='5px' cellspacing='5px' border="1">
        <thead>
            <tr>
                <th>Product name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Color</th>
                <th>Size</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
                $shipping_fee = 30000;
            @endphp
            @foreach ($items_in_cart as $item)
                <tr>
                    <td>{{ $item->products->name }}</td>
                    <td>{{ $item->product_qty }}</td>
                    <td>
                        @if ($item->products->sale_price > 0)
                            {{ number_format($item->products->sale_price) }}
                        @else
                            {{ number_format($item->products->original_price) }}
                        @endif
                         vnd
                    </td>
                    <td>{{ $item->color }}</td>
                    <td>{{ $item->size }}</td>
                </tr>
                @if ($item->products->sale_price > 0)
                    @php
                        $total += $item->products->sale_price * $item->product_qty + $shipping_fee;
                    @endphp
                @else
                    @php
                        $total += $item->products->original_price * $item->product_qty + $shipping_fee;
                    @endphp
                @endif
            @endforeach
            <tr>
                <td colspan="2">Grand total: </td>
                <td>{{ number_format($total) }} vnd</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
