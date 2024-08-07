@extends("user.master")

@section("title")
Blogs
@endsection

@section("active_blog")
class="active"
@endsection

@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-blog set-bg" data-setbg="{{ asset('user/img/breadcrumb-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Our Blogs</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            @if ($data)
            @foreach ($data as $item)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('storage/' . $item->image) }}"></div>
                    <div class="blog__item__text" style="opacity: 0.9">
                        <span><img src="img/icon/calendar.png" alt=""> {{
                            \Carbon\Carbon::parse($item->created_at)->format("l, F
                            j, Y g:i A") }}</span>
                        <h5>{{ $item->title }}</h5>
                        <a href="{{ route('user#blog_detail', $item->id) }}">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <h1>No blog yet!</h1>
            @endif
        </div>
    </div>
</section>
<!-- Blog Section End -->

@endsection