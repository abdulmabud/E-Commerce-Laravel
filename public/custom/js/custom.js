$('.addtocart').click(function(){
    var productId = this.dataset.productid;
    var thisBtn = this;
    if(cart['products']){
      var quantity = cart['products'][productId]['quantity'] + 1;
      var qhtml = '<h5 class="addtocartQuantity" style="text-align: center;"><button class="minus-btn" data-minusbtn = '+productId+'>-</button> <input type="text" value="'+quantity+'" id="q'+productId+'" class="text-center" style="width: 60px;">  <button class="plus-btn" data-plusbtn="'+productId+'">+</button> </h5>';
    }else{
      var qhtml = '<h5 class="addtocartQuantity" style="text-align: center;"><button class="minus-btn" data-minusbtn = '+productId+'>-</button> <input type="text" value="1" id="q'+productId+'" class="text-center" style="width: 60px;">  <button class="plus-btn" data-plusbtn="'+productId+'">+</button> </h5>';
    }
    $.ajax({
      url: cartaddurl,
      method: 'POST',
      data: {productId: productId, _token: csrf },
      cache: false,
      success: function(data){
        if(data == 'Successfully'){
          $(thisBtn).parent().html(qhtml);
          run();
        }
      }
    });
  });

  run();
  function run(){
    $('.minus-btn').click(function(){
      var productId = this.dataset.minusbtn;
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
      var productId = this.dataset.plusbtn;
      console.log(productId);
      
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
  