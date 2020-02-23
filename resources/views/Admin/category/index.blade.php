@extends('masteradmin')

@section('title')
    Category List
@endsection

@section('content')
    <div class="container">
        <div class="mt-3">
            <h3 class="text-center my-3 text-primary d-inline">Category List</h3>
            <p class="d-inline"><a href="{{ route('category.create') }}" class="float-right mr-5 btn btn-primary">Add Category</a></p>
        </div>
              
        <table class="table table-bordered mt-3">
            <tr>
                <th>Category Id</th>
                <th>Category Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->status == 1 ? 'Publish' : 'Unpublish' }}</td>
                <td><a href="{{ route('category.show', $category->id) }}" class="btn btn-primary">Details</a></td>
            </tr>
            @endforeach
           
        </table>
    </div>
@endsection