@extends('master')

@section('title')
    Checkout
@endsection

@section('content')
<div class="container">
    <div class="py-5 text-center">
      <h2>Checkout form</h2>
    </div>

    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your cart</span>
          <span class="badge badge-secondary badge-pill">{{ count($products) }}</span>
        </h4>
        <ul class="list-group mb-3">
          @foreach ($products as $product)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">{{ $product['name'] }}</h6>
                <small class="text-muted">(Quantity) {{ $product['quantity'] }} <span> * (Unit Price)</span> {{ $product['price'] }} </small>
              </div>
              <span class="text-muted">BDT <span class="price">{{ number_format($product['price'] * $product['quantity'], 2) }}</span></span>
            </li>
          @endforeach
          <li class="list-group-item d-flex justify-content-between lh-condensed" style="font-weight: 500;">Subtotal <span>BDT <span class="subTotal"></span> </span></li>
          <li class="list-group-item d-flex justify-content-between lh-condensed" style="font-weight: 500;">Delivery Charge<span>BDT <span class="deliveryCharge">50.00</span> </span></li>
          <li class="list-group-item d-flex justify-content-between lh-condensed" style="font-weight: 500;">Total Price <span>BDT <span class="totalPrice"></span> </span></li>
          
        </ul>

        <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <div class="input-group-append">
              <button type="submit" class="btn btn-secondary">Redeem</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-8 order-md-1 mb-4">
        <h4 class="mb-3">Billing address</h4>
        <form class="needs-validation" novalidate>
          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="firstName">Name</label>
              <input type="text" class="form-control" name="fullname" placeholder="" value="" required> 
            </div>
          </div>

          <div class="mb-3">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" placeholder="+8801700111222">
          </div>
          <div class="mb-3">
            <label for="email">Email <span class="text-muted">(Optional)</span></label>
            <input type="email" class="form-control" name="email" placeholder="you@example.com">
          </div>

          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" required>
        
          </div>

          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
        </form>
      </div>
    </div>
</div>
@endsection

@section('customjs')
<script>
  var sum = 0;
      $('.price').each(function(){
          sum += parseFloat($(this).text().replace(',', ''));  // Or this.innerHTML, this.innerText
      });

      var deliveryCharge = parseInt($('.deliveryCharge').text());
      var totalPrice = sum + deliveryCharge;
      totalPrice = totalPrice.toFixed(2);
      sum = sum.toFixed(2);
      $('.subTotal').text(sum);
      $('.totalPrice').text(totalPrice); 
  </script>
@endsection