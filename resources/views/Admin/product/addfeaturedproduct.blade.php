@extends('masteradmin')

@section('title')
    Add Featured Product
@endsection

@section('content')
    <div class="container">
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
                <td>{{ $product->category->name }}</td>
                <td><a href="{{ route('savefproduct', $product->id) }}" class="btn btn-primary">Add as Featured Product</a></td>
            </tr>
            @endforeach
           
        </table>
    </div>
@endsection