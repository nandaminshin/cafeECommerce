@php
    $cart = session()->get("cart", []);
    $cart_item;
@endphp

@extends("user.master")

@section("title")
    Cart
@endsection

@section("active_cart")
    class="active"
@endsection

@section("content")
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        @if (count($cart) > 0)
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                        @foreach ($product_data as $product)
                                            @if ($product->id == $item)
                                                @php
                                                    $cart_item = $product;
                                                @endphp
                                            @endif
                                        @endforeach

                                        <tr
                                            class="item_row"
                                            data-id="{{ $cart_item->id }}"
                                        >
                                            <td class="product__cart__item">
                                                <div
                                                    class="product__cart__item__pic mt-3"
                                                >
                                                    <img
                                                        src="{{ asset("storage/" . $cart_item->image) }}"
                                                        alt=""
                                                        width="63"
                                                        height="63"
                                                    />
                                                </div>
                                                <div
                                                    class="product__cart__item__text"
                                                >
                                                    <h6>
                                                        {{ $cart_item->name }}
                                                    </h6>
                                                    <h5 class="item_price">
                                                        {{ $cart_item->price }}
                                                    </h5>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="">
                                                    <div>
                                                        <input
                                                            class="qty quantity_input"
                                                            type="number"
                                                            value="1"
                                                            min="1"
                                                        />
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">gg</td>
                                            <td class="">
                                                <button class="remove-btn">
                                                    <i
                                                        class="fa-solid fa-circle-minus"
                                                    ></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h2 class="text-black p-5">
                                There is no item on the cart.
                            </h2>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route("user#shop") }}">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($cart) > 0)
                    <div class="col-lg-4">
                        <div class="cart__total">
                            <h6>Cart total</h6>
                            <ul>
                                <li>
                                    Total
                                    <span class="total_price_in_cart">
                                        $ 169.50
                                    </span>
                                </li>
                            </ul>
                            <a href="#" class="primary-btn">
                                Order Now &nbsp;
                                <i class="fa-solid fa-bell-concierge"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection

@section("script_code")
    <script>
        $(document).ready(function () {
            let navCart = parseInt($('.cart-amount').text());
            function updateTotalPrice() {
                var total = 0;
                $('.cart__price').each(function () {
                    total += parseFloat($(this).text());
                });
                $('.total_price_in_cart').text(total.toFixed(2) + ' Kyats');
            }

            $('.item_row').each(function () {
                var row = $(this); // Cache the current row
                var price = parseFloat(row.find('.item_price').text());
                var quantity = parseFloat(row.find('.qty').val());

                // Set the initial cart price
                row.find('.cart__price').text(price * quantity);

                // Attach a change event handler to the quantity input within the current row
                row.find('.qty').change(function () {
                    var newQuantity = parseFloat($(this).val());
                    row.find('.cart__price').text(price * newQuantity);
                    updateTotalPrice();
                });

                row.find('.remove-btn').on('click', function () {
                    var itemId = row.data('id');
                    row.remove();

                    $.ajax({
                        method: 'post',
                        type: 'json',
                        url: '/customer/remove-item',
                        data: {
                            id: itemId,
                            _token: '{{ csrf_token() }}', // Include CSRF token
                        },
                        success: function (response) {
                            // Optionally handle the response
                            console.log(response.message);
                            // Recalculate the total price
                            updateTotalPrice();
                            let newNavCart = navCart - 1;
                            $('.cart-amount').text(newNavCart);
                            navCart = newNavCart;
                        },
                        error: function (xhr) {
                            // Optionally handle the error
                            console.error(xhr.responseText);
                        },
                    });
                });
            });

            updateTotalPrice();
        });
    </script>
@endsection
