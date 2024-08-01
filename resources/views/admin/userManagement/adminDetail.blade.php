@extends('admin.master')

@section('title')
Admin Management
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin / Admin Management /</span> Admin Detail Info</h4>
@endsection

@section('active_user1')
active open
@endsection

@section('active_user2')
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
                    <h5 class="mb-0">Admin Detail Info</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Name :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ $data->name }}
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Email :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ $data->email }}
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Phone number :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ $data->phone }}
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Address :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ $data->address }}
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Account created date :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ \Carbon\Carbon::parse($data->created_at)->format("l, F j, Y g:i A") }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script_code')

@endsection