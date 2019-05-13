jQuery(function ($) {
    $('.js-add-to-cart').click(function (event) {
        event.preventDefault();
        let $me = $(this);

        $me.attr('disabled', 'disabled');
        $('.js-header-cart').load(this.href, function (){
            $me.removeAttr('disabled');
            let done_id = "#"+$me.data('product-id');
            $(done_id).css("display","inline-block");
        });
    });

    let removeFromCart;
    let $cart_order = $('#js-cart_order');

    $cart_order.on('click','.js-delete-order-a' , function (event) {
        event.preventDefault();
        removeFromCart = this.href;
    });

    $('#confirmedRemoveFromCartButton').click(function (event) {
        $cart_order.load(removeFromCart);
        reloadHeaderCard();
    });

    $cart_order.on('change','.js-cart-item-quantity', function (event) {
        let $me = $(this);
        let url = $me.data('item-update-url').replace('--quantity--',$me.val());
        $cart_order.load(url);
        reloadHeaderCard();
    });

    function reloadHeaderCard() {
        let $cart = $('.js-header-cart');
        $cart.load($cart.data('href'));
    };



});