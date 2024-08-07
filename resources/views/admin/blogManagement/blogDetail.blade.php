@extends('admin.master')

@section('title')
Blog Details
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> Blog Details</h4>
@endsection

@section('active_blog1')
active open
@endsection

@section('active_blog2')
active
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 offset-xl-1 offset-lg-1 offset-md-1">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Order Detail Info</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Title :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ $data->title }}
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Highlighted text :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ $data->highlight }}
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-black mb-2"
                            for="basic-default-name">
                            Body :
                        </label>
                        <p class="col-xl-12 col-lg-12 col-md128 col-sm-12 col-12 text-align-justify">
                            {{ $data->body }}
                        </p>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Image :
                        </label>
                        <img class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8"
                            src="{{ asset('storage/' . $data->image) }}" style="width: 100%; height: auto;" />
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Blog uploaded date :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ \Carbon\Carbon::parse($data->created_at)->format("l, F j, Y g:i A") }}
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Blog updated date :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ \Carbon\Carbon::parse($data->updated_at)->format("l, F j, Y g:i A") }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection