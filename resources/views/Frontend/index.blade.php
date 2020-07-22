@extends('master')

@section('title')
  E-Commerce Laravel
@endsection

@section('content')
<div class="container">

    <div class="row">


      <div class="col-lg-12">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            @foreach ($slider_images as $image)
          <div class="carousel-item {{ $active == 1 ? 'active':'' }}">
              <img class="d-block img-fluid" src="{{ asset('upload/slider/'.$image->meta_value) }}" alt="First slide">
            </div>
            {{ $active = 2 }}
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
              <button data-productid="{{ $product->product->id }}" class="btn btn-primary btn-block addtocart">Add to Cart</button>
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
              <button data-productid="{{ $product->id }}" class="btn btn-primary btn-block addtocart">Add to Cart</button>
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
      var cart = <?php echo $carts; ?>;
  
    </script>
@endsection