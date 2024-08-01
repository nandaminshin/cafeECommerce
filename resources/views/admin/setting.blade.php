@extends('admin.master')

@section('title')
Admin Setting
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> Account Setting</h4>
@endsection

@section('active_dashboard')
active
@endsection

@section('content')

<div class="py-3">
    @livewire('alertMessage')
</div>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <span class="nav-link active" href="javascript:void(0);">
                        <i class="bx bx-user me-1"></i> Account
                    </span>
                </li>
            </ul>

            <div class="card mb-3">
                <form action="{{ route('admin#setting_save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body mb-2">
                        <div class="align-items-start align-items-sm-center gap-4">
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                    for="basic-default-phone">Current image</label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="" width="200" height="">
                                </div>
                            </div>
                            <div class="row mb-3 mt-5">
                                <label class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 col-form-label"
                                    for="basic-default-phone">Do you want to upload new image?</label>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <input type="radio" id="yes" name="new_image" value="yes">
                                    <label for="yes">Yes</label><br>
                                    <input type="radio" id="no" name="new_image" value="no">
                                    <label for="no">No</label>
                                </div>
                            </div>
                            <div class="row mb-3 mt-1" id="uploadDiv">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label" for="image">New
                                    image</label>

                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                    <input type="file" id="basic-default-phone" name="image"
                                        class="form-control phone-mask" placeholder="" aria-label="658 799 8941"
                                        aria-describedby="basic-default-phone">
                                </div>
                            </div>
                            <span class="text-danger">
                                @error('image')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="card-body mb-5">
                        <div class="row">
                            <input type="number" name="id" value="{{ Auth::user()->id }}" hidden>
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Username</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id=""
                                    name="name" value="{{ Auth::user()->name, old(Auth::user()->name) }}">
                                <span class="text-danger">
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="text" id="email"
                                    name="email" value="{{ Auth::user()->email, old(Auth::user()->email) }}"
                                    placeholder="john.doe@example.com">
                                <span class="text-danger">
                                    @error('email')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Phone Number</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="phoneNumber" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ Auth::user()->phone, old(Auth::user()->phone) }}">
                                    <span class="text-danger">
                                        @error('phone')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address"
                                    value="{{ Auth::user()->address, old(Auth::user()->address) }}">
                                <span class="text-danger">
                                    @error('address')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-4">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    </div>
                </form>

                <ul class="nav nav-pills flex-column flex-md-row m-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin#change_password') }}">
                            <i class="bx bx-user me-1"></i> Change password
                        </a>
                    </li>
                </ul>

                <h5 class="card-header">Delete Account</h5>
                <div class="card-body">
                    <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                            <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                    </div>
                    <div id="formAccountDeactivation">
                        <form action="{{ route('admin#delete_account', Auth::user()->id) }}" method="post"
                            id="account-delete-form" hidden>
                            @csrf
                            <input type="password" name="password" class="admin-password" value="0">
                        </form>
                        <button class="btn btn-danger deactivate-account delete-account-btn">Delete Account</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div id="deleteConfirmationModal" class="modal">
        <div class="modal-content">
            <button class="crossX" style="background: none; border: none">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <p>Are you sure you want to delete this account?</p>
            <br>
            <h5>Input Your Password</h5>
            <input type="password" class="form-info input-password">
            <div class="modal-buttons">
                <button id="confirm-delete">Yes</button>
                <button id="cancel-delete">No</button>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const yesRadio = document.getElementById('yes');
        const noRadio = document.getElementById('no');
        const uploadDiv = document.getElementById('uploadDiv');

        yesRadio.addEventListener('change', function () {
            if (yesRadio.checked) {
                uploadDiv.style.display = 'block';
            }
        });

        noRadio.addEventListener('change', function () {
            if (noRadio.checked) {
                uploadDiv.style.display = 'none';
            }
        });
    });
</script>

@endsection

@section('script_code')

<script>
    $(document).ready(function () {
        var deleteModal = $('#deleteConfirmationModal');
        var deleteCloseBtn = $('.crossX');
        var confirmBtn = $('#confirm-delete');
        var cancelBtn = $('#cancel-delete');

        // Show modal when logout button is clicked
        $('.delete-account-btn').on('click', function (event) {
            event.preventDefault();
            deleteModal.show();
        });

        // Hide modal when 'x' is clicked
        deleteCloseBtn.on('click', function () {
            deleteModal.hide();
        });

        // Hide modal when cancel button is clicked
        cancelBtn.on('click', function () {
            deleteModal.hide();
        });

        // Submit the form when confirm button is clicked
        confirmBtn.on('click', function () {
            var inputPassword = $('.input-password').val();
            $('.admin-password').val(inputPassword);
            $('#account-delete-form').submit();
        });

        // Hide modal if user clicks outside of the modal content
        $(window).on('click', function (event) {
            if ($(event.target).is(deleteModal)) {
                deleteModal.hide();
            }
        });
    });
</script>

@endsection