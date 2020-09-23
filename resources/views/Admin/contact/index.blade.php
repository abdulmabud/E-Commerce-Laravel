@extends('masteradmin')

@section('title')
    User Contact Us
@endsection

@section('content')
    <div class="container">
        <h3 class="text-center text-primary">User Contact Details</h3>
        <table class="table table-bordered">
            <tr>
                <td>Contact Id</td>
                <td>Time</td>
                <td>Name</td>
                <td>Subject</td>
                <td>Action</td>
            </tr>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ date_format($contact->created_at, 'h:i a  d-M-y') }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td><a href="{{ route('contact.details', $contact->id) }}" class="btn btn-primary">Details</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection