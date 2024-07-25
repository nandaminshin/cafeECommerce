@extends('admin.master')

@section('title')
Create Product
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> Create Product</h4>
@endsection

@section('active_product1')
active open
@endsection

@section('active_product4')
active
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 offset-xl-3 offset-lg-3 offset-md-3">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Create New Product</h5>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('admin#create_new_product') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                for="basic-default-name">Product Name</label>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    id="basic-default-name" placeholder="New Product Name">
                                <span class="text-danger">
                                    @error('name')
                                    This product already exists.
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                for="basic-default-name">Category Name</label>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <select name="category_id" id="" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="" disabled selected>Choose a category</option>
                                    @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('category_id')
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
                                    class="form-control @error('price') is-invalid @enderror"
                                    id="basic-default-company" placeholder="Price">
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
                                    id="basic-default-company" placeholder="Description">
                                <span class="text-danger">
                                    @error('description')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                for="basic-default-phone">Image</label>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <input type="file" id="basic-default-phone" name="image" class="form-control phone-mask"
                                    placeholder="" aria-label="658 799 8941" aria-describedby="basic-default-phone">
                                <span class="text-danger">
                                    @error('image')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection