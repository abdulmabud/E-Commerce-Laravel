@extends('masteradmin')

@section('title')
    Update FAQ
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
            <h3 class="text text-center text-primary">Update FAQ</h3>
            <form action="{{ route('faq.update', $faq->id) }}" method="POST" class="form-group">
                @csrf
                @method('PUT')
            <table class="table table-borderless">
                <tr>
                    <td>Question</td>
                    <td><input type="text" name="question" class="form-control" value="{{ $faq->question }}"></td>
                </tr>
                <tr>
                    <td>Answer</td>
                    <td><textarea name="answer" rows="5" class="form-control">{{ $faq->answer }}</textarea></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="" class="form-control">
                            <option {{ $faq->status == 1 ? 'Selected':'' }} value="1">Publish</option>
                            <option {{ $faq->status == 0 ? 'Selected':'' }} value="0">Unpublish</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Update FAQ" name="addFaq" class="btn btn-primary btn-block"></td>
                </tr>
            </table>
        </form>
        </div>
    </div>
@endsection