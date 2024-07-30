@extends("user.master")

@section("title")
Change Password
@endsection

@section("active_account")
class="active"
@endsection

@section('content')

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Change Password</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Setting</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row mt-5">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                </div>

                <form action="{{ route('user#change_password_save') }}"
                    class="col-xl-6 col-lg-6 col-md-6 col-sm-12 change-password-form" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}" />
                    <div>
                        <h6 class="checkout__title">Change Password</h6>
                        <div class="checkout__input">
                            <p>
                                Old Password
                                <span>*</span>
                            </p>
                            <input type="password" name="old_password"
                                class=" @error('old_password') is-invalid @enderror" />
                            <span class="text-danger">
                                @error("old_password")
                                {{ $message }}
                                @enderror
                            </span>
                            <div>
                                @livewire('alertMessage')
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>
                                New Password
                                <span>*</span>
                            </p>
                            <input type="password" name="new_password"
                                class=" @error('new_password') is-invalid @enderror" />
                            <span class="text-danger">
                                @error("new_password")
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="checkout__input">
                            <p>
                                Confirm Password
                                <span>*</span>
                            </p>
                            <input type="password" name="confirm_password"
                                class=" @error('confirm_password') is-invalid @enderror" />
                            <span class="text-danger">
                                @error("confirm_password")
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <button class="btn btn-primary site-btn save-changes" style="margin-top: 50px">
                            Save Changes
                        </button>
                    </div>
                </form>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<div id="newPasswordConfirmationModal" class="modal">
    <div class="modal-content">
        <button class="crossX" style="background: none; border: none">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <p>Are you sure you want to save changes?</p>
        <div class="modal-buttons">
            <button id="confirm-new-password">Yes</button>
            <button id="cancel-new-pssword">No</button>
        </div>
    </div>
</div>

@endsection

@section('script_code')
<script>
    $(document).ready(function () {
        var $modal = $('#newPasswordConfirmationModal');
        var $closeBtn = $('.crossX');
        var $confirmBtn = $('#confirm-new-password');
        var $cancelBtn = $('#cancel-new-password');

        // Show modal when logout button is clicked
        $('.save-changes').on('click', function (event) {
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
            $('.change-password-form').submit();
        });

        // Hide modal if user clicks outside of the modal content
        $(window).on('click', function (event) {
            if ($(event.target).is($modal)) {
                $modal.hide();
            }
        });
    })
</script>
@endsection