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
          $(thisBtn).html('View Cart');
        }
      }
    });
  });