@extends('master')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row mb-5" style="box-sizing: border-box;">
            <div class="col-md-1">
                @foreach ($product->productimages as $item)
                  <img src="{{ asset('upload/product/image/'.$item->image) }}" alt="" class="simage" width="100%"> <hr>
                @endforeach
            </div>
            <div class="col-md-4 ml-3">
                @php
                    if($product->productimages->count() != 0):
                @endphp 
                <img src="{{ asset('upload/product/image/'.$product->productimages[0]->image) }}" alt="" width="100%" id="Limage">
                @php
                    endif;
                @endphp
            </div>
            <div class="col-md-4 mr-4">
                <h2>{{ $product->name }}</h2>
                <h5>BDT {{ $product->regular_price }}</h5>
                <h5>BDT <del> {{ $product->sale_price }} </del> </h5>
                {{-- <h5>
                    <button>-</button>
                    <input type="text" value="1" class="text-center" style="width: 60px;"> 
                    <button>+</button>
                </h5> --}}
                {{-- <button class="btn btn-primary">Add to Cart</button> --}}
               <div>
                    <input type="hidden" value="{{ $product->id }}" id="productId">
                    <button data-productid="{{ $product->id }}" class="btn btn-primary btn-block addtocart w-75 m-auto">Add to Cart</button>
               </div>
                <hr>
                <p>Category: <span>Science</span></p>
                <p>Description: Lorem, ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus facilis tempora placeat eaque nulla laborum reprehenderit distinctio eveniet perferendis?</p>
            </div>
            <div class="col-md-2">
                <div>
                        Fast Delivery <br>
                        Receive products in amazing time
                </div>
                <hr>
                <div>
                    Easy Returns
                    Return policy that lets you shop at ease
                </div>
                <hr>
                <div>
                    Always Authentic
                    We only sell 100% authentic products
                </div>
            </div>
        </div>
    </div>
    @php
         $carts= json_encode($cartarr);
    @endphp
@endsection

@section('customjs')
    <script>
        $('.simage').click(function(){
           $('#Limage').attr('src', this.src);
        });
       
        var cartaddurl ="{{ route('cart.add') }}";
        var cartupdateurl ="{{ route('cart.update') }}";
        var csrf = '{{ csrf_token() }}';
        var cart = <?php echo $carts; ?>;
    </script>
@endsection