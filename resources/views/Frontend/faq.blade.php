@extends('master')

@section('title')
    Frequently Asked Questions
@endsection

@section('content')
    <div class="container">
        <h3 class="text-primary mb-4">Frequently Asked Questions</h3>
        @php
            $count = 1;
        @endphp
        @foreach ($faqs as $faq)
        <div class="faq">
            <h6 class="text-light bg-primary px-3 py-2"><strong>Question {{ $count }}:</strong> {{ $faq->question }}</h6>
            <p class="bg-navbar text-justify px-3 py-2"><strong>Answer:</strong> {{ $faq->answer }}</p>
        </div>
        <hr>
        @php
            $count++;
        @endphp
        @endforeach
    </div>
@endsection