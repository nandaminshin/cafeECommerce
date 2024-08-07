@extends('admin.master')

@section('title')
Create New Blog
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> Create New Blog</h4>
@endsection

@section('active_blog1')
active open
@endsection

@section('active_blog3')
active
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="py-3">
        @livewire('alertMessage')
    </div>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Create New Blog</h5>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" class="blog-create-form"
                        action="{{ route('admin#create_blog') }}" method="post">
                        @csrf
                        <div class="mb-5 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <label for="" class="mb-2">Image For Blog</label>
                            <input type="file" name="image" value="{{ old('image') }}" class="form-control @error('image')
                                is-invalid
                            @enderror" placeholder="Image For Blog">
                            <span class="text-danger">
                                @error('image')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-5">
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title')
                                is-invalid
                            @enderror" placeholder="Blog Title">
                            <span class="text-danger">
                                @error('title')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-5">
                            <textarea name="body" cols="30" rows="18" class="form-control @error('body')
                                is-invalid
                            @enderror" style="resize: none"> {{ old('body') }} </textarea>
                            <span class="text-danger">
                                @error('body')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-5">
                            <input type="text" name="highlight" value="{{ old('highlight') }}" class="form-control @error('highlight')
                                is-invalid
                            @enderror" placeholder="Highlight Text From Body">
                            <span class="text-danger">
                                @error('highlight')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </form>
                    <button class="btn btn-primary col-xl-4 col-lg-4 col-md-6 col-sm-12 blog-create-btn">Create</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal --}}
<div class="modal blog-create-modal">
    <div class="modal-content">
        <button class="crossX" style="background: none; border: none">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <p>Are you sure to create this blog and post on the website?</p>
        <br>
        <div class="modal-buttons">
            <button id="confirm-create">Yes</button>
            <button id="cancel-create">No</button>
        </div>
    </div>
</div>

@endsection

@section('script_code')

<script>
    $(document).ready(function () {
        var createModal = $('.blog-create-modal');
        var deleteCloseBtn = $('.crossX');
        var confirmBtn = $('#confirm-create');
        var cancelBtn = $('#cancel-create');

        // Show modal when logout button is clicked
        $('.blog-create-btn').on('click', function (event) {
            event.preventDefault();
            createModal.show();
        });

        // Hide modal when 'x' is clicked
        deleteCloseBtn.on('click', function () {
            createModal.hide();
        });

        // Hide modal when cancel button is clicked
        cancelBtn.on('click', function () {
            createModal.hide();
        });

        // Submit the form when confirm button is clicked
        confirmBtn.on('click', function () {
            $('.blog-create-form').submit();
        });

        // Hide modal if user clicks outside of the modal content
        $(window).on('click', function (event) {
            if ($(event.target).is(createModal)) {
                createModal.hide();
            }
        });
    });
</script>

@endsection