@extends('masteradmin')

@section('title')
    Contact Details
@endsection

@section('content')
    <div class="container">
        <h3 class="text-center text-primary">Contact Details</h3>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <table class="table table-bordered">
                    <tr>
                        <td>Name</td>
                        <td>{{ $contact->name }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $contact->phone }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $contact->email }}</td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>{{ $contact->subject }}</td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>{{ $contact->message }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection