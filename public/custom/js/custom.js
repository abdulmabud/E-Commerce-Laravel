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
          $(thisBtn).parent().html('<h5 class="text-center"><button class="minus-btn" data-productid='+productId+'>-</button><input type="text" value="1"  class="text-center" style="width: 60px;"><button class="plus-btn" data-productid='+productId+'>+</button></h5>');
          run();
        }
      }
    });
  });

  run();
  function run(){
    $('.minus-btn').click(function(){
      var productId = this.dataset.productid;
      var btn = 'minus-btn';
      $.ajax({
        url: cartupdateurl,
        method: 'POST',
        data: {productId: productId, btn: btn, _token: csrf },
        cache: false,
        success: function(data){
          if(data == 'Successfully'){
           
          }
        }
      });
      
    });

    $('.plus-btn').click(function(){
      var productId = this.dataset.productid;
      console.log('productId');
      
      var btn = 'plus-btn';
      $.ajax({
        url: cartupdateurl,
        method: 'POST',
        data: {productId: productId, btn: btn, _token: csrf },
        cache: false,
        success: function(data){
          if(data == 'Successfully'){
           
          }
        }
      });
      
    });
  }
  