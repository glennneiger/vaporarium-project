$(function () {
    $('.box-body').on('change','.js-order-item-quantity, .js-order-item-price', function () {
        let $row = $(this).closest('tr'),
            quantity = parseInt($row.find('.js-order-item-quantity').val()),
            price = parseFloat($row.find('.js-order-item-price').val()),
            $amountInput = $row.find('.js-order-item-value'),
            amout =quantity*price;

        if(isNaN(amout)){
            amout = '';
        }
        $amountInput.val(amout);
        updateTotal()
    });
    function updateTotal() {
        let $itemsAmounts = $('.js-order-item-value'),
            $totalAmountInput = $('.js-order-orderprice'),
            sum = 0;

        $itemsAmounts.each(function () {
            let itemAmount = parseFloat($(this).val());

            if(!isNaN(itemAmount)){
                sum +=itemAmount;
            }
        });
        $totalAmountInput.val(sum);
    }
});