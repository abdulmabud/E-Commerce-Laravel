@extends('masteradmin')

@section('title')
{{ $faq->question }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-primary text-center my-3">FAQ Details</h2>
            <table class="table table-bordered mt-3">
                <tr>
                    <td class="w-25">FAQ Id</td>
                     <td>{{ $faq->id }}</td>
                </tr>
                <tr>
                    <td>Question</td>
                    <td>{{ $faq->question }}</td>
                </tr>
                <tr>
                    <td>Answer</td>
                    <td>{{ $faq->answer }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $faq->status == 1 ? 'Publish':'Unpublish' }}</td>
                </tr>
                <tr>
                    <td><a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-primary">Edit FAQ</a></td>
                  <td>
                    <form action="{{ route('faq.destroy', $faq->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete FAQ">
                   </form>
                  </td>
                    
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
