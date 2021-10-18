<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Admin Panel</div>
    <div class="list-group list-group-flush">
      <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
      <a href="{{ route('admin.order') }}" class="list-group-item list-group-item-action bg-light">Order</a>
    <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action bg-light">Product</a>
    <a href="{{ route('featuredproduct.index') }}" class="list-group-item list-group-item-action bg-light">Featured Product</a>
      <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action bg-light">Category</a>
      <a href="{{ route('contact.index') }}" class="list-group-item list-group-item-action bg-light">User Contact Us</a>
      <a href="{{ route('faq.index') }}" class="list-group-item list-group-item-action bg-light">FAQ</a>
      <a href="{{ route('setting.index') }}" class="list-group-item list-group-item-action bg-light">Setting</a>
      {{-- <a href="{{ route('logout') }}" class="list-group-item list-group-item-action bg-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a> --}}
      {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> --}}
        @csrf
    </form>
    </div>
  </div>