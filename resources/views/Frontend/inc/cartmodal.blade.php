<div class="container">
    <!-- Button trigger modal -->
   
    <div class="carticon">
        <div data-toggle="modal" data-target="#exampleModal">
        <p id="iconcartp">
          <span class="text-center" id="iconcart">0</span>
          <img src="{{ asset('/custom/img/carticon1.png') }}" alt="">
        </p>
    </div>
      </div>


   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Cart Product List</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
           </div>
           <div class="modal-body" id="cartlistbody">
               
            </div>
           <div class="modal-footer">
                <a href="{{ route('cart.show') }}" class="btn w-25 m-auto btn-primary">Cart</a>
                <a href="{{ route('checkout') }}" class="btn w-25 m-auto btn-primary">Checkout</a>
           </div>
       </div>
       </div>
   </div>
 </div>