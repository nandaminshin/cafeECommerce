@php
$cart = session()->get("cart", []);
$cart_item;
@endphp

@extends("user.master")

@section("title")
Product Details
@endsection

@section("active_shop")
class="active"
@endsection

@section("content")
<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('user#shop') }}">Shop</a>
                        <span>Product Details</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{ asset('storage/' . $data->image) }}" alt="" width="auto" height="360px" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h2>{{ $data->name }}</h2>
                        <h3>
                            {{ $data->price }}
                            {{-- <span>70.00</span> --}}
                        </h3>
                        <div class="product__details__cart__option">
                            @if (Auth::check())
                            @if (in_array($data->id, $cart))
                            <span class="text-info">
                                Already in cart
                            </span>
                            @else
                            <button class="primary-btn add-cart" value="{{ $data->id }}" style="border: none">
                                add to cart
                            </button>
                            @endif
                            @else
                            <span class="text-danger">
                                Login to purchase!
                            </span>
                            @endif
                        </div>
                        <div class="product__details__last__option">
                            <h5><span>Guaranteed Safe Checkout</span></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">
                                    Description
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">
                                    Our Health Care Policy
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note">
                                        {{ $data->description }}
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-7" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note">
                                        Espresso Cafe Health Care Policy
                                    </p>
                                    <p>
                                        At Espresso Cafe, we prioritize your
                                        health and well-being by ensuring
                                        that every product we offer is
                                        clean, healthy, eco-friendly, and of
                                        the highest quality. Our commitment
                                        to these principles is reflected in
                                        every aspect of our operations, from
                                        sourcing ingredients to preparing
                                        and serving our products.
                                    </p>
                                    <div class="product__details__tab__content__item">
                                        <h5>Cleanliness and Hygiene</h5>
                                        <p>
                                            We maintain the highest
                                            standards of cleanliness and
                                            hygiene in our cafe. Our staff
                                            undergoes regular training on
                                            best practices for food safety
                                            and hygiene. All surfaces and
                                            equipment are sanitized
                                            frequently, and we adhere to
                                            strict protocols to prevent
                                            cross-contamination. Our kitchen
                                            and preparation areas are
                                            inspected regularly to ensure
                                            compliance with health and
                                            safety regulations.
                                        </p>
                                        <br />
                                        <h5>Healthy Ingredients</h5>
                                        <p>
                                            We believe that great taste
                                            should not come at the expense
                                            of your health. That’s why we
                                            use only the finest, natural
                                            ingredients in our products. Our
                                            coffee beans are ethically
                                            sourced and roasted to
                                            perfection, free from additives
                                            and preservatives. Our breads
                                            and cakes are baked fresh daily
                                            using whole grains, organic
                                            flours, and natural sweeteners.
                                            We offer a range of smoothies
                                            and breakfast snacks made from
                                            fresh fruits, vegetables, and
                                            superfoods to provide you with
                                            essential
                                        </p>
                                        <br />
                                        <h5>Eco-Friendly Practices</h5>
                                        <p>
                                            Sustainability is at the heart
                                            of our operations. We are
                                            committed to reducing our
                                            environmental impact by using
                                            eco-friendly packaging and
                                            promoting waste reduction. Our
                                            takeaway containers, cups, and
                                            utensils are made from
                                            biodegradable or recyclable
                                            materials. We also encourage
                                            customers to bring their own
                                            reusable cups and containers,
                                            offering discounts as an
                                            incentive.
                                        </p>
                                        <br />
                                        <h5>Quality Assurance</h5>
                                        <p>
                                            Quality is non-negotiable at
                                            Espresso Cafe. We work closely
                                            with trusted suppliers who share
                                            our commitment to high
                                            standards. Every product is
                                            carefully crafted to meet our
                                            rigorous quality benchmarks,
                                            ensuring that you receive the
                                            best possible experience with
                                            every visit.
                                        </p>
                                        <br />
                                        <p>
                                            We invite you to join us at
                                            Espresso Cafe, where your health
                                            and satisfaction are our top
                                            priorities. Enjoy our premium
                                            quality coffee, bread, cakes,
                                            smoothies, breakfast snacks, and
                                            drinks, knowing that each
                                            product is made with care,
                                            integrity, and a dedication to
                                            excellence.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- item add modal --}}
    <div id="itemAddedModal" class="add_message_modal" style="display: none">
        <div class="add_message_modal_content">
            <p class="add_cart_message">Added to cart</p>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Related Products</h3>
            </div>
        </div>
        @if ($related_products->count() == 0)
        <h4 class="text-center">No product yet!</h4>
        @endif

        <div class="row">
            @foreach ($related_products as $item)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $item->image) }}">
                        <ul class="product__hover">
                            <li>
                                <a href="{{ route('user#product_details', $item->id) }}">
                                    <img src="{{ asset('user/img/icon/search.png') }}" alt="" />
                                    <span>Producrt Details</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>{{ $item->name }}</h6>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>{{ $item->price }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Related Section End -->
@endsection

@section("script_code")
<script>
    $(document).ready(function () {
            var nav_cart = parseInt($('.cart-amount').text());
            var current_id;

            $(document).on('visibilitychange', function () {
                if (!document.hidden) {
                    location.reload();
                }
            });

            $('.add-cart').on('click', function () {
                var id = $(this).val();

                if (current_id !== id) {
                    $.ajax({
                        method: 'post',
                        type: 'json',
                        url: '/customer/add-to-cart',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                        },
                        success: function (response) {
                            $('#itemAddedModal').fadeIn();
                            // Hide the modal after 1 second
                            setTimeout(function () {
                                $('#itemAddedModal').fadeOut();
                            }, 1000);
                            current_id = id;
                        },
                    });

                    let new_nav_cart = nav_cart + 1;
                    $('.cart-amount').css('opacity', '1').text(new_nav_cart);

                    nav_cart = new_nav_cart;
                }
            });
        });
</script>
@endsection