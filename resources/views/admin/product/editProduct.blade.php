@extends('admin.master')

@section('title')
Edit Product
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> Edit Product</h4>
@endsection

@section('active_product1')
active open
@endsection

@section('active_product2')
active
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    @php
    $category_id = $category_id;
    @endphp
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 offset-xl-3 offset-lg-3 offset-md-3">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit {{$data->name}}</h5>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('admin#product_edit_save', $category_id) }}"
                        method="post">
                        @csrf
                        <input type="text" name="id" value="{{ $data->id }}" hidden>
                        <div class="row mb-3">
                            <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                for="basic-default-name">Product Name</label>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    id="basic-default-name" value="{{ $data->name, old($data->name) }}">
                                <span class="text-danger">
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                for="basic-default-company">Price</label>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <input type="text" name="price"
                                    class="form-control @error('price') is-invalid @enderror" id="basic-default-company"
                                    value="{{ $data->price, old($data->price) }}">
                                <span class="text-danger">
                                    @error('price')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                for="basic-default-company">Description</label>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <input type="text" name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    id="basic-default-company"
                                    value="{{ $data->description, old($data->description) }}">
                                <span class="text-danger">
                                    @error('description')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                for="basic-default-phone">Current image</label>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <img src="{{ asset('storage/'.$data->image) }}" alt="" width="200" height="">
                            </div>
                        </div>
                        <div class="row mb-3 mt-5">
                            <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 col-form-label"
                                for="basic-default-phone">Do you want to upload new image?</label>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <input type="radio" id="yes" name="new_image" value="yes">
                                <label for="yes">Yes</label><br>
                                <input type="radio" id="no" name="new_image" value="no">
                                <label for="no">No</label>
                            </div>
                        </div>
                        <div class="row mb-3 mt-1" id="uploadDiv">
                            <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                for="basic-default-phone">New image</label>

                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <input type="file" id="basic-default-phone" name="image" class="form-control phone-mask"
                                    placeholder="" aria-label="658 799 8941" aria-describedby="basic-default-phone">
                            </div>
                            {{-- <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img
                                        src="{{ asset('admin/assets/img/avatars/1.png') }}"
                                        alt="user-avatar"
                                        class="d-block rounded"
                                        height="100"
                                        width="100"
                                        id="uploadedAvatar"
                                    >
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input
                                                type="file"
                                                id="upload"
                                                class="account-file-input"
                                                hidden
                                                accept="image/png, image/jpeg, image/webp"
                                                name="image"
                                            >
                                        </label>
                                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <span class="text-danger">
                            @error('image')
                            {{ $message }}
                            @enderror
                        </span>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
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