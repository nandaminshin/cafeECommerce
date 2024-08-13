@extends("user.master")

@section("title")
Blog Detail
@endsection

@section("active_blog")
class="active"
@endsection

@section('content')

<section class="blog-hero spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-9 text-center">
                <div class="blog__hero__text">
                    <h2>{{ $blog->title }}</h2>
                    <ul>
                        <li>Created at - {{ \Carbon\Carbon::parse($blog->created_at)->format("l, F
                            j, Y g:i A") }}</li>
                        <li>Updated at - {{ \Carbon\Carbon::parse($blog->updated_at)->format("l, F
                            j, Y g:i A") }}</li>
                        <li>{{ count($comments) }} Comments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="blog__details__pic">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="blog__details__content">
                    <div class="blog__details__share">
                        <span>share</span>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <div class="blog__details__quote">
                        <i class="fa fa-quote-left"></i>
                        <p>{{ $blog->highlight }}</p>
                    </div>
                    <div class="blog__details__text">
                        <p>{{ $blog->body }}</p>
                    </div>
                    <div class="blog__details__comment">
                        @if (Auth::check())
                        <h4>Leave A Comment</h4>
                        <form action="{{ route('user#add_comment', ['bid' => $blog->id, 'uid' => Auth::user()->id]) }}"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <textarea placeholder="Comment" name='body'
                                        class="text-black @error('body') is-invalid @enderror"></textarea>
                                    @error('body')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                    <button type="submit" class="site-btn">Post Comment</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <h4>Login Or Sign Up To Leave A Comment</h4>
                        @endif

                        <h3 class="mt-5">Comments</h3>

                        <div class="mt-3 col-12 comment-div">
                            <div class="container">
                                @foreach ($comments as $comment)
                                <div class="row comment-body mt-5 mb-5 pt-2 pb-2">
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4 mt-2" style="">
                                        <img src="@if($comment->user->image == null) {{ asset('user/img/default_user2.png') }} @else {{ asset('storage/' . $comment->user->image) }} @endif"
                                            alt="" width="45" height="45"
                                            style="border-radius: 50%; float: right; background-color: #00000025">
                                    </div>
                                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-8">
                                        <span class="comment-username">{{ $comment->user->name }}</span>
                                        @if (Auth::check() && $comment->user_id == Auth::user()->id)
                                        <form action="{{ route('user#delete_comment', $comment->id) }}" method="post"
                                            class="delete-form"> @csrf </form>
                                        <button class="my-comment"
                                            style="background: transparent; border: none; text-align: justify">
                                            {{ $comment->body }}
                                        </button>
                                        @else
                                        <span style="text-align: justify">
                                            {{ $comment->body }}
                                        </span>
                                        @endif
                                    </div>
                                    <div id="deleteModal" class="modal">
                                        <div class="modal-content">
                                            <button class="crossX" style="background: none; border: none">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                            <p>Are you sure you want to delete this comment?</p>
                                            <div class="modal-buttons">
                                                <button id="confirm-delete">Delete</button>
                                                <button id="cancel-delete">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Blog Details Section End -->

@endsection

@section('script_code')

<script>
    $(document).ready(function () {
        $('.comment-body').each(function () {
            var row = $(this);
            var modal = row.find('#deleteModal');
            var closeBtn = row.find('.crossX');
            var confirmBtn = row.find('#confirm-delete');
            var cancelBtn = row.find('#cancel-delete');
            var btn = row.find('.my-comment');
            var deleteForm = row.find('.delete-form');

            btn.on('click', function () {
                event.preventDefault();
                modal.show();
            });

            // Hide modal when 'x' is clicked
            closeBtn.on('click', function () {
                modal.hide();
            });

            // Hide modal when cancel button is clicked
            cancelBtn.on('click', function () {
                modal.hide();
            });

            // Submit the form when confirm button is clicked
            confirmBtn.on('click', function () {
                deleteForm.submit();
            });

            // Hide modal if user clicks outside of the modal content
            $(window).on('click', function (event) {
                if ($(event.target).is(modal)) {
                    modal.hide();
                }
            });
        })
    });

</script>

@endsection