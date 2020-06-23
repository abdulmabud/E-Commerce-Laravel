$('.addtocart').click(function(){
    var productId = this.dataset.productid;
    var thisBtn = this;
    // console.log(cart['products'][productId]['quantity']);
    console.log(productId);
    

    if(cart['products'][productId]){
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
      var quantity = $('#q'+productId).val();
      $.ajax({
        url: cartupdateurl,
        method: 'POST',
        data: {productId: productId, btn: btn, _token: csrf },
        cache: false,
        success: function(data){
            if(quantity < 2){
              quantity = 1;
            }else{
              quantity = quantity - 1;
            }
            $('#q'+productId).val(quantity);
        }
      });
      
    });

    $('.plus-btn').click(function(){
      var productId = this.dataset.plusbtn;
      var btn = 'plus-btn';
      var quantity = $('#q'+productId).val();
      $.ajax({
        url: cartupdateurl,
        method: 'POST',
        data: {productId: productId, btn: btn, _token: csrf },
        cache: false,
        success: function(data){
          quantity = parseInt(quantity) + 1;
          $('#q'+productId).val(quantity);
        }
      });
      
    });
  }
  