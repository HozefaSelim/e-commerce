<h1>Hello {{ $user->name }}</h1>
<h3>Your order Has been taken succssfully and the price is {{ $order->total_price }}</h3>
<p>Please keep shopping </p>
<a href="{{ url('/en/products') }}">Visit Our Store</a>