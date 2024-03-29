 <!-- Navigation -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
     <div class="container">
         <a class="navbar-brand" href="{{ route('homepage') }}">E-Commerce</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
             aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarResponsive">
             <ul class="navbar-nav ml-auto">
                 <li class="nav-item active">
                     <a class="nav-link" href="{{ route('homepage') }}">Home
                         <span class="sr-only">(current)</span>
                     </a>
                 </li>
                 <div class="dropdown show">
                     <li class="nav-item">
                         <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                             aria-expanded="false">Category</a>
                         <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                             @foreach ($categories as $category)
                             <a class="dropdown-item"
                                 href="{{ route('category.product', $category->slug) }} ">{{  $category->name   }}</a>
                             @endforeach

                         </div>
                     </li>
                 </div>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('cart.show') }}">Cart
                         <span id="countCart"></span>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                 </li>
                 @guest
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                 </li>
                 @if (Route::has('register'))
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                 </li>
                 @endif
                 @else
                 <li class="nav-item dropdown">
                     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                         {{ Auth::user()->name }} <span class="caret"></span>
                     </a>

                     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                         <a class="dropdown-item" href="{{ route('myaccount') }}">My Account</a>
                         <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                     </div>
                 </li>
                 @endguest
             </ul>
         </div>
     </div>
 </nav>
