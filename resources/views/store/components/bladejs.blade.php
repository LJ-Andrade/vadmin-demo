<script>

    var loader = "<img src='{{ asset('images/gral/loader-sm.svg') }}'>";
    
    /*
    |--------------------------------------------------------------------------
    | CART
    |--------------------------------------------------------------------------
    */
    
    $(document).on("click", "#AddArticleToCart", function(e){
        var route     = "{{ route('store.addtocart') }}";
        var articleid = $(this).data('articleid');
        var size      = $('#SelectedSize').val();
        var quantity  = $('#SelectedQuantity').val();

        AddArticleToCart(route, articleid, size, quantity);
    });

    $(document).on("click", ".RemoveArticleFromCart", function(e){
        var route     = "{{ route('store.removefromcart') }}";
        var detailid = $(this).data('detailid');
        
        RemoveArticleFromCart(route, detailid)
    });


    function AddArticleToCart(route, articleid, size, quantity){
        $.ajax({	
            url: route,
            method: 'POST',             
            dataType: 'JSON',
            data: { article_id: articleid, size: size, quantity: quantity },
            success: function(data){
                $('#Error').html(data.responseText);
                //console.log(data);
                var action = 'reload';
                var time   = 1000;
                if(data.response == true){
                    toast_success('Ok!', 'Producto agregado al carro | Talle: ' + size + ' | Cantidad: ' + quantity, 'bottomCenter', action, time);
                }  else {
                    //$('#Error').html(data.message['errorInfo']);
                    toast_error('Ups!', 'Error', 'bottomCenter', action, time);
                    console.log(data);
                }
            },
            error: function(data){
                $('#Error').html(data.responseText);
                console.log(data);
            }
        });
    }

    function RemoveArticleFromCart(route, detailid){
        $.ajax({	
            url: route,
            method: 'POST',             
            dataType: 'JSON',
            data: { detailid: detailid },
            success: function(data){
                console.log(data);
                var action = 'reload';
                var time   = 500;
                if(data.response == true){
                    if(data.doaction == 'back'){
                        window.location.href = "{{ URL::to('tienda') }}"
                    } else {
                        toast_success('Ok!', 'Producto removido del carro', 'bottomCenter', action, time);
                    }
                }  else {
                    //$('#Error').html(data.message['errorInfo']);
                    toast_error('Ups!', 'Error', 'bottomCenter', action, time);
                    console.log(data);
                }
            },
            error: function(data){
                $('#Error').html(data.responseText);
                console.log(data);
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | WHISH-LISTS
    |--------------------------------------------------------------------------
    */
    // Add Article to WishList
    $(document).on("click", ".AddToFavs", function(e){
        e.preventDefault();
        var articleid  = $(this).data('id');
        var favid      = $(this).data('favid');
        action         = 'show';
        displayButton  = $(this);
        addArticleToFavs(favid, articleid, action, displayButton);
    });

    // Remove Article from WishList
    $(document).on("click", ".RemoveFromFavs", function(e){
        e.preventDefault();
        var favid      = $(this).data('favid');
        action         = 'reload';
        removeArticleFromFavs(favid, action);
    });

    $(document).on("click", ".RemoveAllFromFavs", function(e){
        e.preventDefault();
        var customerid = $(this).data('customerid');
        action         = 'reload';
        removeAllArticlesFromFavs(customerid, action);
    });

    function addArticleToFavs(favid, articleid, action, displayButton){
        $.ajax({	
            url: "{{ route('customer.addArticleToFavs') }}",
            method: 'POST',             
            dataType: 'JSON',
            data: { fav_id: favid, article_id: articleid },
            success: function(data){
                $('#Error').html(data.responseText);
                console.log(data);
                if(data.response == true && data.result == 'added'){
                    switch(action) {
                        case 'reload':
                            location.reload();
                            break;
                        case 'show':
                            displayButton.addClass('addedToFavs');
                            toast_success('Ok!', 'Producto agregado a favoritos', 'bottomCenter');
                            break;
                        case 'none':
                            console.log('Actualizado - Sin Acción');
                        default:
                            console.log('No hay acción');
                            break;
                    } 
                } else if(data.response == true && data.result == 'removed') {
                        displayButton.removeClass('addedToFavs');
                        toast_success('Ok!', 'Producto eliminado de favoritos', 'bottomCenter');
                }  else {
                //$('#Error').html(data.message['errorInfo']);
                console.log(data);
                }
            },
            error: function(data){
                // $('#Error').html(data.responseText);
                console.log(data);
            }
        });
    }

    function removeArticleFromFavs(favid, action){
        var doaction = action;
        $.ajax({	
            url: "{{ route('customer.removeArticleFromFavs') }}",
            method: 'POST',             
            dataType: 'JSON',
            data: { fav_id: favid },
            success: function(data){
                $('#Error').html(data.responseText);
                console.log(data);
                if(data.response == true){
                    console.log(doaction);
                    switch(doaction) {
                        case 'reload':
                            var action = 'reload';
                            toast_success('Ok!', 'Producto eliminado de favoritos', 'bottomCenter', action, 1000);
                            break;
                        default:
                            console.log('No hay acción');
                            break;
                    } 
                } else {
                //$('#Error').html(data.message['errorInfo']);
                console.log(data);
                }
            },
            error: function(data){
                //$('#Error').html(data.responseText);
                console.log(data);
            }
        });
    }
    
    function removeAllArticlesFromFavs(customerid, action){
        $.ajax({	
            url: "{{ route('customer.removeAllArticlesFromFavs') }}",
            method: 'POST',             
            dataType: 'JSON',
            data: { customer_id: customerid },
            success: function(data){
                console.log(data);
                //$('#Error').html(data.responseText);
                if(data.response == true){
                    switch(action) {
                        case 'reload':
                            location.reload();
                            break;
                        default:
                            console.log('No hay acción');
                            break;
                    } 
                } else {
                $('#Error').html(data.message['errorInfo']);
                console.log(data);
                }
            },
            error: function(data){
                //$('#Error').html(data.responseText);
                console.log(data);
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | MERCADO PAGO CHECKOUT
    |--------------------------------------------------------------------------
    */
    $('#MpModalBtn').click(function(){            
        var responseDiv = $('#MpResponse');
        var redirectBtn = $('#MpRedirect');
        var cartId      = $('#CartId').val();
        var cartTotal   = $('#CartTotal').val();
        
        createPreference(cartId, cartTotal, responseDiv, redirectBtn);
    });
    //url: "{{ route('store.getCreatePreference') }}",
    function createPreference(cartId, cartTotal, responseDiv, redirectBtn) {

        var btnLoader   = $('.CheckOutLoader').html(loader);
        btnLoader.hide();

        $.ajax({	
            url: "{{ route('store.getCreatePreference') }}",
            method: 'POST',             
            dataType: 'JSON',
            data: { cartId: cartId, cartTotal: cartTotal },
            beforeSend: function(){
                btnLoader.show();
            },
            success: function(data){
                console.log(data);
                if(data.response == true){
                    // Redirect to MP
                    var href = data.result;
                    window.location.replace(href);
                } else {
                $('#Error').html(data.result);
                console.log(data);
                }
            },
            error: function(data){
                console.log(data);
                $('#Error').html(data.responseText);
            },
            complete: function(){
                btnLoader.hide();
            }
        });
    }

</script>