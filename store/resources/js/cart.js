(function ($) {
    $('.item-quantity').on('change', function () {
        $.ajax({
            url: "/cart/" + $(this).data('id'), //data-id
            method: 'PUT',
            data: {
                quantity: $(this).val(),
                _token: window.csrf_token, // Get from window
            },
        });
    });

    $('.remove-item').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: "/cart/" + id, //data-id
            method: 'delete',
            data: {
                _token: window.csrf_token, // Get from window
            },
            success: response => {
                $(`#${id}`).remove();
            }

        });
    });
    $('.add-to-cart').on('click', function () {
        $.ajax({
            url: "/cart/", //data-id
            method: 'post',
            data: {
                product_id: $(this).data('id'),
                quantity: $(this).data('quantity'), 
                _token: window.csrf_token, // Get from window
            },
            success: response => {
                alert('Product added to cart!');
            }

        });
    });
})(jQuery);


