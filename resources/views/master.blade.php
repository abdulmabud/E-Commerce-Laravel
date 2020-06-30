<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>

  <!-- Bootstrap core CSS -->
<link href="{{ asset('custom/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom styles for this template -->
<link href="{{ asset('custom/css/shop-homepage.css') }}" rel="stylesheet">
<link href="{{ asset('custom/css/custom.css') }}" rel="stylesheet">
@yield('customcss')
</head>

<body>

 @include('frontend.inc.menu')
  @include('frontend.inc.message')
  @yield('content')
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Abdul Mabud 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
<script src="{{ asset('custom/js/jquery.min.js') }}"></script>
  <script src="{{ asset('custom/js/bootstrap.bundle.min.js') }}"></script>
  <script>
    var cartitemcounturl = "{{ route('cart.count') }}";
    var csrf = '{{ csrf_token() }}';
  </script>
  <script src="{{ asset('custom/js/custom.js') }}"></script>
@yield('customjs')
</body>

</html>