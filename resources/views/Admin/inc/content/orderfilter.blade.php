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
    <td>{{ $order->order->id }}</td>
    <td>{{ $order->order->created_at }}</td>
    <td>{{ $order->order->user_name }}</td>
    <td>{{ $order->order->total_price }}</td>
    <td>
       {{ $order->status }}
    </td>
<td><a href="{{ route('admin.order.details', $order->order->id) }}" class="btn btn-primary">Details</a></td>
</tr>
@endforeach