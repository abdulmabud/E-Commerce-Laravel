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
                <td><button class="btn btn-primary">Details</button></td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection