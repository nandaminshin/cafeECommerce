@extends("user.master")

@section("title")
Setting
@endsection

@section("active_account")
class="active"
@endsection

@section("content")

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb__text">
          <h4>Setting</h4>
          <div class="breadcrumb__links">
            <a href="./index.html">Home</a>
            <span>Setting</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="py-3">
  @livewire('alertMessage')
</div>

<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
  <div class="container">
    <div class="checkout__form">
      <a href="{{ route('user#change_password') }}">
        <button class="btn site-btn btn-primary">Change Password</button>
      </a>
      <div class="row mt-5">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
          <form action="{{ route('user#delete_account', Auth::user()->id) }}" method="post" class="delete-account-form">
            @csrf
            <input type="password" name="password" class="user-password" value="0" hidden>
            <div>
              <div class="checkout__order">
                <h4 class="order__title">Detail info</h4>
                <ul class="checkout__total__products">
                  <li>
                    <div class="checkout__order__products">
                      Name : &nbsp; &nbsp;
                      {{ Auth::user()->name }}
                    </div>
                  </li>
                  <li>
                    <div class="checkout__order__products">
                      Email : &nbsp; &nbsp;
                      {{ Auth::user()->email }}
                    </div>
                  </li>
                  <li>
                    <div class="checkout__order__products">
                      Phone : &nbsp; &nbsp;
                      {{ Auth::user()->phone }}
                    </div>
                  </li>
                  <li>
                    <div class="checkout__order__products">
                      Detail Address : &nbsp; &nbsp;
                      {{ Auth::user()->address }}
                    </div>
                  </li>
                  <li>
                    <div class="checkout__order__products d-fles">
                      Profile : &nbsp; &nbsp;

                      @if (Auth::user()->image)
                      <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="" width="90" height="90" />
                      @else
                      No image yet
                      @endif
                    </div>
                  </li>
                </ul>

                <button class="btn btn-danger site-btn delete-account-btn" style="margin-top: 50px">
                  Delete Account
                </button>
              </div>
            </div>
          </form>
        </div>

        <form enctype="multipart/form-data" action="{{ route('user#update_save') }}"
          class="col-xl-6 col-lg-6 col-md-6 col-sm-12 edit-form" method="post">
          @csrf
          <input type="hidden" name="id" value="{{ Auth::user()->id }}" />
          <div>
            <h6 class="checkout__title">Update info</h6>
            <div class="row">
              <div class="col-lg-6">
                <div class="checkout__input">
                  <p>
                    Name
                    <span>*</span>
                  </p>
                  <input type="text" name="name" value="{{ Auth::user()->name }}"
                    class=" @error('name') is-invalid @enderror" />
                  <span class="text-danger">
                    @error("name")
                    {{ $message }}
                    @enderror
                  </span>
                </div>
              </div>
            </div>
            <div class="checkout__input">
              <p>
                Email
                <span>*</span>
              </p>
              <input type="email" name="email" value="{{ Auth::user()->email }}"
                class=" @error('email') is-invalid @enderror" />
              <span class="text-danger">
                @error("email")
                {{ $message }}
                @enderror
              </span>
            </div>
            <div class="checkout__input">
              <p>
                Phone Number
                <span>*</span>
              </p>
              <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                class=" @error('phone') is-invalid @enderror" />
              <span class="text-danger">
                @error("phone")
                {{ $message }}
                @enderror
              </span>
            </div>
            <div class="checkout__input">
              <p>
                Address
                <span>*</span>
              </p>
              <input type="text" value="{{ Auth::user()->address }}" name="address"
                class="checkout__input__add @error('address') is-invalid @enderror" />
              <span class="text-danger">
                @error("address")
                {{ $message }}
                @enderror
              </span>
            </div>
            <div class="custom-input">
              <p>Do you want to add a new profile photo?</p>
              <input type="radio" id="yes" name="new_image" value="yes" />
              <label for="yes">Yes</label>
              <br />
              <input type="radio" id="no" name="new_image" value="no" />
              <label for="no">No</label>
            </div>
            <div class="checkout__input" id="uploadDiv" style="display: none">
              <p>
                New Image
                <span>*</span>
              </p>
              <input type="file" id="basic-default-phone" name="image"
                class="checkout__input__add phone-mask @error('image') is-invalid @enderror" placeholder=""
                aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
            <button class="btn btn-primary site-btn save-changes" style="margin-top: 50px">
              Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- Checkout Section End -->
<div id="updateConfirmationModal" class="modal">
  <div class="modal-content">
    <button class="crossX" style="background: none; border: none">
      <i class="fa-solid fa-xmark"></i>
    </button>
    <p>Are you sure you want to save changes?</p>
    <div class="modal-buttons">
      <button id="confirm-update">Yes</button>
      <button id="cancel-update">No</button>
    </div>
  </div>
</div>

<div id="deleteConfirmationModal" class="modal">
  <div class="modal-content">
    <button class="crossX" style="background: none; border: none">
      <i class="fa-solid fa-xmark"></i>
    </button>
    <p>Are you sure you want to delete this account?</p>
    <h5>Input Your Password</h5>
    <br>
    <input type="password" class="input-password">
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
    $('.toast').toast('show')

    const $yesRadio = $('#yes');
    const $noRadio = $('#no');
    const $uploadDiv = $('#uploadDiv');

    $yesRadio.on('change', function () {
        if ($yesRadio.is(':checked')) {
            $uploadDiv.show();
        }
    });

    $noRadio.on('change', function () {
        if ($noRadio.is(':checked')) {
            $uploadDiv.hide();
        }
    });

    // Get modal elements
    var $modal = $('#updateConfirmationModal');
    var $closeBtn = $('.crossX');
    var $confirmBtn = $('#confirm-update');
    var $cancelBtn = $('#cancel-update');

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
        $('.edit-form').submit();
    });

    // Hide modal if user clicks outside of the modal content
    $(window).on('click', function (event) {
        if ($(event.target).is($modal)) {
            $modal.hide();
        }
    });

    var $deleteModal = $('#deleteConfirmationModal');
    var $deleteCloseBtn = $('.crossX');
    var $confirmBtn = $('#confirm-delete');
    var $cancelBtn = $('#cancel-delete');

    // Show modal when logout button is clicked
    $('.delete-account-btn').on('click', function (event) {
        event.preventDefault();
        $deleteModal.show();
    });

    // Hide modal when 'x' is clicked
    $deleteCloseBtn.on('click', function () {
        $deleteModal.hide();
    });

    // Hide modal when cancel button is clicked
    $cancelBtn.on('click', function () {
        $deleteModal.hide();
    });

    // Submit the form when confirm button is clicked
    $confirmBtn.on('click', function () {
        var inputPassword = $('.input-password').val();
        $('.user-password').val(inputPassword);
        $('.delete-account-form').submit();
    });

    // Hide modal if user clicks outside of the modal content
    $(window).on('click', function (event) {
        if ($(event.target).is($deleteModal)) {
            $deleteModal.hide();
        }
    });
        });
</script>
@endsection