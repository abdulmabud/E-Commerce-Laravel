@extends('masteradmin')

@section('title')
    Update Product
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-md-5 offset-md-3">
            <h3 class="text text-center text-primary">Update Product</h3>
            <form action="{{ route('product.update', $product->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <table class="table table-borderless">
                <tr>
                    <td>Product Name</td>
                    <td><input type="text" name="name" class="form-control" value="{{ $product->name }}"></td>
                </tr>
                <tr>
                    <td>Regular Price</td>
                    <td><input type="text" name="regular_price" class="form-control" value="{{ $product->regular_price }}"></td>
                </tr>
                <tr>
                    <td>Sale Price</td>
                    <td><input type="text" name="sale_price" class="form-control" value="{{ $product->sale_price }}"></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category_id" id="" class="form-control">
                            @foreach ($categories as $category)
                                <option {{ $product->category_id == $category->id ? "selected" :'not' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Thumbnail Image</td>
                    <td><input type="file" name="thumbnail_image"></td>
                </tr>
                {{-- <tr>
                    <td>Image</td>
                    <td><input type="file" name="image[]" multiple></td>
                </tr> --}}
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="" class="form-control">
                            <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Publish</option>
                            <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Unpublish</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Update Product" name="updateProduct" class="btn btn-primary"></td>
                </tr>
            </table>
        </form>
        </div>
    </div>
@endsection