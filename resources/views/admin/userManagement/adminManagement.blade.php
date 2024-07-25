@extends('admin.master')

@section('title')
Admin Management
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> Admin Management</h4>
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
    <div class="row">
        <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="d-flex">
                <h5 class="card-header">{{ $data[0]->role }} table</h5>
                {{-- <a href="{{ route('admin#edit_category', $category_data->id) }}" class="card-header">
                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary"><i
                            class="fa-solid fa-pen"></i>&nbsp;&nbsp;&nbsp; Edit {{ $category_data->name }}</button>
                </a>
                <a href="{{ route('admin#category_delete', $category_data->id) }}" class="card-header">
                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary"><i
                            class="fa-solid fa-trash"></i>&nbsp;&nbsp;&nbsp; Delelte {{ $category_data->name }}</button>
                </a> --}}
            </div>
            <div class="table-responsive text-nowrap">
                @if (count($data) == 0)
                <div class="alert alert-primary" role="alert">There is no product here!</div>
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data as $item)
                        <tr>
                            <td>
                                @if ($item->image == null)
                                <img src="{{ asset('admin/assets/img/elements/18.jpg') }}" alt="" width="50"
                                    height="40">
                                @else
                                <img src="{{ asset('storage/' . $item->image) }}" alt="" width="50" height="40">
                                @endif

                            </td>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            <td>
                                <a
                                    href="">
                                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary"><i class="fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp; View</button>
                                </a>
                                <a
                                    href="">
                                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary">
                                        <i class="fa-solid fa-trash"></i>&nbsp; Delete
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection