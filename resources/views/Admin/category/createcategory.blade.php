@extends('masteradmin')

@section('title')
    Add Category
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-md-5 offset-md-3">
            <h3 class="text text-center text-primary">Add Category</h3>
            <form action="{{ route('category.store') }}" method="POST" class="form-group">
                @csrf
            <table class="table table-borderless">
                <tr>
                    <td>Category Name</td>
                    <td><input type="text" name="name" class="form-control" value="{{ old('name') }}"></td>
                </tr>
                <tr>
                    <td>Parent Category</td>
                    <td>
                        <select name="category_id" id="" class="form-control">
                            <option value="0">No Parent Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>
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
                    <td><input type="submit" value="Add Category" name="addCategory" class="btn btn-primary"></td>
                </tr>
            </table>
        </form>
        </div>
    </div>
@endsection