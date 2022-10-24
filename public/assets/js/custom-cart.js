$(document).ready(function () {
    $(".addToCartBtn").click(function (e) {
        e.preventDefault();

        var prod_id = $(this)
                    .closest(".product_data")
                    .find(".product_id")
                    .val();

        var prod_qty = $(this)
                    .closest(".product_data ")
                    .find(".qty-input")
                    .val();

        // alert(prod_id);
        // alert(prod_qty);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'prod_id': prod_id,
                'prod_qty': prod_qty
            },
            success: function (response) {
                swal(response.status);
            },
        });
    });

    $(".addToWishlist").click(function (e) {
        e.preventDefault();

        var prod_id = $(this)
                    .closest(".product_data")
                    .find(".product_id")
                    .val();

        // alert(prod_id);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/add-to-wishlist",
            data: {
                'prod_id': prod_id
            },
            success: function (response) {
                swal(response.status);
            },
        });
    });

    $('.btn-increase').click(function (e) {
        e.preventDefault();

        var inc_value = $(this)
            .closest('.product_data')
            .find('.qty-input')
            .val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 120) {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    $('.btn-reduce').click(function (e) {
        e.preventDefault();

        var dec_value = $(this)
            .closest('.product_data')
            .find('.qty-input')
            .val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    // $('.btn-delete').click(function (e) {
    $(document).on('click', '.btn-delete', function (e) {

        e.preventDefault();

        var prod_id = $(this)
            .closest('.product_data')
            .find('.product_id')
            .val();
        // alert(prod_id);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/delete-cart-item",
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                // location.reload();
                $('.cartitems').load(location.href + " .cartitems");
                swal('',response.status, 'success');
            },
        });
    });

    $('.changeQuantity').click(function (e) {
        e.preventDefault();

        var prod_id = $(this)
            .closest('.product_data')
            .find('.product_id')
            .val();
        var qty = $(this)
            .closest('.product_data ')
            .find('.qty-input')
            .val();
        // alert(prod_id);
        // alert(qty);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/update-cart-item",
            data: {
                'prod_id': prod_id,
                'qty': qty,
            },
            success: function (response) {
                window.location.reload();
                // alert(response.status);
            },
        });
    });



});
