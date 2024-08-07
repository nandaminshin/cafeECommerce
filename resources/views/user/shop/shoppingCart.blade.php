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
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('user#shop') }}">Shop</a>
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
    <input type="hidden" class="user-id" value="{{ Auth::user()->id }}" />
    <div class="container">
        <div class="row">
            <div class="col-lg-8 main-cart">
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

                            <tr class="item_row" data-id="{{ $cart_item->id }}">
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic mt-3">
                                        <img src="{{ asset(" storage/" . $cart_item->image) }}"
                                        alt=""
                                        width="63"
                                        height="63"
                                        />
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6 class="item_name">
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
                                            <input class="qty quantity_input" type="number" value="1" min="1"
                                                data-item="{{ $cart_item->name }}" />
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price">gg</td>
                                <td class="">
                                    <button class="remove-btn">
                                        <i class="fa-solid fa-circle-minus"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <h2 class="text-black pt-5 pb-5">
                        There is no item on the cart.
                    </h2>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{ route('user#shop') }}">
                                Continue Shopping
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{ route('user#order_list', Auth::user()->id) }}">
                                See Your Orders
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

                    <a href="#" class="primary-btn order-now">
                        Order Now &nbsp;
                        <i class="fa-solid fa-bell-concierge"></i>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- item add modal --}}
    <div id="itemAddedModal" class="add_message_modal" style="display: none">
        <div class="add_message_modal_content">
            <p class="add_cart_message">Successfully Ordered</p>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->
@endsection

@section("script_code")
<script>
    $(document).ready(function () {
            var navCart = parseInt($('.cart-amount').text());
            var form_item = {};
            var form_total = [];
            function updateTotalPrice() {
                var total = 0;
                $('.cart__price').each(function () {
                    total += parseFloat($(this).text());
                });
                $('.total_price_in_cart').text(total.toFixed(2) + ' Kyats');
                $('#total-cost').val(total);
                form_total = [total];
            }

            $('.item_row').each(function () {
                var row = $(this); // Cache the current row
                var id = row.data('id');
                var name = row.find('.item_name').text().trim();
                var price = parseFloat(row.find('.item_price').text());
                var quantity = parseFloat(row.find('.qty').val());

                form_item[id] = {
                    name: name,
                    quantity: quantity,
                };
                // Set the initial cart price
                row.find('.cart__price').text(price * quantity);

                // Attach a change event handler to the quantity input within the current row
                row.find('.qty').change(function () {
                    var newQuantity = parseFloat($(this).val());
                    var item_name = $(this).data('item');
                    row.find('.cart__price').text(price * newQuantity);
                    updateTotalPrice();
                    form_item[id] = {
                        name: name,
                        quantity: newQuantity,
                    };
                });

                row.find('.remove-btn').on('click', function () {
                    var itemId = row.data('id');
                    row.remove();
                    delete form_item[itemId];

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

            $('.order-now').on('click', function () {
                var user_id = $('.user-id').val();
                $.ajax({
                    method: 'post',
                    type: 'json',
                    url: '/customer/order',
                    data: {
                        user_id: user_id,
                        items: form_item,
                        total: form_total,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        console.log(response['message']);
                        $('.item_row').each(function () {
                            $(this).remove();
                            $('#itemAddedModal').fadeIn();
                            // Hide the modal after 1 second
                            setTimeout(function () {
                                $('#itemAddedModal').fadeOut();
                            }, 1000);

                            let newNavCart = 0;
                            $('.cart-amount')
                                .text(newNavCart)
                                .css('opacity', '0');
                            navCart = newNavCart;
                        });
                    },
                });

                $(this).css('pointer-events', 'none');
            });

            updateTotalPrice();
        });
</script>
@endsection