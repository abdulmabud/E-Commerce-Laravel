@extends('master')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <h2 class="text-primary text-center my-3">{{ $user->name }} Account</h2>
    <h5 class="text-primary">Billing Address</h5>
        <table class="table table-bordered">
            <tr>
                <td>Name</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ $user->phone }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $user->address }}</td>
            </tr>
        </table>
        <hr><hr>
        <h5 class="text-primary">My Orders</h5>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <td>Date</td>
                    <td>Order No.</td>
                    <td>Amount</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr class="text-center">
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->id }}</td>
                    <td>BDT {{ number_format($order->subtotal+$order->delivery_charge, 2) }}</td>
                    <td><a href="{{ route('myaccount.orderdetails', $order->id) }}"><button class="btn btn-primary">Details</button></a></td>
                </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
@endsection