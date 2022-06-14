<h3>جزئیات سفارش</h3>

سفارش شمابا شماره {{ $order->id }}
ثبت شد.

<ul>
    @foreach($order->products as $product)
        <li>{{ $product->title }}</li>
        @endforeach
</ul>
