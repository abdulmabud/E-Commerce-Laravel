@extends('masteradmin')

@section('title')
    All FAQ
@endsection

@section('content')
    <div class="container">
        <div class="mt-3">
            <h3 class="text-center my-3 text-primary d-inline">FAQ List</h3>
            <p class="d-inline"><a href="{{ route('faq.create') }}" class="float-right mr-5 btn btn-primary">Add Faq</a></p>
        </div>
              
        <table class="table table-bordered mt-3">
            <tr>
                <th>FAQ Id</th>
                <th>Question</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @foreach ($faqs as $faq)
            <tr>
                <td>{{ $faq->id }}</td>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->status == 1 ? 'Publish' : 'Unpublish' }}</td>
                <td><a href="{{ route('faq.show', $faq->id) }}" class="btn btn-primary">Details</a></td>
            </tr>
            @endforeach
           
        </table>
    </div>
@endsection