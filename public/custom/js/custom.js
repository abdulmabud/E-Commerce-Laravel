$('.addtocart').click(function(){
    var productId = this.dataset.productid;
    var thisBtn = this;
    if(cart.length != 0){
      if(cart['products'][productId]){
        var quantity = cart['products'][productId]['quantity'] + 1;
      }else{
        var quantity = 1; 
      }
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
          cartitemcount();
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
            cartitemcount();
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
          cartitemcount();
        }
      });
      
    });
  }

  // cart item count
  cartitemcount();
  function cartitemcount(){
    
    
    $.ajax({
      url: cartitemcounturl,
      method: 'POST',
      data: { _token: csrf },
      cache: false,
      success: function(data){
          $('#countCart').html(data);
          $('#iconcart').html(data);
      }
    })
  }

  //Single Cart Item Count
  setInterval(() => {
    $.ajax({
      url: "/singlecartitemcount",
      method: 'POST',
      data: {_token: csrf},
      cache: false,
      success: function(data){
        var allCartItem = Object.values(data);
        allCartItem.forEach(item => {
          var itemId = 'q'+item['id'];
          var itemQuantity = item['quantity'];
         $('#'+itemId).val(itemQuantity);
          
        });
      }
    });
  }, 1000);

  //Show cart product list when click cart icon
  $('#iconcartp').click(function(){
    $.ajax({
      url: "/showcartlist",
      method: 'POST',
      data: {_token: csrf},
      cache: false,
      success: function(data){
          $('#cartlistbody').html(data);
      }
    });
  });
  