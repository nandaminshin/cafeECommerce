@php
$cart = session()->get("cart", []);
$cart_item;
@endphp

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>


    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('user/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('user/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('user/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('user/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('user/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>


    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                @if (Route::has('login') && !Auth::check())
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                    <a href="{{ url('/home') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                        Log in
                    </a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                        Register
                    </a>
                    @endif
                    @endauth
                </nav>
                @endif
            </div>
        </div>
        @if (Auth::check())
        <div class="mb-1 ps-4">
            <img src="@if(Auth::user()->image == null) {{ asset('user/img/default_user2.png') }} @endif {{ Auth::user()->image }} "
                alt="" width="45" height="45" style="border-radius: 50%">
            &nbsp; {{ Auth::user()->name }}
        </div>
        <div class="m-4">
            <div class="m-2"><button type="button" class="btn btn-dark"><i class="fa-solid fa-gear"></i>
                    &nbsp;Setting</button></div>
            <div class="m-2"><button type="submit" class="btn btn-dark logout-button"><i
                        class="fa-solid fa-right-from-bracket"></i> &nbsp; Logout</button></div>
        </div>
        @endif
        <div class="offcanvas__nav__option">
            <ul>
                <li style="list-style-type: none;" class="m-3"><a href="{{ route('home') }}" class="mobile-nav">Home</a>
                </li>
                <li style="list-style-type: none;" class="m-3"><a href="{{ route('user#shop') }}"
                        class="mobile-nav">Shop</a></li>
                <li style="list-style-type: none;" class="m-3"><a href="" class="mobile-nav">Blog</a></li>
                <li style="list-style-type: none;" class="m-3"><a href="" class="mobile-nav">Contact</a></li>
                @if (Auth::check())
                <li style="list-style-type: none;" class="m-3"><a href="{{ route('user#cart') }}" class="mobile-nav">
                        <div class="d-flex">
                            <div>
                                <i class="fa-solid fa-basket-shopping"></i>
                            </div>
                            {{-- @if (count($cart) > 0)
                            <div>
                                <span class="cart-amount text-white">{{ count($cart) }}</span>
                            </div>
                            @else
                            <div>
                                <span class="cart-amount" style="opacity: 0">0</span>
                            </div>
                            @endif --}}
                        </div>
                    </a></li>
                @endif
            </ul>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">

        @if (!Auth::check())
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                @if (Route::has('login'))
                                <nav class="-mx-3 flex flex-1 justify-end">
                                    @auth
                                    <a href="{{ url('/home') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                        Dashboard
                                    </a>
                                    @else
                                    <a href="{{ route('login') }}"
                                        class="text-white rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="text-white rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                        Register
                                    </a>
                                    @endif
                                    @endauth
                                </nav>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        {{-- <a href="./index.html"><img src="{{  asset('user/img/logo.png')}}" alt=""></a> --}}
                        <a href="{{ url('/') }}">ESPRESSO</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li @yield('active_home')><a href="{{ route('home') }}">Home</a></li>
                            <li @yield('active_shop')><a href="{{ route('user#shop') }}">Shop</a></li>
                            {{-- <li @yield('active_pages')><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./about.html">About Us</a></li>
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> --}}
                            <li @yield('active_blog')><a href="./blog.html">Blog</a></li>
                            <li @yield('active_contact')><a href="">Contacts</a></li>
                            @if (Auth::check())
                            <li @yield('active_cart')><a href="{{ route('user#cart') }}">
                                    <div class="d-flex">
                                        <div>
                                            <i class="fa-solid fa-basket-shopping"></i>
                                        </div>
                                        @if (count($cart) > 0)
                                        <div>
                                            <span class="cart-amount">{{ count($cart) }}</span>
                                        </div>
                                        @else
                                        <div>
                                            <span class="cart-amount" style="opacity: 0">0</span>
                                        </div>
                                        @endif
                                    </div>
                                </a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                @if (Auth::check())
                <div class="col-lg-3 col-md-3">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li @yield('active_account')><a href="#"><img
                                        src="@if(Auth::user()->image == null) {{ asset('user/img/default_user2.png') }} @else {{ asset('storage/'. Auth::user()->image) }} @endif"
                                        alt="" width="45" height="45" style="border-radius: 50%">
                                    &nbsp; {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('user#setting') }}"><i class="fa-solid fa-gear"></i> &nbsp;
                                            Setting</a></li>
                                    <li><a href="#" class="logout-button"><i class="fa-solid fa-right-from-bracket"></i>
                                            &nbsp; Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                @endif
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <form action="{{ route('logout') }}" method="post" id="logout-form">
        @csrf
    </form>

    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Are you sure you want to log out?</p>
            <div class="modal-buttons">
                <button id="confirm-logout">Yes</button>
                <button id="cancel-logout">No</button>
            </div>
        </div>
    </div>

    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                        <a href="#"><img src="img/payment.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Clothing Store</a></li>
                            <li><a href="#">Trending Shoes</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Sale</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Delivary</a></li>
                            <li><a href="#">Return & Exchanges</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>NewLetter</h6>
                        <div class="footer__newslatter">
                            <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                            <form action="#">
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>2020
                            All rights reserved | This template is made with <i class="fa fa-heart-o"
                                aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Js Plugins -->
    <script src="{{ asset('user/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('user/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('user/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-qFOQ9YFAeGj1gDOuUD61g3D+tLDv3u1ECYWqT82WQoaWrOhAY+5mRMTTVsQdWutbA5FORCnkEPEgU0OF8IzGvA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Get modal elements
        var modal = document.getElementById('confirmationModal');
        var closeBtn = document.getElementsByClassName('close')[0];
        var confirmBtn = document.getElementById('confirm-logout');
        var cancelBtn = document.getElementById('cancel-logout');

        // Show modal when logout button is clicked
        document.querySelectorAll('.logout-button').forEach(function (button) {
        button.addEventListener('click', function (event) {
        event.preventDefault();
        modal.style.display = 'block';
        })
        });

        // Hide modal when 'x' is clicked
        closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
        });

        // Hide modal when cancel button is clicked
        cancelBtn.addEventListener('click', function() {
        modal.style.display = 'none';
        });

        // Submit the form when confirm button is clicked
        confirmBtn.addEventListener('click', function() {
        document.getElementById('logout-form').submit();
        });


        // Hide modal if user clicks outside of the modal content
        window.addEventListener('click', function(event) {
        if (event.target == modal) {
        modal.style.display = 'none';
        }
        });
    </script>

    @yield('script_code')

</html>