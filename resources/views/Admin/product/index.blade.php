@extends('masteradmin')

@section('title')
    Product List
@endsection

@section('content')
    <div class="container">
        <div class="mt-3">
            <h3 class="text-center my-3 text-primary d-inline">Product List</h3>
            <p class="d-inline"><a href="{{ route('product.create') }}" class="float-right mr-5 btn btn-primary">Add Product</a></p>
        </div>
              
        <table class="table table-bordered mt-3">
            <tr>
                <th>Product Id</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>BDT {{ $product->regular_price }} <del class="ml-3">BDT  {{ $product->sale_price }}</del> </td>
                <td>{{ $product->category_id }}</td>
                <td><a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Details</a></td>
            </tr>
            @endforeach
           
        </table>
    </div>
@endsection