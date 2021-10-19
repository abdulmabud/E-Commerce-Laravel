@extends('master')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
        <div class="container">
            <h2 class="text-primary text-center my-4">{{ $category->name }}</h2>
            <div class="row">
                @foreach ($category->products as $product)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="{{ asset('upload/product/image/'.$product->productimages[0]->image) }}" height="170px" alt="Product Image"></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{ route('product.details', $product->id) }}">{{  $product->name   }}</a>
                        </h4>
                        <h5 class="d-inline"><del>BDT {{ $product->regular_price }}</del></h5>
                        <h5 class="d-inline">BDT {{ $product->sale_price }}</h5>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" value="{{ $product->id }}" id="productId">
                        {{-- <button data-productid="{{ $product->id }}" class="btn btn-primary btn-block addtocart">Add to Cart</button> --}}
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
