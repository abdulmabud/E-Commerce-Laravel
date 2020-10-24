@extends('master')

@section('title')
  E-Commerce Laravel
@endsection

@section('content')
    <div class="slider" style="margin-top: -25px;">
      <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          @foreach ($slider_images as $image)
        <div class="carousel-item {{ $active == 1 ? 'active':'' }}">
            <img class="d-block img-fluid" src="{{ asset('upload/slider/'.$image->meta_value) }}" width="100%" alt="First slide">
          </div>
          @php
              $active = 2;
          @endphp
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
<div class="container">

    <div class="row">
      <div class="col-lg-12">
        @php
            if($fproducts->count() != 0){
              echo '<h2>Featured Product</h2>';
            }
        @endphp
        <div class="row">
          @foreach ($fproducts as $product)
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
              <a href="{{ route('product.details', $product->product->id) }}"><img class="card-img-top" src="{{  count($product->product->productimages) > 0 ?  asset('/upload/product/image/'.$product->product->productimages[0]->image) : asset('/upload/product/image/noImage.PNG') }}" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="{{ route('product.details', $product->product->id) }}">{{  $product->product->name   }}</a>
                </h4>
                <h5 class="d-inline"><del>BDT {{ $product->product->regular_price }}</del></h5>
                <h5 class="d-inline">BDT {{ $product->product->sale_price }}</h5>
              </div>
              <div class="card-footer">
                <input type="hidden" value="{{ $product->product->id }}" id="productId">
               @if ($isCartEmpty)
               <button data-productid="{{ $product->product->id }}" class="btn btn-primary btn-block addtocart">Add to Cart</button>
               @else
                  @if (array_key_exists($product->product->id, $cartarr['products']))
                    <h5 class="addtocartQuantity" style="text-align: center;"><button class="minus-btn" data-minusbtn = {{ $product->product->id }}>-</button> <input type="text" value="1" id="q{{ $product->product->id }}" class="text-center" style="width: 60px;">  <button class="plus-btn" data-plusbtn="{{ $product->product->id }}">+</button> </h5>
                  @else
                    <button data-productid="{{ $product->product->id }}" class="btn btn-primary btn-block addtocart">Add to Cart</button>
                  @endif
               @endif
              </div>
            </div>
          </div>
          @endforeach
        </div>
      
        <h2>New Arrival</h2>
        <div class="row">

          @foreach ($products as $product)
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
              <a href="{{ route('product.details', $product->id) }}"><img class="card-img-top" src="{{  count($product->productimages) > 0 ?  asset('/upload/product/image/'.$product->productimages[0]->image) : asset('/upload/product/image/noImage.PNG') }}" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="{{ route('product.details', $product->id) }}">{{  $product->name   }}</a>
                </h4>
                <h5 class="d-inline"><del>BDT {{ $product->regular_price }}</del></h5>
                <h5 class="d-inline">BDT {{ $product->sale_price }}</h5>
              </div>
              <div class="card-footer">
                <input type="hidden" value="{{ $product->id }}" id="productId">
               @if ($isCartEmpty)
                 <button data-productid="{{ $product->id }}" class="btn btn-primary btn-block addtocart">Add to Cart</button>
               @else
                  @if (array_key_exists($product->id, $cartarr['products']))
                    <h5 class="addtocartQuantity" style="text-align: center;"><button class="minus-btn" data-minusbtn = {{ $product->id }}>-</button> <input type="text" value="1" id="q{{ $product->id }}" class="text-center" style="width: 60px;">  <button class="plus-btn" data-plusbtn="{{ $product->id }}">+</button> </h5>
                  @else
                    <button data-productid="{{ $product->id }}" class="btn btn-primary btn-block addtocart">Add to Cart</button>
                  @endif
               @endif
              </div>
            </div>
          </div>
          @endforeach
          

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
 @php
     $carts= json_encode($cartarr);
 @endphp
@endsection

@section('customjs')
    <script>
      var cartaddurl ="{{ route('cart.add') }}";
      var cartupdateurl ="{{ route('cart.update') }}";
      var csrf = '{{ csrf_token() }}';
      var singlecartcount = "{{ route('cart.scount') }}";
      var cart = <?php echo $carts; ?>;
    </script>
@endsection