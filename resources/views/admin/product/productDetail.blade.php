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
                <form action="{{ route('admin#category_delete', $category_data->id) }}" method="post"
                    class="card-header delete-category-form">
                    @csrf
                </form>
                <span class="card-header">
                    <button class="btn btn-sm rounded-pill btn-outline-primary delete-category-btn"><i
                            class="fa-solid fa-trash"></i>&nbsp;&nbsp;&nbsp; Delelte {{ $category_data->name }}</button>
                </span>
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
                        <tr class="data-row">
                            <td><strong>{{ $item->name }}</strong></td>
                            <td>{{ $item->price }}</td>
                            <td>
                                @if ($item->image == null)
                                <img src="{{ asset('admin/assets/img/elements/18.jpg') }}" alt="" width="50"
                                    height="40">
                                @else
                                <img src="{{ asset('storage/' . $item->image) }}" alt="" width="50" height="40">
                                @endif

                            </td>
                            <td>
                                <span>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary rounded-pill show-desc-btn">
                                        Read Description
                                    </button>

                                    <!-- Modal -->
                                    <div id="descriptionModal" class="modal">
                                        <div class="modal-content">
                                            <button class="crossX" style="background: none; border: none">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                            <textarea name="" id="" cols="30" rows="10" style="resize: none; "
                                                disabled>{{ $item->description }}</textarea>
                                        </div>
                                    </div>
                                </span>
                            </td>
                            <td>
                                <a
                                    href="{{ route('admin#product_edit', ['id' => $item->id, 'category_id' => $category_id]) }}">
                                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary"><i
                                            class="fa-solid fa-pen"></i>&nbsp;&nbsp;&nbsp; Edit</button>
                                </a>
                                <form
                                    action="{{ route('admin#product_delete', ['id' => $item->id, 'category_id' => $category_id]) }}"
                                    method="post" class="delete-product-form" hidden>
                                    @csrf
                                </form>
                                <button class="btn btn-sm rounded-pill btn-outline-primary delete-product-btn">
                                    <i class="fa-solid fa-trash"></i>&nbsp; Delete
                                </button>
                                <div class="modal delete-product-modal">
                                    <div class="modal-content">
                                        <button class="crossX" style="background: none; border: none">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <p>Are you sure you want to delete this product?</p>
                                        <div class="modal-buttons">
                                            <button id="confirm-product-delete">Yes</button>
                                            <button id="cancel-product-delete">No</button>
                                        </div>
                                    </div>
                                </div>
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

{{-- modal --}}
<div id="deleteConfirmationModal" class="modal">
    <div class="modal-content">
        <button class="crossX" style="background: none; border: none">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <p>Are you sure you want to delete this category?</p>
        <div class="modal-buttons">
            <button id="confirm-delete">Yes</button>
            <button id="cancel-delete">No</button>
        </div>
    </div>
</div>



@endsection

@section('script_code')

<script>
    $(document).ready(function () {
        var $deleteModal = $('#deleteConfirmationModal');
        var $deleteCloseBtn = $('.crossX');
        var $confirmBtn = $('#confirm-delete');
        var $cancelBtn = $('#cancel-delete');

        // Show modal when logout button is clicked
        $('.delete-category-btn').on('click', function (event) {
            event.preventDefault();
            $deleteModal.show();
        });

        // Hide modal when 'x' is clicked
        $deleteCloseBtn.on('click', function () {
            $deleteModal.hide();
        });

        // Hide modal when cancel button is clicked
        $cancelBtn.on('click', function () {
            $deleteModal.hide();
        });

        // Submit the form when confirm button is clicked
        $confirmBtn.on('click', function () {
            $('.delete-category-form').submit();
        });

        // Hide modal if user clicks outside of the modal content
        $(window).on('click', function (event) {
            if ($(event.target).is($deleteModal)) {
                $deleteModal.hide();
            }
        });

        //Description Modal
        var $descModal = $('#descriptionModal');
        var $closeBtn = $('.crossX');

        // Show modal when logout button is clicked
        $('.show-desc-btn').on('click', function (event) {
            event.preventDefault();
            $descModal.show();
        });

        // Hide modal when 'x' is clicked
        $closeBtn.on('click', function () {
            $descModal.hide();
        });

        // Hide modal if user clicks outside of the modal content
        $(window).on('click', function (event) {
            if ($(event.target).is($descModal)) {
                $descModal.hide();
            }
        });
        

        // delete product modal
        $('.data-row').each(function () {
            var row = $(this);

            var deleteProductModal = row.find('.delete-product-modal');
            var deleteCloseBtn = deleteProductModal.find('.crossX');
            var productDeleteConfirmBtn = deleteProductModal.find('#confirm-product-delete');
            var productDeleteCancelBtn = deleteProductModal.find('#cancel-product-delete');
            var deleteBtn = row.find('.delete-product-btn');
            var deleteProductForm = row.find('.delete-product-form');
            // Show modal when logout button is clicked
            deleteBtn.on('click', function (event) {
                event.preventDefault();
                deleteProductModal.show();
            });

            // Hide modal when 'x' is clicked
            deleteCloseBtn.on('click', function () {
                deleteProductModal.hide();
            });

            // Hide modal when cancel button is clicked
            productDeleteCancelBtn.on('click', function () {
                deleteProductModal.hide();
            });

            // Submit the form when confirm button is clicked
            productDeleteConfirmBtn.on('click', function () {
                deleteProductForm.submit();
                console.log('hi');
            });

            // Hide modal if user clicks outside of the modal content
            $(window).on('click', function (event) {
                if ($(event.target).is(deleteProductModal)) {
                    deleteProductModal.hide();
                }
            });
        });

    })
</script>

@endsection