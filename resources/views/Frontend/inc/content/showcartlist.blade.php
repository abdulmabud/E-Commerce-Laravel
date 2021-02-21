<table class="table table-bordered">
    <thead>
        <tr>
            <td>Name</td>
            <td class="text-center">Quantity</td>
            <td class="text-center">Price</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product['name'] }}</td>
            <td class="text-center">{{ $product['quantity'] }}</td>
            <td class="text-right">BDT {{ number_format($product['price'], 2) }}</td>
        </tr>
    @endforeach
    </tbody>
  
</table>