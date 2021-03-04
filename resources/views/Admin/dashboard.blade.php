@extends('masteradmin')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <h3 class="text-primary mb-3 font-italic">Current Order Dashboard</h3>
        <select name="" id="" class="form-control mb-4 w-25">
            <option value="All Time">All Time</option>
        </select>
        <div class="row">
            <div class="col-md-3 col-xl-2 text-center dash-block">
                <p class="py-5 px-1 text-light h4" style="background-color: #aabd0e;">Pending
                    <br>
                    <span class="text-light bold h3">{{ $pending }}</span>
                </p>
            </div>
            <div class="col-md-3 col-xl-2 text-center dash-block">
                <p class="py-5 px-1 text-light h4" style="background-color: #b870bd;">Accepted
                    <br>
                    <span class="text-light bold h3">{{ $accepted }}</span>
                </p>
            </div>
            <div class="col-md-3 col-xl-2 text-center dash-block">
                <p class="py-5 px-1 text-light h4" style="background-color: #49b387;">Assigned
                    <br>
                    <span class="text-light bold h3">{{ $assigned }}</span>
                </p>
            </div>
            <div class="col-md-3 col-xl-2 text-center dash-block">
                <p class="py-5 px-1 text-light h4" style="background-color: #54984f;">Delivered
                    <br>
                    <span class="text-light bold h3">{{ $delivered }}<span>
                </p>
            </div>
            <div class="col-md-3 col-xl-2 text-center dash-block">
                <p class="py-5 px-1 text-light h4" style="background-color: #0ebd85;">Canceled
                    <br>
                    <span class="text-light bold h3">{{ $canceled }}</span>
                </p>
            </div>
        </div>
    </div>
@endsection