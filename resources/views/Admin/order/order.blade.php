@extends('masteradmin')

@section('title')
    Order List
@endsection

@section('content')
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>Order Id</th>
                <th>Time</th>
                <th>Customer Name</th>
                <th>Total Amount</th>
                <th>Action</th>
            </tr>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->user_name }}</td>
                <td>{{ $order->total_price }}</td>
            <td><a href="{{ route('admin.order.details', $order->id) }}" class="btn btn-primary">Details</a></td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection