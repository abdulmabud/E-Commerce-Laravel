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
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{ route('product.details', $product->id) }}">{{  $product->name   }}</a>
                        </h4>
                        <h5 class="d-inline"><del>BDT {{ $product->sale_price }}</del></h5>
                        <h5 class="d-inline">BDT {{ $product->regular_price }}</h5>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" value="{{ $product->id }}" id="productId">
                        <button data-productid="{{ $product->id }}" class="btn btn-primary btn-block addtocart">Add to Cart</button>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
@endsection
