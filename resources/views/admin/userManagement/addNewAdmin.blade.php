@extends('admin.master')

@section('title')
Add New Admin
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> Add New Admin</h4>
@endsection

@section('active_user1')
active open
@endsection

@section('active_user2')
active
@endsection


@section('content')

<div class="py-3">
    @livewire('alertMessage')
</div>

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
                    <form action="{{ route('admin#add_admin_save', Auth::user()->id) }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-form-label"
                                for="basic-default-name">Email</label>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="basic-default-name"
                                    placeholder="New Admin Email">
                                <span class="text-danger">
                                    @error('email')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection