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
                    <td>Product Id</td>
                    <td>Product Name</td>
                    <td>Unit Price</td>
                    <td>Quantity</td>
                    <td>Total Price</td>
                </tr>
                <tr>
                    <td>32</td>
                    <td>Jsdfsf Udsf</td>
                    <td>434.33</td>
                    <td>3</td>
                    <td>3232.34</td>
                </tr>
            </table>
            <table class="table table-bordered w-50 ml-auto">
                <tr>
                    <td>Subtotal</td>
                    <td>BDT 434.34</td>
                </tr>
                <tr>
                    <td>Delivery Charge</td>
                    <td>BDT 44.34</td>
                </tr>
                <tr>
                    <td>Total Price</td>
                    <td>BDT 3344.34</td>
                </tr>
            </table>
        </div>
    </div>
@endsection