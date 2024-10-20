@extends('layouts.master')

@section('title', 'orders')

@section('main-content')


@if ($orders->isEmpty())
    <p>You have no orders yet.</p>
@else
<table class="table">
<thead>
    <th>Order ID </th>
    <th>Total Price </th>
    <th>Status</th>
    <th>Date </th>
</thead>

<tbody>
    @foreach ($orders as $order )

    
    <tr>

        <td>{{ $order->id }}</td>
        <td>${{$order->total_price }}</td>
        <td>{{ ucfirst($order->status) }}</td>
        <td>{{ $order->created_at->format('d/m/y') }}</td>
    </tr>
    @endforeach
</tbody>
</table>
@endif
@endsection
