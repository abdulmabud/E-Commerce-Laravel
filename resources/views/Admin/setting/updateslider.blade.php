@extends('masteradmin')

@section('title')
    Update Slider
@endsection

@section('customcss')
    <style>
        .slideimg{
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }
        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
            }

            .con:hover .slideimg {
            opacity: 0.3;
            }

            .con:hover .middle {
            opacity: 1;
            }
       
    </style>
@endsection

@section('content')
    <div class="container">
       <div class="row">
           <div class="col-md-6 offset-md-3">
            <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data" class="form-group">
                @csrf
                <table class="table">
                    <tr>
                        <td>Select Image</td>
                        <td><input type="file" name="slider" class="form-control"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Upload New Slider Image" class="btn btn-primary"></td>
                    </tr>
                </table>
                <h6 class="text-center text-danger">* Image size must be 1200*350px</h6>
            </form>
           </div>
       </div>
       <h3 class="text-light bg-primary p-2 text-center mb-4 w-75 mx-auto" style="border-radius: 10px;">Currently Active Slider</h3>
       @foreach ($slider_images as $image)
            <div class="row">
                <div class="col-md-6 offset-md-3 con">
                    <img src="{{ asset('upload/slider/'.$image->meta_value) }}" width="50%" alt="no image" class="slideimg">
                    <div class="middle">
                        <form action="{{ route('slider.remove', $image->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Remove This Slider">
                        </form>
                    </div>
                    <hr><hr>
                  </div>
            </div>
       @endforeach
    </div>
@endsection