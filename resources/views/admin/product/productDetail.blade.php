@extends('admin.master')

@section('title')
Product Details
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> Product Details</h4>
@endsection

@section('active_product1')
active open
@endsection

@section('active_product2')
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
                <h5 class="card-header">{{ $category_data->name }} table</h5>
                <a href="{{ route('admin#edit_category', $category_data->id) }}" class="card-header">
                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary"><i
                            class="fa-solid fa-pen"></i>&nbsp;&nbsp;&nbsp; Edit {{ $category_data->name }}</button>
                </a>
                <a href="{{ route('admin#category_delete', $category_data->id) }}" class="card-header">
                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary"><i class="fa-solid fa-trash"></i>&nbsp;&nbsp;&nbsp; Delelte {{ $category_data->name }}</button>
                </a>
            </div>
            @php
                $category_id = $category_data->id;
            @endphp
            <div class="table-responsive text-nowrap">
                @if (count($data) == 0)
                <div class="alert alert-primary" role="alert">There is no product here!</div>
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data as $item)
                        <tr>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td>{{ $item->price }}</td>
                            <td>
                                @if ($item->image == null)
                                <img src="{{ asset('admin/assets/img/elements/18.jpg') }}" alt="" width="50" height="40">
                                @else
                                <img src="{{ asset('storage/' . $item->image) }}" alt="" width="50" height="40">
                                @endif
                                
                            </td>
                            <td>
                                <span>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary rounded-pill"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Read Description
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Description</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <textarea name="" id="" cols="50" rows="7" disabled
                                                        class="form-control" style="resize: none">
                                                    {{ $item->description }}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin#product_edit', ['id' => $item->id, 'category_id' => $category_id]) }}">
                                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary"><i
                                            class="fa-solid fa-pen"></i>&nbsp;&nbsp;&nbsp; Edit</button>
                                </a>
                                <a href="{{ route('admin#product_delete', ['id' => $item->id, 'category_id' => $category_id]) }}">
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