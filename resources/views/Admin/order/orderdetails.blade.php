@extends('masteradmin')

@section('title')
    Order Details
@endsection

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <table class="table table-bordered">
                    <tr>
                        <td>Name</td>
                        <td>{{ $order->user_name }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $order->user_phone }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $order->user_email }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $order->address }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="productList mt-4">
            <table class="table table-bordered">
                <tr>
                    <th>Product Name</th>
                    <th>Unit Price</th>
                    <th class="text-center">Quantity</th>
                    <th>Total Price</th>
                </tr>
                @foreach ($orders as $orderitem)
                <tr>
                    <td>{{ $orderitem->product_name }}</td>
                    <td>BDT {{ $orderitem->unit_price }}</td>
                    <td class="text-center">{{ $orderitem->quantity }}</td>
                    <td>BDT {{ $orderitem->unit_price * $orderitem->quantity }}</td>
                </tr>
                @endforeach
               
            </table>
            <table class="table table-bordered w-50 ml-auto">
                <tr>
                    <td>Subtotal</td>
                    <td>BDT {{ $order->subtotal }}</td>
                </tr>
                <tr>
                    <td>Delivery Charge</td>
                    <td>BDT {{ $order->delivery_charge }}</td>
                </tr>
                <tr>
                    <td>Total Price</td>
                    <td>BDT {{ $order->total_price }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection