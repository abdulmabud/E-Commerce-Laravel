$('.addtocart').click(function(){
    var productId = this.dataset.productid;
    var thisBtn = this;
    console.log(cartaddurl);
    
    $.ajax({
      url: cartaddurl,
      method: 'POST',
      data: {productId: productId, _token: csrf },
      cache: false,
      success: function(data){
        if(data == 'Successfully'){
          $(thisBtn).parent().html('<h5 class="text-center"><button>-</button><input type="text" value="1"  class="text-center" style="width: 60px;"><button>+</button></h5>');
        }
      }
    });
  });