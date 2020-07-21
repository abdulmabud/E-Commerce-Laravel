<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Admin Panel</div>
    <div class="list-group list-group-flush">
      <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
      <a href="{{ route('admin.order') }}" class="list-group-item list-group-item-action bg-light">Order</a>
    <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action bg-light">Product</a>
    <a href="{{ route('featuredproduct.index') }}" class="list-group-item list-group-item-action bg-light">Featured Product</a>
      <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action bg-light">Category</a>
      <a href="{{ route('setting.index') }}" class="list-group-item list-group-item-action bg-light">Setting</a>
    </div>
  </div>