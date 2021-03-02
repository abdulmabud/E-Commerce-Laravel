@extends('masteradmin')

@section('title')
    Order List
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3 class="text-primary">Order Filter By</h3>
                    <select id="filterby" class="form-control">
                        <option value="All">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Accepted">Accepted</option>
                        <option value="Assigned">Assigned</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Canceled">Canceled</option>
                    </select>
                    <br>
            </div>
        </div>
        <table class="table table-bordered" id="ordertable">
            <tr>
                <th>Order Id</th>
                <th>Time</th>
                <th>Customer Name</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->user_name }}</td>
                <td>{{ $order->total_price }}</td>
                <td>@foreach ($order->orderstatuses as $item)
                        @php
                            $status = $item['status'];
                        @endphp                  
                    @endforeach
                    @php
                       echo $status;
                    @endphp
                </td>
            <td><a href="{{ route('admin.order.details', $order->id) }}" class="btn btn-primary">Details</a></td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection

@section('customjs')
    <script>
        $('#filterby').change(function(){
            var filterby = $('#filterby').val();
        var csrf = '{{ csrf_token() }}';
            $.ajax({
                url: "/admin/orderfilter",
                method: 'POST',
                data: {_token: csrf, filterby: filterby},
                cache: false,
                success: function(data){
                    $('#ordertable').html(data);
                }
            });
        });
    </script>
@endsection