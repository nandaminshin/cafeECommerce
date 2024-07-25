@extends('admin.master')

@section('title')
Change Password
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> Account Setting / Change Password</h4>
@endsection

@section('active_dashboard')
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
                    <h5 class="mb-0">Change password</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin#change_password_save') }}"
                        method="post">
                        @csrf
                        <input type="text" name="id" value="{{ Auth::user()->id }}" hidden>
                        <div class="row mb-3">
                            <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                for="basic-default-name">Old password</label>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror"
                                    id="basic-default-name">
                                <span class="text-danger">
                                    @error('old_password')
                                    {{ $message }}
                                    @enderror
                                </span>
                                <div>
                                    @livewire('alertMessage')
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                for="basic-default-name">New password</label>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror"
                                    id="basic-default-name">
                                <span class="text-danger">
                                    @error('new_password')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                for="basic-default-name">Confirm password</label>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"
                                    id="basic-default-name">
                                <span class="text-danger">
                                    @error('confirm_password')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
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

@endsection