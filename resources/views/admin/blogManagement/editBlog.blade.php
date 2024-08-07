@extends('admin.master')

@section('title')
Edit Blog
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> Edit Blog</h4>
@endsection

@section('active_blog1')
active open
@endsection

@section('active_blog2')
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
                        <i class="fa-solid fa-file-pen"></i>&nbsp; Edit Blog
                    </span>
                </li>
            </ul>

            <div class="card mb-3">
                <form action="{{ route('admin#edit_blog_save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h5 class="card-header">Blog Details</h5>
                    <!-- Account -->
                    <div class="card-body mb-2">
                        <div class="align-items-start align-items-sm-center gap-4">
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                    for="basic-default-phone">Current image</label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                    <img src="{{ asset('storage/'. $data->image) }}" alt="" width="200" height="">
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
                            <input type="number" name="id" value="{{ $data->id }}" hidden>
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Title</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text" id=""
                                    name="title" value="{{ $data->title, old($data->title) }}">
                                <span class="text-danger">
                                    @error('title')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Highlighted Text</label>
                                <input class="form-control @error('highlight') is-invalid @enderror" type="text"
                                    id="email" name="highlight" value="{{ $data->highlight, old($data->highlight) }}"
                                    placeholder="john.doe@example.com">
                                <span class="text-danger">
                                    @error('highlight')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="mb-3 col-12">
                                <label class="form-label" for="phoneNumber">Body</label>
                                <div class="input-group input-group-merge">
                                    <textarea type="text" id="phoneNumber" name="body"
                                        class="form-control @error('body') is-invalid @enderror" rows="30" cols="100"
                                        style="resize: none">{{ $data->body, old($data->body) }}</textarea>
                                    <span class="text-danger">
                                        @error('body')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-4">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@section('script_code')

<script>
    $(document).ready(function () {
        var deleteModal = $('#deleteConfirmationModal');
        var deleteCloseBtn = $('.crossX');
        var confirmBtn = $('#confirm-delete');
        var cancelBtn = $('#cancel-delete');

        $('#yes').change(function () {
            if ($(this).is(':checked')) {
                $('#uploadDiv').show();
            }
        });

        $('#no').change(function () {
            if ($(this).is(':checked')) {
                $('#uploadDiv').hide();
            }
        });
    })
</script>

@endsection