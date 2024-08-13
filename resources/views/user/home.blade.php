@extends('user.master')

@section('title')
Home
@endsection

@section('active_home')
class="active"
@endsection

@section('content')

<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="{{ asset('user/img/cafe_wallpaper.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>A place where you can find happiness...</h6>
                            <h2>Welcome to ESPRESSO</span></h2>
                            <p>A specialist place for coffee, cake, bread and drink. Quality is our first priority.</p>
                            <a href="{{ route('user#shop') }}" class="primary-btn"
                                style="background-color: #feee91; color: black;">Shop now
                                <span class="arrow_right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="{{ asset('user/img/cafe_wallpaper2.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>A place where you can find happiness...</h6>
                            <h2>Welcome to ESPRESSO</span></h2>
                            <p>A specialist place for coffee, cake, bread and drink. Quality is our first priority.</p>
                            <a href="{{ route('user#shop') }}" class="primary-btn"
                                style="background-color: #feee91; color: black;">Shop now <span
                                    class="arrow_right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="mt-5 mb-5">
    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 p-3">
                <h2 class="product-ad-text">High quality coffee</h2>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 p-3">
                <img src="{{ asset('user/img/coffee_wallpaper.jpg') }}" alt="" width="270" height="180"
                    class="product-ad-img">
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 p-3">
                <h2 class="product-ad-text">High quality cakes</h2>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 order-info order-xl-first order-lg-first p-3">
                <img src="{{ asset('user/img/cake_wallpaper.jpg') }}" alt="" width="270" height="180"
                    class="product-ad-img" style="float: right">
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 p-3">
                <h2 class="product-ad-text">Organic refreshing smoothies</h2>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 p-3">
                <img src="{{ asset('user/img/smoothie_wallpaper.jpg') }}" alt="" width="270" height="180"
                    class="product-ad-img">
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->


<!-- Categories Section Begin -->
<section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories__text">
                    <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories__hot__deal">
                    <img src="{{ asset('user/img/product-sale.png') }}" alt="">
                    <div class="hot__deal__sticker">
                        <span>Sale Of</span>
                        <h5>$29.99</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="categories__deal__countdown">
                    <span>Deal Of The Week</span>
                    <h2>Multi-pocket Chest Bag Black</h2>
                    <div class="categories__deal__countdown__timer" id="countdown">
                        <div class="cd-item">
                            <span>3</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span>1</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span>50</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span>18</span>
                            <p>Seconds</p>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Instagram Section Begin -->
<section class="instagram spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('user/img/coffee_gallary.webp') }}">
                    </div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('user/img/coffee_gallary.webp') }}">
                    </div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('user/img/coffee_gallary.webp') }}">
                    </div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('user/img/coffee_gallary.webp') }}">
                    </div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('user/img/coffee_gallary.webp') }}">
                    </div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('user/img/coffee_gallary.webp') }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="instagram__text">
                    <h2>Instagram</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <h3>#espresso</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Instagram Section End -->

<!-- About Section Begin -->
<section class="about spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>About Us</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="about__pic">
                    <img src="{{ asset('user/img/about_us_wallpaper.webp') }}" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>Who We Are ?</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, consequatur et quo repellendus
                        inventore ab ipsa aperiam voluptas similique eveniet odio, suscipit iste cumque eligendi aliquid
                        laborum tenetur? Repellendus, earum.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>Who We Do ?</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus enim deleniti saepe veniam,
                        quasi, sed doloremque libero consequatur a tempore nobis magnam aperiam quas ab eum fugit
                        obcaecati quam atque.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>Why Choose Us</h4>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat corrupti labore reiciendis ab
                        omnis, rem at neque ducimus consequuntur, tempora ullam consectetur soluta accusamus iure,
                        officiis laboriosam nesciunt facere cum?</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->

<!-- Testimonial Section Begin -->
<section class="testimonial">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="testimonial__text">
                    <span class="icon_quotations"></span>
                    <p>“Going out after work? Take your butane curling iron with you to the office, heat it up,
                        style your hair before you leave the office and you won’t have to make a trip back home.”
                    </p>
                    <div class="testimonial__author">
                        <div class="testimonial__author__pic">
                            <img src="{{ asset('user/img/about/testimonial-author.jpg') }}" alt="">
                        </div>
                        <div class="testimonial__author__text">
                            <h5>Augusta Schultz</h5>
                            <p>Fashion Design</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="testimonial__pic set-bg" data-setbg="{{ asset('user/img/about/testimonial-pic.jpg') }}">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Section End -->

<!-- Counter Section Begin -->
<section class="counter spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">
                        <h2 class="cn_num">102</h2>
                    </div>
                    <span>Our <br />Clients</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">
                        <h2 class="cn_num">30</h2>
                    </div>
                    <span>Total <br />Categories</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">
                        <h2 class="cn_num">102</h2>
                    </div>
                    <span>In <br />Country</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">
                        <h2 class="cn_num">98</h2>
                        <strong>%</strong>
                    </div>
                    <span>Happy <br />Customer</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Counter Section End -->

<!-- Team Section Begin -->
<section class="team spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Team</span>
                    <h2>Meet Our Team</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <img src="{{ asset('user/img/about/team-1.jpg') }}" alt="">
                    <h4>John Smith</h4>
                    <span>Product Design</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <img src="{{ asset('user/img/about/team-2.jpg') }}" alt="">
                    <h4>Christine Wise</h4>
                    <span>C.E.O</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <img src="{{ asset('user/img/about/team-3.jpg') }}" alt="">
                    <h4>Sean Robbins</h4>
                    <span>Manager</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <img src="{{ asset('user/img/about/team-4.jpg') }}" alt="">
                    <h4>Lucy Myers</h4>
                    <span>Delivery</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Team Section End -->

@endsection

@section('script_code')

@endsection