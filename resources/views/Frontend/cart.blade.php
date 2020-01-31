@extends('master');

@section('title')
    Cart
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center text-primary">Cart Item List</h2>
        <table class="table table-bordered text-center">
            <tr>
                <th class="text-left">Product Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            @foreach ($products as $product)
            <tr>
            <td class="text-left">{{ $product['name'] }}</td>
                <td>BDT {{ $product['price'] }}</td>
                <td class="text-center">{{ $product['quantity'] }}</td>
                <td class="text-right pr-5" style="width: 15%;">BDT {{ $product['price'] * $product['quantity'] }}</td>
            </tr>
            @endforeach
            
        </table>
        <table class="table table-bordered w-50" style="margin-left: 50%;">
            <tr>
                <td>Subtotal Total</td>
                <td>BDT 443.34</td>
            </tr>
            <tr>
                <td>Delivery Charge</td>
                <td>BDT 50.00</td>
            </tr>
            <tr>
                <td>Total Price</td>
                <td>BDT 334.34</td>
            </tr>
        </table>
        <div style="margin-bottom: 4rem!important;">
        <a href="{{ route('checkout') }}" class="float-right btn btn-primary w-25 btn-block">Checkout</a>
        </div>
        
    </div>
@endsection