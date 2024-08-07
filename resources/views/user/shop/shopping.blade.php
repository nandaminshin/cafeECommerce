@php
$cart = session()->get("cart", []);
$cart_item;
@endphp

@extends("user.master")

@section("title")
Shop
@endsection

@section("active_shop")
class="active"
@endsection

@section("content")
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="{{ route('user#shop') }}" method="get">
                            <input type="text" name="key" placeholder="Search..." value="{{ request('key') }}" />
                            <button type="submit">
                                <span class="icon_search"></span>
                            </button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">
                                        Categories
                                    </a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                <li>
                                                    <a href="{{ route('user#shop') }}">
                                                        All
                                                    </a>
                                                </li>
                                                @foreach ($category_data as $item)
                                                <li>
                                                    <a href="{{ route('user#shop_by_category', $item->id) }}">
                                                        {{ $item->name }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row" id="product-list">
                    @if ($product_data)
                    @foreach ($product_data as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" @if ($item->image == null)
                                data-setbg="{{ asset('admin/assets/img/elements/18.jpg') }}"
                                @else
                                data-setbg="{{ asset('storage/' . $item->image) }}"
                                @endif>
                                <ul class="product__hover">
                                    <li>
                                        <a href="{{ route('user#product_details', $item->id) }}">
                                            <img src="{{ asset('user/img/icon/search.png') }}" alt="" />
                                            <span>
                                                Producrt Details
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{ $item->name }}</h6>

                                @if (Auth::check())
                                @if (in_array($item->id, $cart))
                                <span class="text-danger">
                                    Already In Cart
                                </span>
                                @elseif($item->stock_status == 0)
                                <span class="text-primary">
                                    Out Of Stock
                                </span>
                                @else
                                <button class="add-cart" value="{{ $item->id }}">
                                    Add To Cart
                                </button>
                                @endif
                                @else
                                <span class="text-danger">
                                    Login to purchase!
                                </span>
                                @endif
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
                    @else
                    <h2 class="m-5">There is no product here</h2>
                    @endif
                </div>
                <div class="p-4 align-center">
                    {{ $product_data->links() }}
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
<!-- Shop Section End -->
@endsection

@section("script_code")
<script>
    $(document).ready(function () {
        var nav_cart = parseInt($('.cart-amount').text());

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content',
                ),
            },
        });
        $('.add-cart').each(function () {
            var current_id;
            $(this).on('click', function () {
                let id = $(this).val();

                if (current_id !== id) {
                    $.ajax({
                        url: '/customer/add-to-cart',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                        },
                        success: function (response) {
                            console.log('Item added to cart');
                            $('#itemAddedModal').fadeIn();
                            // Hide the modal after 1 second
                            setTimeout(function () {
                                $('#itemAddedModal').fadeOut();
                            }, 1000);
                            current_id = id;
                        },
                    });
                    let new_nav_cart = nav_cart + 1;
                    $('.cart-amount')
                        .css('opacity', '1')
                        .text(new_nav_cart);

                    nav_cart = new_nav_cart;
                }
            });
        });
        });
</script>
@endsection