@extends("user.master")

@section("title")
    Order List
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
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <a href="./shop.html">Shopping Cart</a>
                            <span>Order List</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <h6 class="coupon__code">
                Once the order is successfully delivered, the order list will be
                automatically deleted.
            </h6>
            <div class="row">
                @foreach ($orders as $order)
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 pt-2 pb-5">
                        <div class="checkout__form">
                            <form
                                id="order-delete-form"
                                method="POST"
                                action="{{ route("user#delete_order", $order->id) }}"
                            >
                                @csrf
                                <div class="checkout__order">
                                    <h4 class="order__title">Your order</h4>
                                    <h5>Order ID: {{ $order->id }}</h5>
                                    <h6>
                                        Order Date:
                                        {{ \Carbon\Carbon::parse($order->created_at)->format("l, F j, Y g:i A") }}
                                    </h6>
                                    <br />
                                    <br />
                                    <div class="checkout__order__products">
                                        Name
                                        <span>Total</span>
                                        <span class="pe-5">Qty</span>
                                        <span class="pe-5">Price</span>
                                    </div>
                                    <ul class="checkout__total__products">
                                        @foreach ($order->orderProduct as $orderProductItem)
                                            <li>
                                                {{ $orderProductItem->product->name }}
                                                <span>
                                                    {{ $orderProductItem->product->price * $orderProductItem->quantity }}
                                                </span>
                                                <span class="pe-5">
                                                    {{ $orderProductItem->quantity }}
                                                </span>
                                                <span class="pe-5">
                                                    {{ $orderProductItem->product->price }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul class="checkout__total__all">
                                        <li>
                                            Total
                                            <span>
                                                {{ $order->total_cost }}
                                            </span>
                                        </li>
                                    </ul>

                                    <div class="d-flex">
                                        <h5 class="p-2">Status :</h5>
                                        <h5 class="text-danger p-2">
                                            {{ $order->status }}
                                        </h5>
                                    </div>
                                    <button class="site-btn delete-btn">
                                        Delete Order
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <div id="deleteConfirmationModal" class="modal">
        <div class="modal-content">
            <button class="crossX" style="background: none; border: none">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <p>Are you sure you want to delete this order?</p>
            <div class="modal-buttons">
                <button id="confirm-delete">Yes</button>
                <button id="cancel-delete">No</button>
            </div>
        </div>
    </div>
@endsection

@section("script_code")
    <script>
        $(document).ready(function () {
            // Get modal elements
            var $modal = $('#deleteConfirmationModal');
            var $closeBtn = $('.crossX');
            var $confirmBtn = $('#confirm-delete');
            var $cancelBtn = $('#cancel-delete');

            // Show modal when logout button is clicked
            $('.delete-btn').on('click', function (event) {
                event.preventDefault();
                $modal.show();
            });

            // Hide modal when 'x' is clicked
            $closeBtn.on('click', function () {
                $modal.hide();
            });

            // Hide modal when cancel button is clicked
            $cancelBtn.on('click', function () {
                $modal.hide();
            });

            // Submit the form when confirm button is clicked
            $confirmBtn.on('click', function () {
                $('#order-delete-form').submit();
            });

            // Hide modal if user clicks outside of the modal content
            $(window).on('click', function (event) {
                if ($(event.target).is($modal)) {
                    $modal.hide();
                }
            });
        });
    </script>
@endsection
