@extends('masteradmin')

@section('title')
    Setting
@endsection

@section('content')
    <div class="container">
        <table class="table table-bordered w-50">
            <tr>
                <td>Delivery Charge</td>
                <td><input type="text" value="{{ isset($zero_delivery_charge) ?$zero_delivery_charge:$delivery_charge->meta_value }}" id="charge" class="form-control text-center" style="width: 100px;"></td>
                <td><button class="btn btn-primary" id="update-delivery-charge">Update</button></td>
            </tr>
        </table>
        <h4 class="text-primary" id="dresult"></h4>
    </div>
@endsection

@section('customjs')
    <script>
        $('#update-delivery-charge').click(function(){
            var charge = $('#charge').val();
            $.ajax({
                url: '{{ route('setting.delivery.charge') }}',
                method: 'POST',
                data: { charge: charge, _token: '{{ csrf_token() }}' },
                cache: false,
                success: function(data){
                   $('#dresult').text('Delivery Charge set '+charge);
                }
            });
        });
    </script>
@endsection