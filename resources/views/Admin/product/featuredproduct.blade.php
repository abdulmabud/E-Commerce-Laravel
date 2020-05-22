@extends('masteradmin')

@section('title')
    Featured Product
@endsection

@section('content')
<div class="container">
    <div class="mt-3">
        <h3 class="text-center my-3 text-primary d-inline">Featured Product List</h3>
        <p class="d-inline"><button class="float-right mr-5 btn btn-primary addfproductBtn">Add Featured Product</button></p>
    </div>
    <div class="addfproductbox">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <form action="{{ route('addfproduct') }}" method="post" class="form-group">
                    @csrf
                    <input type="text" name="productName" class="form-control mb-4">
                    <input type="submit" value="Search Product" class="btn btn-primary btn-block">
                </form>
            </div>      
        </div>
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
            <td><del class="ml-3">BDT  {{ $product->product->sale_price }}</del> BDT {{ $product->product->regular_price }} </td>
            <td>{{ $product->product->category->name }}</td>
            <td><a href="{{ route('product.show', $product->product->id) }}" class="btn btn-primary">Details</a>
            <form action="{{ route('fproduct.delete', $product->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <input type="submit" value="Remove" class="btn btn-danger">
            </form>
            
            </td>
        </tr>
        @endforeach
       
    </table>
</div>
@endsection

@section('customjs')
    <script>
        $('.addfproductbox').css('display', 'none');
        $('.addfproductBtn').click(function(){
            $('.addfproductbox').css('display', 'block'); 
        });
        
    </script>
@endsection