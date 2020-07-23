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
                    <tr>
                        <td>Order id</td>
                        <td>{{ $order->id }}</td>
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
        <hr>
        <div class="orderstatus">
            <h3 class="text-center text-primary">Change Order Status</h3>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="" class="form-group" id="statusForm">
                        <table class="table table-bordered">
                            <tr>
                                <td>Select Order Status</td>
                                <td>
                                    <select id="status" class="form-control">
                                        <option value="Pending">Pending</option>
                                        <option value="Accepted">Accepted</option>
                                        <option value="Assigned">Assigned</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Canceled">Canceled</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="hidden" value="{{ $order->id }}" id="order_id"></td>
                                <td><input type="submit" value="Change Status" class="btn btn-primary"></td>
                            </tr>
                        </table>
                    </form>
                    <h5 class="text-center text-primary" id="result"></h5>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection

@section('customjs')
    <script>
        $('#statusForm').submit(function(e){
            e.preventDefault();
            var order_id = $('#order_id').val();
            var status = $('#status').val();
            $.ajax({
                url: '{{ route('order.status.change') }}',
                method: 'POST',
                data: {status: status, _token: '{{ csrf_token() }}'},
                cache: false,
                success: function(data){
                    $('#result').text('Status changed to '+ status);
                }
            });
        });
    </script>
@endsection