jQuery(document).ajaxSend(function (event, jqxhr, settings){
    console.log('ajaxSend');
//    jQuery('.ajax-btn').addClass('bg_loading');
});
jQuery(document).ajaxComplete(function (e){
//    jQuery('.ajax-btn').removeClass('bg_loading');
    console.log('ajaxComplete');
});

function ajaxAddToCart(url,button){
    jQuery(button).addClass('bg_loading');
    button.disabled = true;
    jQuery.post(url+"?ajax=1",{},function(response){
        if(response.status == true){
            var tital= response.message;
            var content='<div class="content-box">' +
                '<div class="img"><img src="'+response.productInfo.img+'"></div>' +
                '<div class="info"><div class="name">'+response.productInfo.name+'</div>' +
                '<div class="col2">'+
                '<span class="qty">'+response.productInfo.qty+'</span>' +
                '<span class="total">'+response.productInfo.total+'</span>'+
                '</div>' +
                '</div></div>';
            var buttons='<button type="button" class="btn btn-default" data-dismiss="modal">Continue Shopping</button>' +
                '<a href="checkout/cart" class="btn btn-primary">View Cart</a>';

            jQuery('.modal .modal-title').addClass('success').html(tital);
            jQuery('.modal .modal-body').html(content);
            jQuery('.modal .modal-footer').html(buttons);
            jQuery('.modal').modal({backdrop: 'static', keyboard: false});
            jQuery('.checkout.iconfont.icon-gouwuche>i').html(response.cart_qty);
            jQuery(button).removeClass('bg_loading');
            button.disabled = false;
        }
    },'json');
}

