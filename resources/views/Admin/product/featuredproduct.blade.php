@extends('masteradmin')

@section('title')
    Featured Product
@endsection

@section('content')
<div class="container">
    <div class="mt-3">
        <h3 class="text-center my-3 text-primary d-inline">Featured Product List</h3>
        <p class="d-inline"><a href="" class="float-right mr-5 btn btn-primary">Add Featured Product</a></p>
    </div>
          
    <table class="table table-bordered mt-3">
        <tr>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        @foreach ($featuredproducts as $product)
        <tr>
            <td>{{ $product->product->id }}</td>
            <td>{{ $product->product->name }}</td>
            <td>BDT {{ $product->product->regular_price }} <del class="ml-3">BDT  {{ $product->product->sale_price }}</del> </td>
            <td>{{ $product->product->category->name }}</td>
            <td><a href="{{ route('product.show', $product->product->id) }}" class="btn btn-primary">Details</a></td>
        </tr>
        @endforeach
       
    </table>
</div>
@endsection