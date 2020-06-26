@extends('master')

@section('title')
    Cart
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center text-primary">Cart Item List</h2>
        <table class="table table-bordered text-center" id="cartTable">
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
            
        </table>
        <table class="table table-bordered w-50" style="margin-left: 50%;">
            <tr>
                <td>Subtotal Total</td>
                <td class="text-right pr-3">BDT <span class="subTotal"></span></td>
            </tr>
            <tr>
                <td>Delivery Charge</td>
                <td class="text-right pr-3">BDT <span class="deliveryCharge">50.00</span> </td>
            </tr>
            <tr>
                <td>Total Price</td>
                <td class="text-right pr-3">BDT <span class="totalPrice"></span></td>
            </tr>
        </table>
        <div style="margin-bottom: 4rem!important;">
        <a href="{{ route('checkout') }}" class="float-right btn btn-primary w-25 btn-block">Checkout</a>
        </div>
        
    </div>
@endsection

@section('customjs')
    <script>
        var removecartitemurl = "{{ route('cart.removeitem') }}";
        var csrf = '{{ csrf_token() }}';
        // remove item from cart
        removeCart();
       function removeCart(){
        $('.removeBtn').click(function(){
            var product_id = this.dataset.productid;
            console.log(product_id);
            $.ajax({
                url: removecartitemurl,
                method: 'POST',
                data: {productId: product_id, _token: csrf},
                cache: false,
                success: function(data){
                 $('#cartTable').html(data);
                  updatePrice();
                }
            }); 
        })
       }
        updatePrice();
        //update cart page price
        function updatePrice(){
        var sum = 0;
        $('.price').each(function(){
            sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
        });

        var deliveryCharge = parseInt($('.deliveryCharge').text());
        var totalPrice = sum + deliveryCharge;
        totalPrice = totalPrice.toFixed(2);
        sum = sum.toFixed(2);
        $('.subTotal').text(sum);
        $('.totalPrice').text(totalPrice);
        } 
    </script>

@endsection