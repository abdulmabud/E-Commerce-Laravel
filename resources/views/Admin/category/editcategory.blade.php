@extends('masteradmin')

@section('title')
    Edit Category
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-md-5 offset-md-3">
            <h3 class="text text-center text-primary">Edit Category</h3>
            <form action="{{ route('category.update', $category->id) }}" method="POST" class="form-group">
                @csrf
                @method('PUT')
            <table class="table table-borderless">
                <tr>
                    <td>Category Name</td>
                    <td><input type="text" name="name" class="form-control" value="{{ $category->name }}"></td>
                </tr>
                <tr>
                    <td>Parent Category</td>
                    <td>
                        <select name="category_id" id="" class="form-control">
                            <option value="0">No Parent Category</option>
                            @foreach ($categories as $scategory)
                                <option {{ $category->category_id == $scategory->id ? 'selected' : ''}}  value="{{ $scategory->id }}">{{ $scategory->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="" class="form-control">
                            <option {{ $category->staus == 1 ? 'selected' : '' }} value="1">Publish</option>
                            <option {{ $category->staus == 0 ? 'selected' : '' }} value="0">Unpublish</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Update Category" name="updateCategory" class="btn btn-primary"></td>
                </tr>
            </table>
        </form>
        </div>
    </div>
@endsection