$(document).ready(function () {
    $(document).on("click", ".addToCartBtn", function (e) {
        e.preventDefault();

        var prod_id = $(this)
            .closest(".product_data")
            .find(".product_id")
            .val();
        var prod_color = $("#color").val();
        var prod_size = $("#size").val();

        var prod_qty = $(this)
            .closest(".product_data ")
            .find(".qty-input")
            .val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                prod_id: prod_id,
                prod_qty: prod_qty,
                prod_color: prod_color,
                prod_size: prod_size
            },
            success: function (response) {
                swal(response.status);
            },
        });
    });
    $(document).on("click", ".addToWishlist", function (e) {
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
                prod_id: prod_id,
            },
            success: function (response) {
                swal(response.status);
            },
        });
    });
    $(document).on("click", ".btn-increase", function (e) {
        e.preventDefault();

        var inc_value = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 120) {
            value++;
            $(this).closest(".product_data").find(".qty-input").val(value);
        }
    });
    $(document).on("click", ".btn-reduce", function (e) {
        e.preventDefault();

        var dec_value = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest(".product_data").find(".qty-input").val(value);
        }
    });

    $(document).on("click", ".btn-delete", function (e) {
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
            url: "/delete-cart-item",
            data: {
                prod_id: prod_id,
            },
            success: function (response) {
                // location.reload();
                $(".cartitems").load(location.href + " .cartitems");
                swal("", response.status, "success");
            },
        });
    });
    $(document).on("click", ".changeQuantity", function (e) {
        e.preventDefault();

        var prod_id = $(this)
            .closest(".product_data")
            .find(".product_id")
            .val();
        var qty = $(this).closest(".product_data ").find(".qty-input").val();
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
                prod_id: prod_id,
                qty: qty,
            },
            success: function (response) {
                window.location.reload();
                // alert(response.status);
            },
        });
    });

    $("#sort").on("change", function () {
        this.form.submit();
    });

    $(".apply_coupon_btn").click(function (e) {
        e.preventDefault();
        var coupon_code = $(".coupon_code").val();
        if ($.trim(coupon_code).length == 0) {
            error_coupon = "Please enter valid Coupon";
            $("#error_coupon").text(error_coupon);
        } else {
            error_coupon = "";
            $("#error_coupon").text(error_coupon);
        }
        if (error_coupon != "") {
            return false;
        }
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            method: "POST",
            url: "/check-coupon-code",
            data: {
                'coupon_code': coupon_code,
            },
            success: function (response) {
                if (response.error_status == 'error') {
                    swal('',response.status);
                    $('.coupon_code').val('');
                } else {
                    swal('',response.status);
                    var discount = response.discount_price;
                    var grandTotal = response.grandTotal;
                    $('.coupon_code').prop('readonly', true);
                    $('.discount_price').text(discount.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' VND');
                    $('.grandtotal_price').text(grandTotal.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' VND');
                }
            },
        });
    });
});
