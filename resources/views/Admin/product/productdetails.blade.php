@extends('masteradmin')

@section('title')
{{ $product->name }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-primary text-center my-3">{{ $product->name }} Details</h2>
            <table class="table table-bordered mt-3">
                <tr>
                    <td>Product Id</td>
                     <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <td>Product Name</td>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <td>Regular Price</td>
                    <td>BDT {{ $product->regular_price }}</td>
                </tr>
                <tr>
                    <td>Sale Price</td>
                    <td>BDT {{ $product->sale_price }}</td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>{{ $product->category_id }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $product->status }}</td>
                </tr>
                <tr>
                    <td><a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">Edit Product</a></td>
                  <td>
                    <form action="{{ route('product.destroy', $product->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete Product">
                   </form>
                  </td>
                    
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
