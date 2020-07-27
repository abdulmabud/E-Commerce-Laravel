@extends('masteradmin')

@section('title')
{{ $category->name }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-primary text-center my-3">{{ $category->name }} Details</h2>
            <table class="table table-bordered mt-3">
                <tr>
                    <td style="min-width: 150px;">Category Id</td>
                     <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <td>Category Name</td>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <td>Category Slug</td>
                    <td>{{ $category->slug }}</td>
                </tr>
                <tr>
                    <td>Parent Category</td>
                    <td>{{ $aa == 1 ? 'No Parent Category' : $categoryName->name }}</td>
                </tr>
            
                <tr>
                    <td>Status</td>
                    <td>{{ $category->status == 1 ? 'Publish' : 'Unpublish' }}</td>
                </tr>
                <tr>
                    <td><a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary">Edit Category</a></td>
                  <td>
                    <form action="{{ route('category.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete Category">
                   </form>
                  </td>
                    
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
