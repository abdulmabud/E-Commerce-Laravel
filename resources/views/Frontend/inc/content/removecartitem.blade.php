<tr>
    <th class="text-left">Product Name</th>
    <th>Unit Price</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Action</th>
</tr>

@foreach ($products as $product)
<tr>
<td class="text-left">{{ $product['name'] }}</td>
    <td>BDT {{ $product['price'] }}</td>
    <td class="text-center">{{ $product['quantity'] }}</td>
    <td class="text-right pr-5" style="width: 15%;">BDT <span class="price">{{ $product['price'] * $product['quantity'] }}</span> </td>
<td><button class="btn btn-danger removeBtn" data-productid="{{ $product['id'] }}" >Remove</button></td>
</tr>
@endforeach

<script>
    // remove item from cart
    removeCart();
</script>
