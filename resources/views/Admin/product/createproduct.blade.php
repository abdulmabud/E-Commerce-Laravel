@extends('masteradmin')

@section('title')
    Add Product
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-md-5 offset-md-3">
            <h3 class="text text-center text-primary">Add Product</h3>
            <form action="{{ route('product.store') }}" method="POST" class="form-group" enctype="multipart/form-data">
                @csrf
            <table class="table table-borderless">
                <tr>
                    <td>Product Name</td>
                    <td><input type="text" name="name" class="form-control" value="{{ old('name') }}"></td>
                </tr>
                <tr>
                    <td>Regular Price</td>
                    <td><input type="text" name="regular_price" class="form-control" value="{{ old('regular_price') }}"></td>
                </tr>
                <tr>
                    <td>Sale Price</td>
                    <td><input type="text" name="sale_price" class="form-control" value="{{ old('sale_price') }}"></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category_id" id="" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Thumbnail Image</td>
                    <td><input type="file" name="thumbnail_image"></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td><input type="file" name="image[]" multiple></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="" class="form-control">
                            <option value="1">Publish</option>
                            <option value="0">Unpublish</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Add Product" name="addProduct" class="btn btn-primary"></td>
                </tr>
            </table>
        </form>
        </div>
    </div>
@endsection